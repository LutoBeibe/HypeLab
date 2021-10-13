<?php
	trait db{
		public static function pdo(){
			$db_host = db_host;
			$db_nome = db_nome;
			$db_usuario = db_usuario;
			$db_senha = db_senha;

			try{
				return $pdo = new PDO("mysql:host={$db_host};dbname={$db_nome}", $db_usuario, $db_senha);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				echo "Erro ao conectar-se: ".$e->getMessage();
				exit();
			}
		}
	}

	class website{

		public static function get_explode(){
			$url = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'inicio';
			return $explode = explode('/', $url);
		}

		public static function get_data(){
			date_default_timezone_set('America/Sao_Paulo');
			return date('d/m/Y');
		}

		public static function website_paginacao(){
			$url = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'inicio';
			$explode = explode('/', $url);
			$dir = 'pags/php/';
			$ext = '.php';

			if(file_exists($dir.$explode['0'].$ext)){
				include($dir.$explode['0'].$ext);
			}else{
				include('pags/php/404.php');
			}
		}

		public static function website_limitaCaracteres($titulo){
			if(strlen($titulo) <= 27){
				return $titulo;
			}else{
				return mb_substr($titulo, 0, 27, 'UTF-8' )."...";
			}
		}

		public static function website_selectBanco($banco){
			$bancos = [
                'images/template/banco_santander.jpg',
                'images/template/banco_caixa.png',
                'images/template/banco_itau.png',
                'images/template/banco_bb.gif',
                'images/template/banco_bradesco.png'
            ];

			switch($banco){
				case 0:
				echo "<img src='{$bancos[0]}' width='180' height='50' />";
				break;

				case 1:
				echo "<img src='{$bancos[1]}' width='180' height='50' />";
				break;

				case 2:
				echo "<img src='{$bancos[2]}' width='180' height='50' />";
				break;

				case 3:
				echo "<img src='{$bancos[3]}' width='180' height='50' />";
				break;

				case 4:
				echo "<img src='{$bancos[4]}' width='180' height='50' />";
				break;
			}
		}

		// public static function website_getUniqPaymentMP($pagamento){
    //         $preference = new MercadoPago\Preference();
    //         $preco = str_replace(',', '.', $pagamento[2]);
    //         #item
    //         $item = new MercadoPago\Item();
    //         $item->id = $pagamento[0];
    //         $item->title = $pagamento[1];
    //         $item->quantity = 1;
    //         $item->unit_price = $preco;
 
    //         #preference
    //         $preference->items = array($item);
 
    //         #Id de referencia
    //         $preference->external_reference = $pagamento[3];
 
    //         #salva a preferencia
    //         $preference->save();
 
    //         echo "<a href='{$preference->sandbox_init_point}' class='btn btn-outline-success'>Pagar Agora</a>";
    //     }

        public static function website_verificaIsLogado(){
        	if(!isset($_SESSION['userEmail'])){
        		self::website_direciona("enter");
        		exit();
        	}
        }

		public static function website_admin_paginacao(){
			$url = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'login';
			$explode = explode('/', $url);
			$dir = 'pags/php/';
			$ext = '.php';

			$isAdmin = self::website_getDadosCliente("isadmin");

			if(file_exists($dir.$explode['0'].$ext)){
				if(isset($_SESSION['userEmail']) && $isAdmin == 1){
					include($dir.$explode['0'].$ext);
				}else{
					include($dir."login".$ext);
				}		
			}else{
				include('pags/php/404.php');
			}
		}


		public static function website_admin_verificaLogin(){
			$isAdmin = self::website_getDadosCliente("isadmin");
			if(isset($_SESSION['userEmail']) && $isAdmin == 1){
				self::website_direciona("dashboard");
				exit();
			}
		}

		public static function website_categorias(){
			 $pdo = db::pdo();

			try{
				$stmtCategoria = $pdo->prepare("SELECT * FROM categorias ORDER BY categoria ASC");
				$stmtCategoria->execute();
				$totalCategoria = $stmtCategoria->rowCount();

				if($totalCategoria > 0){
					while ($dadosCategoria = $stmtCategoria->fetch(PDO::FETCH_ASSOC)) {
                        $stmtSubcategoria = $pdo->prepare("SELECT * FROM subcategorias WHERE id_categoria = :id_categoria ORDER BY subcategoria ASC");
                        $stmtSubcategoria->execute([':id_categoria' => $dadosCategoria['id']]);
                        $totalSubcategoria = $stmtSubcategoria->rowCount();

                        if($totalSubcategoria > 0){
                            echo "
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <a data-toggle='collapse' data-parent='#accordian' href='#categoria-{$dadosCategoria['id']}'>
                                                <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                                {$dadosCategoria['categoria']}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id='categoria-{$dadosCategoria['id']}' class='panel-collapse collapse'>
                                        <div class='panel-body'>
                                            <ul>
                                                ".self::website_subcategorias($dadosCategoria['id'])."
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                        
                        elseif($totalSubcategoria == 0) {
                            echo "
                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'><a href='categoria/{$dadosCategoria['id']}'>{$dadosCategoria['categoria']}</a></h4>
                                    </div>
                                </div>
                            ";    
                        }
					}
				}
			}catch(PDOException $e){
				return $e->getMessage();
			}
		}

		public static function website_subcategorias($id){
			$pdo = db::pdo();

			try{
				$stmt = $pdo->prepare("SELECT * FROM subcategorias WHERE id_categoria = :id_categoria ORDER BY subcategoria ASC");
				$stmt->execute([':id_categoria' => $id]);
				$total = $stmt->rowCount();
				$listaSubcategoriaHtml = "";

				if($total > 0){
					while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$listaSubcategoriaHtml .= "<li><a href='subcategoria/{$dados['id']}'>{$dados['subcategoria']}</a></li>";
					}

					return $listaSubcategoriaHtml;
				}
			}catch(PDOException $e){
				return $e->getMessage();
			}
		}

        public static function website_navTop(){
			if(isset($_SESSION['userEmail'])){
				$clientes = new clientes();

				echo "
					<div class='contactinfo'>
							<ul class='nav nav-pills'>
									<li><a href='me'><span id='contact-message'>Olá</span>, ". $clientes->nome ."!</a></li>
							</ul>
					</div>
				";
			}else{
				echo "
					<div class='contactinfo'>
							<ul class='nav nav-pills'>
									<li><a href='enter'>Faça parte da HypeLab</a></li>
							</ul>
					</div>
				";
			}
		}

		public static function website_navLogin(){
			if(isset($_SESSION['userEmail'])){
				$htmlNavLogin = "
					<li class='dropdown'><a href='#'>Conta</a>
						<ul role='menu' class='sub-menu account-menu'>
							<li><a href='me'>Dados Cadastrais</a></li>
							<li><a href='pedidos'>Meus pedidos</a></li> 
							<li><a href='faturas'>Minhas Faturas</a></li> 
							<li><a href='sair'>Sair da Conta</a></li>
						</ul>
					</li> 
					<li><a href='https://www2.correios.com.br/sistemas/rastreamento/default.cfm'>Rastrear Pedidos</a></li>
					<li><a href=''>Favoritos</a></li>
				";
				
				if (isset($_SESSION['isVendedor']) && $_SESSION['isVendedor']) {
					$htmlNavLogin .= "
						<li class='dropdown'><a href='#'>Gerenciar</a>
							<ul role='menu' class='sub-menu account-menu'>
								<li><a href='buscar-produto-vendedor'>Buscar</a></li> 
								<li><a href='cadastrar-produto-vendedor'>Cadastrar Produto</a></li>
								<li><a href='gerenciar-produtos-vendedor'>Gerenciar Produtos</a></li>
								<li><a href='gerenciar-vendas-vendedor'>Gerenciar Vendas</a></li> 
							</ul>
						</li> 
					";
				}

				echo $htmlNavLogin;
			}else{
				echo "
						<li><a href='enter'>Entrar</a></li>
						<li><a href='https://www2.correios.com.br/sistemas/rastreamento/default.cfm'> Rastrear Pedidos</a></li>
						<li><a href=''>Favoritos</a></li>
				";
			}
		}

		public static function website_autenticaLogin(){
			if(isset($_POST['log']) && $_POST['log'] == "in"){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = :email AND senha = :senha");
				$stmt->execute(array(':email' => $_POST['email'], ':senha' => $_POST['senha']));
				$total = $stmt->rowCount();

				if($total <= 0){
					$mensagemHtml = "<span class='text-danger'>Email ou senha inválidos</span>";
					self::website_pop_up($mensagemHtml);
				}else{
					$dados = $stmt->fetch(PDO::FETCH_ASSOC);
					$mensagemHtml = "<span class='text-success'>Bem vindo de volta {$dados['nome']}!</span>";
					self::website_pop_up($mensagemHtml);
					$_SESSION['userEmail'] = $dados['email'];
					$_SESSION['isVendedor'] = false;
					$_SESSION['userId'] = $dados['id'];
					self::website_direciona("inicio");
				}
			}
		}

		public static function website_autenticaLoginVendedor(){
			if(isset($_POST['log']) && $_POST['log'] == "inVendedor"){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM vendedores WHERE email = :email AND senha = :senha");
				$stmt->execute(array(':email' => $_POST['email'], ':senha' => $_POST['senha']));
				$total = $stmt->rowCount();

				if($total <= 0){
					$mensagemHtml = "<span class='text-danger'>Email ou senha inválidos</span>";
					self::website_pop_up($mensagemHtml);
				}else{
					$dados = $stmt->fetch(PDO::FETCH_ASSOC);
					$mensagemHtml = "<span class='text-success'>Bem vindo de volta {$dados['nome']}!</span>";
					self::website_pop_up($mensagemHtml);
					$_SESSION['userEmail'] = $dados['email'];
					$_SESSION['userId'] = $dados['id'];
					$_SESSION['isVendedor'] = true;
					self::website_direciona("cadastrar-produto-vendedor");
				}
			}
		}

		public static function website_direciona($url){
			echo "<meta http-equiv='refresh' content='2; url={$url}'>";
		}

		public static function website_logout(){
			session_destroy();
			self::website_direciona("enter");
		}

		public static function website_card_produtos($dados) {
			echo "
				<div class='col-sm-4'>
						<div class='product-image-wrapper'>
								<form method='POST' autocomplete='off'>
										<div class='single-products'>
												<div class='productinfo text-center'>
														<!--<button class='favorite-item-button' onclick='handleFavoriteItem()'>
															<i class='fa fa-star'></i>
														</button>-->

														<img src='{$dados['foto']}' alt='{$dados['nome']}' />
														<h2>R$ {$dados['preco']}</h2>
														<p>".self::website_limitaCaracteres($dados['nome'])."</p>
														<a class='btn btn-default add-to-cart' href='cart/{$dados['id']}'>
															<i class='fa fa-shopping-cart'></i>Comprar
														</a>
												</div>
										</div>
										<input type='hidden' name='id_produto' value='{$dados['id']}'>
										<input type='hidden' name='env' value='adicionarAoCarrinho'>
								</form>
						</div>
				</div>
			";
		}

		public static function website_produtos_recentes(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM produtos WHERE estoque > 0 ORDER BY publicado_em DESC LIMIT 12");
			$stmt->execute();
			$total = $stmt->rowCount();

			if ($total > 0) {
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {	
					self::website_card_produtos($dados);
				}
			} 
		}

		public static function website_pesquisa() {
			$_SESSION['searchString'] = isset($_POST['searchString']) 
				? urldecode($_POST['searchString']) 
				: '';

			$_SESSION['typeSearch'] = isset($_POST['typeSearch']) 
				? urldecode($_POST['typeSearch']) 
				: '';
		}

		public static function website_produtos_pesquisa($searchString, $typeSearch) {
			$pdo = db::pdo();

			$stmt = false;

			if ($typeSearch == 'productName') {
				$stmt = $pdo->prepare("SELECT * FROM produtos WHERE estoque > 0 AND nome LIKE :searchString");
				$stmt->execute([':searchString' => '%'.$searchString.'%']);
			}

			if ($typeSearch == 'priceRange') {
				$prices = explode(',', $searchString);

				$minPrice = $prices[0];
				$maxPrice = $prices[1];

				$stmt = $pdo->prepare("SELECT * FROM produtos WHERE estoque > 0 AND preco >= :minPrice AND preco <= :maxPrice");
				$stmt->execute(array(':minPrice' => $minPrice, ':maxPrice' => $maxPrice));
			}
			
			$total = $stmt->rowCount();

			if ($total > 0) {
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {	
					self::website_card_produtos($dados);
				}
			} else {
				echo "<p class='text-center'>Nenhum produto foi encontrado</p>";
			}
		}

		public static function website_getInfosCategoria($id){
			if(isset($id)){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = :id");
				$stmt->execute([':id' => $id]);
				$total = $stmt->rowCount();

				if($total > 0){
					$dados = $stmt->fetch(PDO::FETCH_ASSOC);

					echo "<div class='r-title'>Eshop / Categoria / {$dados['categoria']}</div>
					<br>
					<div class='r-description'>
					{$dados['descricao']}
					</div>";
				}
			}
		}

		public static function website_getInfosSubCategoria($id){
			if(isset($id)){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM subcategorias WHERE id = :id");
				$stmt->execute([':id' => $id]);
				$total = $stmt->rowCount();

				if($total > 0){
					$dados = $stmt->fetch(PDO::FETCH_ASSOC);

					echo "<div class='r-title'>Produtos {$dados['subcategoria']}</div>";
				}
			}
		}

		public static function website_getIdFromCategoria($idsub, $val){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM subcategorias WHERE id = :id");
			$stmt->execute([':id' => $idsub]);
			$total = $stmt->rowCount();

			if($total > 0){
				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				return $dados[$val];
			}
		}

		public static function website_getIdFromSubCategoria($idsub, $val){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM subcategorias WHERE id_categoria = :id");
			$stmt->execute([':id' => $idsub]);
			$total = $stmt->rowCount();

			if($total > 0){
				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				return $dados[$val];
			}
		}

		public static function website_produtoFromCategoria($id){

			if(isset($id)){

				$pdo = db::pdo();
				$id_categoria = self::website_getIdFromSubCategoria($id, "id");

				$stmt = $pdo->prepare("SELECT * FROM produtos WHERE categoria = :categoria");
				$stmt->execute([':categoria' => $id_categoria]);
				$total = $stmt->rowCount();

				if($total > 0){
					while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {	
						echo "<div class='col-sm-4'>
				  <div class='product'>
				      <div class='p-title'>".self::website_limitaCaracteres($dados['nome'])."</div>
				      <div class='p-content'>
				        <img src='{$dados['foto']}'>
				        <div class='price'>
				          <span class='cf'>R$</span> 
				          <span class='prc'>{$dados['preco']}";
				          if($dados['tipo_fatura'] == 1){
								echo "<small>/Mes</small>";
							}
				          echo "</span>
				          </div>
				      </div>
				      <div class='p-footer'>
				        <a href='comprar/{$dados['id']}'><i class='fas fa-shopping-cart'></i> Comprar</a>
				        <span class='float-right'><a href='produto/{$dados['id']}'><i class='fas fa-plus'></i> Detalhes</a></span>
				      </div>
				    </div><br>
				</div>";
					}
				}
			}
		}

		public static function website_produtoFromSubCategoria($id){

			if(isset($id)){

				$pdo = db::pdo();
				$id_categoria = self::website_getIdFromCategoria($id, "id");

				$stmt = $pdo->prepare("SELECT * FROM produtos WHERE categoria = :categoria");
				$stmt->execute([':categoria' => $id_categoria]);
				$total = $stmt->rowCount();

				if($total > 0){
					while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {	
						self::website_card_produtos($dados);
					}
				}
				else {
					echo "<p class='text-center'>Nenhum produto foi encontrado</p>";
				}
			}
		}

		public static function website_getInfosGenero($id){
			if(isset($id)){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM generos WHERE id = :id");
				$stmt->execute([':id' => $id]);
				$total = $stmt->rowCount();

				if($total > 0){
					$dados = $stmt->fetch(PDO::FETCH_ASSOC);

					echo "<div class='r-title'>Produtos {$dados['nome']}</div>";
				}
			}
		}

		public static function website_getIdFromGenero($id){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM generos WHERE id = :id");
			$stmt->execute([':id' => $id]);
			$total = $stmt->rowCount();

			if($total > 0){
				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				return $dados["id"];
			}
		}

		public static function website_produtoFromGenero($id){
			if(isset($id)){
				$pdo = db::pdo();
				$id_genero = self::website_getIdFromGenero($id);

				$stmt = $pdo->prepare("SELECT * FROM produtos WHERE genero = :genero");
				$stmt->execute([':genero' => $id_genero]);
				$total = $stmt->rowCount();

				if($total > 0){
					while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {	
						self::website_card_produtos($dados);
					}
				}
				else {
					echo "<p class='text-center'>Nenhum produto foi encontrado</p>";
				}
			}
		}

		public static function website_getDadosFatura($id, $val){
			$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM faturas WHERE id = :id");
				$stmt->execute([':id' => $id]);

				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				return $dados[$val];
		}

		public static function website_getDadosCliente($val){
			if(isset($_SESSION['userEmail'])){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = :email");
				$stmt->execute([':email' => $_SESSION['userEmail']]);

				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				return $dados[$val];
			}
		}

		public static function website_getDetailsCompra($id_fatura, $val){
			$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM compras WHERE id_fatura = :id_fatura");
				$stmt->execute([':id_fatura' => $id_fatura]);

				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				return $dados[$val];
		}

		public function website_getDadosCompra($explode){
			if(isset($explode)){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM compras WHERE id_fatura = :id_fatura");
				$stmt->execute([':id_fatura' => $explode]);

				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				$status_fatura = $this->website_getDadosFatura($dados['id_fatura'], 'status');
				// $statusN;

				switch ($status_fatura) {
					case 0:
						$statusN = "<span class='badge badge-danger badge-fix'>Aguardando Pagamento</span>";
						break;
					
					case 1:
						$statusN = "<span class='badge badge-success badge-fix'>Pago</span>";
						break;
				}

				echo "<tr>
                  <td>1</td>
                  <td>{$dados['nome_produto']}</td>
                  <td>{$dados['data_compra']}</td>
                  <td class='text-danger'>{$this->website_getDadosFatura($dados['id_fatura'], 'data_vencimento')}</td>
                  <td>R$ {$this->website_getDadosFatura($dados['id_fatura'], 'preco')}</td>
                  <td>{$statusN}</td>
                </tr>";
			}
		}

		public function website_paginaCarrinho() {
			
		}


		public function website_verficaFaturaCliente($id){
			$id_cliente = $this->website_getDetailsCompra($id, "id_comprador");

			if($id_cliente != $_SESSION['userId']){
				website::website_direciona("dashboard");
				exit();
			}
		}


		public static function website_alterarDadosCliente(){
			if(isset($_POST['alt']) && $_POST['alt'] == "cad"){

				try{
					$pdo = db::pdo();
					$stmt = $pdo->prepare("UPDATE clientes SET 
						nome = :nome, 
						endereco = :endereco, 
						numero = :numero, 
						senha = :senha, 
						cep = :cep, 
						telefone = :telefone, 
						bairro = :bairro, 
						cidade = :cidade, 
						estado = :estado 
						WHERE email = :email");

					$stmt->execute([':nome' => $_POST['nome'],
								':endereco' => $_POST['endereco'],
								':numero' => $_POST['numero'],
								':senha' => $_POST['senha'],
								':cep' => $_POST['cep'],
								':telefone' => $_POST['telefone'],
								':bairro' => $_POST['bairro'],
								':cidade' => $_POST['cidade'],
								':estado' => $_POST['estado'],
								':email' => $_SESSION['userEmail']]);

					$total = $stmt->rowCount();

					if($total > 0){
						$mensagemHtml = "Dados Alterados com sucesso!";
						self::website_pop_up($mensagemHtml);
						self::website_direciona("me");
					}

				}catch(PDOException $e){
					$e->getMessage();
				}
			}
		}
		public static function website_alterarDadosSeller(){
			if(isset($_POST['alt']) && $_POST['alt'] == "cad"){

				try{
					$pdo = db::pdo();
					$stmt = $pdo->prepare("UPDATE vendedores SET 
						nome = :nome, 
						senha = :senha, 
						cep = :cep,
						cpf = :cpf, 
						bio = :bio,
						telefone = :telefone, 
						endereco = :endereco, 
						numero = :numero, 
						bairro = :bairro, 
						cidade = :cidade,
						estado = :estado 
						WHERE email = :email");

					$stmt->execute([':nome' => $_POST['nome'],
						
								':senha' => $_POST['senha'],
								':cep' => $_POST['cep'],
								':cpf' => $_POST['cpf'],
								':bio' => $_POST['bio'],
								':telefone' => $_POST['telefone'],
								':endereco' => $_POST['endereco'],
								':numero' => $_POST['numero'],
								':bairro' => $_POST['bairro'],
								':cidade' => $_POST['cidade'],
								':estado' => $_POST['estado'],
								':email' => $_SESSION['userEmail']]);

					$total = $stmt->rowCount();

					if($total > 0){
						$mensagemHtml = "Dados Alterados com sucesso!";
						self::website_pop_up($mensagemHtml);
						self::website_direciona("me");
					}

				}catch(PDOException $e){
					$e->getMessage();
				}
			}
		}

		public function website_cliente_compras(){
			$pdo = db::pdo();
			$stmt = $pdo->prepare("SELECT * FROM compras WHERE id_comprador = :id_comprador ORDER BY id DESC");
			$stmt->execute([':id_comprador' => $_SESSION['userId']]);

			$total = $stmt->rowCount();
			if($total > 0){
			while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
				// $msgCompra;
				// $msgFatura;

				switch($dados['status']){

					case 0:
						$msgCompra = "<span class='badge badge-warning badge-fix'>Processando</span>";
					break;

					case 1:
						$msgCompra = "<span class='badge badge-success badge-fix'>Entregue</span>";
					break;

				}

				switch($this->website_getDadosFatura($dados['id_fatura'], "status")){

					case 0:
						$msgFatura = "<span class='badge badge-danger badge-fix'>Aguardando Pagamento</span>";
					break;

					case 1:
						$msgFatura = "<span class='badge badge-success badge-fix'>Pago</span>";
					break;

				}

				echo "<tr>
			<td>{$dados['id']}</td>
			<td>{$dados['nome_produto']}</td>
			<td>{$msgCompra}</td>
			<td>{$msgFatura}</td>
			<td><a href='fatura/{$dados['id_fatura']}' class='btn btn-primary btn-sm btn-default'>Ver Detalhes</a></td>
		</tr>";
				}
			}
		}

		public function website_cliente_faturas(){
			$pdo = db::pdo();
			$stmt = $pdo->prepare("SELECT * FROM faturas WHERE id_cliente = :id_cliente ORDER BY id DESC");
			$stmt->execute([':id_cliente' => $_SESSION['userId']]);

			$total = $stmt->rowCount();
			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					switch($dados['status']){
						case 0:
							$msgFatura = "<span class='badge badge-danger badge-fix'>Aguardando Pagamento</span>";
						break;
						
						case 1:
							$msgFatura = "<span class='badge badge-success badge-fix'>Pago</span>";
						break;
					}

					echo "
						<tr>
							<td>{$dados['id']}</td>
							<td>{$this->website_getDetailsCompra($dados['id'], "nome_produto")}</td>
							<td>{$msgFatura}</td>
							<td><a href='fatura/{$dados['id']}' class='btn btn-primary btn-sm btn-default'>Ver Detalhes</a></td>
						</tr>
					";
				}
			}
		}

		public static function website_verifica_cadastro_vendedor($email){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM vendedores WHERE email = :email");
			$stmt->execute([':email' => $email]);

			return $stmt->rowCount();
		}

		public static function website_verifica_cadastro($email){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = :email");
			$stmt->execute([':email' => $email]);

			return $stmt->rowCount();
		}

		public static function website_register(){
			if(isset($_POST['cad']) && $_POST['cad'] == "astro"){
				$userAlreadyExists = self::website_verifica_cadastro($_POST['email']);

				if($userAlreadyExists > 0){
					$mensagemHtml = "Email já cadastrado! Por favor, tente outro!";
					self::website_pop_up($mensagemHtml);
				}else{
					$pdo = db::pdo();

					$stmt = $pdo->prepare(
                        "INSERT INTO clientes (
                            nome, 
                            email,
                            telefone,                            
                            senha,
														endereco,
														numero,
                            cep,
                            bairro,
                            cidade,
                            estado,
                            genero,
                            created_at
						) VALUES (
                            :nome, 
                            :email,
                            :telefone,                            
                            :senha,
														:endereco,
														:numero,
                            :cep,
                            :bairro,
                            :cidade,
                            :estado,
                            :genero,
                            NOW()
                        )
                    ");

					$stmt->execute([
                        ':nome' => $_POST['nome'],
                        ':email' => $_POST['email'],
                        ':telefone' => $_POST['telefone'],
                        ':senha' => $_POST['senha'],
												':endereco' => $_POST['endereco'],
												':cep' => $_POST['cep'],
                        ':numero' => $_POST['numero'],
                        ':bairro' => $_POST['bairro'],
                        ':cidade' => $_POST['cidade'],
                        ':estado' => $_POST['estado'],
                        ':genero' => $_POST['genero']
                    ]);

					$result = $stmt->rowCount();

					if($result > 0){
						$dados = $stmt->fetch(PDO::FETCH_ASSOC);
						$_SESSION['userEmail'] = $dados['email'];
						$_SESSION['userId'] = $dados['id'];
						$mensagemHtml = "Cadastro Efetuado com sucesso!";
						self::website_pop_up($mensagemHtml);
						self::website_direciona("enter");
					}
					else {
						$mensagemHtml = "Erro ao realizar cadastro!";
						self::website_pop_up($mensagemHtml);
					}
				}
			}
		}

    public static function website_register_seller(){
			if(isset($_POST['cad']) && $_POST['cad'] == "astroVendedor"){
				$userAlreadyExists = self::website_verifica_cadastro_vendedor($_POST['email']);

				if($userAlreadyExists > 0){
					$mensagemHtml = "Email já cadastrado! Por favor, tente outro!";
					self::website_pop_up($mensagemHtml);
				} else{
					$pdo = db::pdo();

					$uploaddir = 'images/uploads/seller-profile/';
					$uploaddirN = 'images/uploads/seller-profile/';
					$imagemPerfilGenerico = 'perfil-generico.png';

					$uploadfile = "";
					$uploadfileN = $uploaddirN . $imagemPerfilGenerico;

					if ($_FILES['foto-vendedor']['size'] > 0) {
						$nomePersonalizadoPerfilUpload = round(microtime(true) * 1000) . '-' . basename($_FILES['foto-vendedor']['name']);

						$uploadfile = $uploaddir . $nomePersonalizadoPerfilUpload;
						$uploadfileN = $uploaddirN . $nomePersonalizadoPerfilUpload;
					}

					$stmt = $pdo->prepare(
						"INSERT INTO vendedores (
							nome, 
							email,
							telefone,
							bio,
							avatar,
							genero,
							cpf,
							endereco,
							numero,
							cep,
							estado,
							cidade,
							bairro,
							senha,
							created_at
						) VALUES (
							:nome, 
							:email,
							:telefone,
							:bio,
							:avatar,
							:genero,
							:cpf,
							:endereco,
							:numero,
							:cep,
							:estado,
							:cidade,
							:bairro,
							:senha,
							NOW()
						)
					");

					$stmt->execute([
						':nome' => $_POST['nome'],
						':email' => $_POST['email'],
						':telefone' => $_POST['telefone'],
						':bio' => $_POST['bio'],
						':avatar' => $uploadfileN,
						':genero' => $_POST['genero'],
						':cpf' => $_POST['cpf'],
						':endereco' => $_POST['endereco'],
						':numero' => $_POST['numero'],
						':cep' => $_POST['cep'],
						':estado' => $_POST['estado'],
						':cidade' => $_POST['cidade'],
						':bairro' => $_POST['bairro'],
						':senha' => $_POST['senha'],
					]);

					$result = $stmt->rowCount();

					if($result > 0){
						$dados = $stmt->fetch(PDO::FETCH_ASSOC);
						$_SESSION['userEmail'] = $dados['email'];
						$_SESSION['userId'] = $dados['id'];

						if ($_FILES['foto-vendedor']['size'] > 0) {
							move_uploaded_file($_FILES['foto-vendedor']['tmp_name'], $uploadfile);
						}

						$mensagemHtml = "Cadastro Efetuado com sucesso!";
						self::website_pop_up($mensagemHtml);

						self::website_direciona("entrar-como-vendedor");
					}
					else {
						$mensagemHtml = "Erro ao realizar cadastro!";
						self::website_pop_up($mensagemHtml);
					}
				}
			}
		}

		public static function website_admin_getCategorias(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM categorias ORDER BY categoria ASC");
			$stmt->execute();
			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<option value='{$dados['id']}'>{$dados['categoria']}</option>";
				}
			}
		}

		public static function website_admin_getCategoriaN($idSubcategoriaSelecionada = ''){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM categorias ORDER BY categoria ASC");
			$stmt->execute();
			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<optgroup label='{$dados['categoria']}'>".
						self::website_admin_getSubCategorias($dados['id'], $idSubcategoriaSelecionada)."
					</optgroup>";
				}
			}
		}

		public static function website_admin_getSubCategorias($idCategoria, $idSubcategoriaSelecionada = ''){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM subcategorias WHERE id_categoria = :id_categoria ORDER BY subcategoria ASC");
			$stmt->execute([':id_categoria' => $idCategoria]);
			$total = $stmt->rowCount();

			$subcategoriasHtml = "";

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$subcategoriasHtml .= $dados['id'] == $idSubcategoriaSelecionada
						? "<option value='{$dados['id']}' selected>{$dados['subcategoria']}</option>"
						: "<option value='{$dados['id']}'>{$dados['subcategoria']}</option>";
				}

				return $subcategoriasHtml;
			}
		}

		public static function website_admin_getGeneros($id = ''){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM generos ORDER BY nome ASC");
			$stmt->execute();
			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					if ($dados['id'] === $id) {
						echo "<option value='{$dados['id']}' selected>{$dados['nome']}</option>";
					} else {
						echo "<option value='{$dados['id']}'>{$dados['nome']}</option>";
					}
				}
			}
		}

		public static function website_admin_getNomeGenero($id) {
			$pdo = db::pdo();
			$stmt = $pdo->prepare("SELECT nome FROM generos WHERE id = :id");
			$stmt->execute([':id' => $id]);
			$result = $stmt->rowCount();
			
			if ($result > 0) {
				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				return $dados['nome'];
			}
		}

		public static function website_admin_cadastrarProduto(){
			if(isset($_POST['env']) && $_POST['env'] == "prod"){
				if($_FILES['produtofile']['size'] <= 0){
					echo "<div class='alert alert-danger'>Insira uma imagem para prosseguir</div>";
				}else{
					$pdo = db::pdo();
					$uploaddir = '../images/uploads/';
					$uploaddirN = 'images/uploads/';

					$nomePersonalizadoFileUpload = round(microtime(true) * 1000) . '-' . basename($_FILES['produtofile']['name']);
					$uploadfile = $uploaddir . $nomePersonalizadoFileUpload;
					$uploadfileN = $uploaddirN . $nomePersonalizadoFileUpload;

					$stmt = $pdo->prepare("INSERT INTO produtos 
						(nome,
						foto,
						tipo_fatura,
						estoque,
						preco,
						categoria,
						genero,
						detalhes,
						publicado_em,
						alterado_em) 

						VALUES

						(:nome, 
						:foto, 
						:tipo_fatura, 
						:estoque, 
						:preco,
						:categoria,
						:genero,
						:detalhes,
						NOW(),
						NOW())");
                        
					$stmt->execute([
						':nome' => $_POST['nome'],
						':foto' => $uploadfileN,
						':tipo_fatura' => $_POST['tipo_fatura'],
						':estoque' => $_POST['estoque'],
						':preco' => $_POST['valor'],
						':categoria' => $_POST['categoria'],
						':genero' => $_POST['genero'],
						':detalhes' => $_POST['detalhes']
                    ]);

					$result = $stmt->rowCount();

					if($result > 0){
						echo "<div class='alert alert-success'>produto cadastrado com sucesso!</div>";
						move_uploaded_file($_FILES['produtofile']['tmp_name'], $uploadfile);
					}else{
						echo "<div class='alert alert-danger'>Erro ao cadastrar</div>";
					}
				}
			}
		}

		public static function website_admin_cadastrarProdutoVendedor(){
			if(isset($_POST['env']) && $_POST['env'] == "prod"){
				if($_FILES['produtofile']['size'] <= 0){
					echo "<div class='alert alert-danger'>Insira uma imagem para prosseguir</div>";
				}else{
					$pdo = db::pdo();
					$uploaddir = 'images/uploads/';
					$uploaddirN = 'images/uploads/';

					$nomePersonalizadoFileUpload = round(microtime(true) * 1000) . '-' . basename($_FILES['produtofile']['name']);					
					$uploadfile = $uploaddir . $nomePersonalizadoFileUpload;
					$uploadfileN = $uploaddirN . $nomePersonalizadoFileUpload;

					$stmt = $pdo->prepare("INSERT INTO produtos 
						(nome,
						foto,
						tipo_fatura,
						estoque,
						preco,
						categoria,
						genero,
						detalhes,
						publicado_em,
						alterado_em) 

						VALUES

						(:nome, 
						:foto, 
						:tipo_fatura, 
						:estoque, 
						:preco,
						:categoria,
						:genero,
						:detalhes,
						NOW(),
						NOW())");
                        
					$stmt->execute([
						':nome' => $_POST['nome'],
						':foto' => $uploadfileN,
						':tipo_fatura' => $_POST['tipo_fatura'],
						':estoque' => $_POST['estoque'],
						':preco' => $_POST['valor'],
						':categoria' => $_POST['categoria'],
						':genero' => $_POST['genero'],
						':detalhes' => $_POST['detalhes']
                    ]);

					$result = $stmt->rowCount();

					if($result > 0){
						$mensagemHtml = "Produto cadastrado com sucesso!";
						website::website_pop_up($mensagemHtml);
						move_uploaded_file($_FILES['produtofile']['tmp_name'], $uploadfile);
					}else{
						$mensagemHtml = "Erro ao cadastrar!";
						website::website_pop_up($mensagemHtml);
					}
				}
			}
		}

		public static function website_admin_getNomeCategoria($id){
			$pdo = db::pdo();
			$stmt = $pdo->prepare("SELECT subcategoria FROM subcategorias WHERE id = :id");
			$stmt->execute([':id' => $id]);

			$dados = $stmt->fetch(PDO::FETCH_ASSOC);

			return $dados['subcategoria'];
		}

		public static function website_admin_getInfosCompras($id, $val){
			$pdo = db::pdo();
			$stmt = $pdo->prepare("SELECT * FROM compras WHERE id = :id");
			$stmt->execute([':id' => $id]);

			$dados = $stmt->fetch(PDO::FETCH_ASSOC);

			return $dados[$val];
		}

		public static function website_admin_getInfosFromIdFatura($id, $val){
			$pdo = db::pdo();
			$stmt = $pdo->prepare("SELECT * FROM compras WHERE id_fatura = :id");
			$stmt->execute([':id' => $id]);

			$dados = $stmt->fetch(PDO::FETCH_ASSOC);

			return $dados[$val];
		}

		public static function website_admin_buscarproduto(){
			if(isset($_POST['env']) && $_POST['env'] == "busca"){
				$busca = "%{$_POST['resultado']}%";

				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM produtos WHERE nome LIKE :nome OR preco LIKE :preco");
				$stmt->execute([':nome' => $busca, ':preco' => $busca]);
				$result = $stmt->rowCount();

				if($result > 0){
					while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr>
				  <td><img src='../{$dados['foto']}' width='30'></td>
				  <td>{$dados['nome']}</td>
				  <td>{$dados['preco']}</td>
				  <td><span class='badge badge-dark'>".self::website_admin_getNomeCategoria($dados['categoria'])."</span></td>
				  <td>
				    <a href='editar-produto/{$dados['id']}' class='btn btn-outline-primary btn-sm'>Editar</a>
				    <a href='deletar-produto/{$dados['id']}' class='btn btn-outline-danger btn-sm'>Deletar</a>
				  </td>
				</tr>";
					}
				}
			}
		}
		public static function website_seller_buscarproduto(){
			if(isset($_POST['env']) && $_POST['env'] == "busca"){
				$busca = "%{$_POST['resultado']}%";

				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM produtos WHERE nome LIKE :nome OR preco LIKE :preco");
				$stmt->execute([':nome' => $busca, ':preco' => $busca]);
				$result = $stmt->rowCount();

				if($result > 0){
					while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr>
				  <td><img src='{$dados['foto']}' width='30'></td>
				  <td>{$dados['nome']}</td>
				  <td>{$dados['preco']}</td>
				  <td><span class='badge badge-dark'>".self::website_admin_getNomeCategoria($dados['categoria'])."</span></td>
				  <td>
				    <a href='editar-produto-seller/{$dados['id']}' class='btn btn-outline-primary btn-sm'>Editar</a>
				    <a href='deletar-produto-seller/{$dados['id']}' class='btn btn-outline-danger btn-sm'>Deletar</a>
				  </td>
				</tr>";
					}
				}
			}
		}

		public static function website_admin_getProdutos(){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM produtos ORDER BY id DESC");
				$stmt->execute();
				$total = $stmt->rowCount();

				if($total > 0){
					while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
						echo "<tr>
				  <td><img src='../{$dados['foto']}' width='30'></td>
				  <td>{$dados['nome']}</td>
				  <td>R$ {$dados['preco']}</td>
				  <td><span class='badge badge-dark'>".self::website_admin_getNomeCategoria($dados['categoria'])."</span></td>
				  <td>
				    <a href='editar-produto/{$dados['id']}' class='btn btn-outline-primary btn-sm'>Editar</a>
				    <a href='deletar-produto/{$dados['id']}' class='btn btn-outline-danger btn-sm'>Deletar</a>
				  </td>
				</tr>";
					}
				}
		}
		public static function website_seller_getProdutos(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM produtos ORDER BY id DESC");
			$stmt->execute();
			$total = $stmt->rowCount();

			if($total > 0){
				while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
					$htmlDadosProdutos = "
						<tr>
							<td><img src='{$dados['foto']}' width='30'></td>
							<td>{$dados['nome']}</td>
							<td>R$ {$dados['preco']}</td>
					";

					$htmlDadosProdutos .= $dados['estoque'] <= 0  
						? "<td><span style='min-width: 40px !important;' class='badge badge-fix badge-danger'>{$dados['estoque']}</span></td>" 
						: "<td><span style='min-width: 40px !important;' class='badge badge-fix badge-success'>{$dados['estoque']}</span></td>";
					
					$htmlDadosProdutos .= "
							<td><span class='badge badge-fix'>".self::website_admin_getNomeCategoria($dados['categoria'])."</span></td>
							<td>
								<a href='editar-produto-seller/{$dados['id']}' class='btn btn-outline-primary btn-sm'>Editar</a>
								<a href='deletar-produto-seller/{$dados['id']}' class='btn btn-outline-danger btn-sm'>Deletar</a>
							</td>
						</tr>
					";

					echo $htmlDadosProdutos;
				}
			}
	}

		public static function website_admin_altProduto($id){
			if(isset($_POST['alt']) && $_POST['alt'] == "prod"){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("UPDATE produtos SET 
					nome = :nome,
					estoque = :estoque,
					preco = :preco,
					tipo_fatura = :tipo_fatura,
					categoria = :categoria,
					genero = :genero,
					detalhes = :detalhes,
					alterado_em = NOW() WHERE id = :id");
				$stmt->execute(
					[':nome' => $_POST['nome'],
					':estoque' => $_POST['estoque'],
					':preco' => $_POST['valor'],
					':tipo_fatura' => $_POST['tipo_fatura'],
					':categoria' => $_POST['categoria'],
					':genero' => $_POST['genero'],
					':detalhes' => $_POST['detalhes'],
					':id' => $id]);
				$total = $stmt->rowCount();

				if($total > 0){
					echo "<div class='alert alert-success'>Dados Alterados com sucesso!</div>";
					self::website_direciona("editar-produto/{$id}");
				}else{
					echo "<div class='alert alert-danger'>Erro ao alterar</div>";
				}
			}
		}

		public static function website_seller_altProduto($id){
			if(isset($_POST['alt']) && $_POST['alt'] == "prod"){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("UPDATE produtos SET 
					nome = :nome,
					estoque = :estoque,
					preco = :preco,
					tipo_fatura = :tipo_fatura,
					categoria = :categoria,
					genero = :genero,
					detalhes = :detalhes,
					alterado_em = NOW() WHERE id = :id");
				$stmt->execute(
					[':nome' => $_POST['nome'],
					':estoque' => $_POST['estoque'],
					':preco' => $_POST['valor'],
					':tipo_fatura' => $_POST['tipo_fatura'],
					':categoria' => $_POST['categoria'],
					':genero' => $_POST['genero'],
					':detalhes' => $_POST['detalhes'],
					':id' => $id]);
				$total = $stmt->rowCount();

				if($total > 0){
					$mensagemHtml = "Dados alterados com sucesso!";
					website::website_pop_up($mensagemHtml);
					self::website_direciona("editar-produto-seller/{$id}");
				}else{
					$mensagemHtml = "Erro ao alterar!";
					website::website_pop_up($mensagemHtml);
				}
			}
		}

		public static function website_admin_delete($tabela, $coluna, $id, $backpage){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("DELETE FROM {$tabela} WHERE {$coluna} = :id");
			$stmt->execute([':id' => $id]);
			$count = $stmt->rowCount();

			if($count > 0){
				if($backpage != false){
					self::website_direciona($backpage);	
				}
			}else{
				echo "<div class='alert alert-danger'>Erro ao alterar</div>";
			}
		}
		public static function website_seller_delete($tabela, $coluna, $id, $backpage){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("DELETE FROM {$tabela} WHERE {$coluna} = :id");
			$stmt->execute([':id' => $id]);
			$count = $stmt->rowCount();

			if($count > 0){
				$mensagemHtml = "Deletado com sucesso!";
				website::website_pop_up($mensagemHtml);
			}else{
				$mensagemHtml = "Erro ao deletar!";
				website::website_pop_up($mensagemHtml);
			}

			if($backpage != false){
				self::website_direciona($backpage);	
			}
		}

		public static function website_admin_addCategorias(){
			if(isset($_POST['alt']) && $_POST['alt'] == "cat"){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("INSERT INTO categorias (categoria, descricao) VALUES (:categoria, :descricao)");
				$stmt->execute([':categoria' => $_POST['categoria'],
								':descricao' => $_POST['descricao']]);
				$total = $stmt->rowCount();

				if($total > 0){
					echo "<br><div class='alert alert-success'>Categoria criada com sucesso!</div>";
					self::website_direciona("gerenciar-categorias");
				}else{
					echo "<br><div class='alert alert-danger'>Erro ao adicionar</div>";
				}
			}
		}

		public static function website_admin_addSubcategorias(){
			if(isset($_POST['alt']) && $_POST['alt'] == "cat"){
				$pdo = db::pdo();

				$stmt = $pdo->prepare("INSERT INTO subcategorias (id_categoria, subcategoria, descricao) VALUES (:id_categoria, :subcategoria, :descricao)");
				$stmt->execute([':id_categoria' => $_POST['categoria'],
								':subcategoria' => $_POST['subcategoria'],
								':descricao' => $_POST['descricao']]);
				$total = $stmt->rowCount();

				if($total > 0){
					echo "<br><div class='alert alert-success'>Subcategoria criada com sucesso!</div>";
					self::website_direciona("gerenciar-categorias");
				}else{
					echo "<br><div class='alert alert-danger'>Erro ao adicionar</div>";
				}
			}
		}

		public static function website_admin_getCategoria(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM categorias ORDER BY categoria ASC");
			$stmt->execute();

			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>
                  <td>{$dados['id']}</td>
                  <td>{$dados['categoria']}</td>
                  <td>
                    <a href='deletar-categoria/{$dados['id']}' class='btn btn-outline-danger btn-sm'>Deletar Categoria</a>
                  </td>
                </tr>";
				}
			}
		}

		public static function website_admin_getSubCategoria(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM subcategorias ORDER BY subcategoria ASC");
			$stmt->execute();

			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>
						<td>{$dados['id']}</td>
						<td>{$dados['subcategoria']}</td>
						<td>
							<a href='deletar-subcategoria/{$dados['id']}' class='btn btn-outline-danger btn-sm'>Deletar Subcategoria</a>
						</td>
						</tr>";
				}
			}
		}

		public static function website_admin_getDadosCliente($id, $val){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = :email");
			$stmt->execute([':email' => $id]);

			$dados = $stmt->fetch(PDO::FETCH_ASSOC);

			return $dados[$val];
		}

		public static function website_pop_up($html) {
			echo "
				<div class='pop-up'>
					<span>
						{$html}
					</span>
				</div>
			";
		}

		public static function website_admin_modalDetailProduto($id, $informacoes){
			echo "<div class='modal fade' id='exampleModal{$id}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel{$id}' aria-hidden='true'>
				<div class='modal-dialog' role='document'>
				<div class='modal-content'>
					<div class='modal-header'>
					<h5 class='modal-title' id='exampleModalLabel{$id}'>Informações Adicionais</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
					</div>
					<div class='modal-body'>
					{$informacoes}
					</div>
				</div>
				</div>
			</div>";
		}

		public static function website_admin_modalDetailCliente($id, $cliente){
			$nome = self::website_admin_getDadosCliente($cliente, "nome");
			$telefone = self::website_admin_getDadosCliente($cliente, "telefone");
			$endereco = self::website_admin_getDadosCliente($cliente, "endereco");
			$complemento = self::website_admin_getDadosCliente($cliente, "complemento");
			$bairro = self::website_admin_getDadosCliente($cliente, "bairro");
			$estado = self::website_admin_getDadosCliente($cliente, "estado");
			$cep = self::website_admin_getDadosCliente($cliente, "cep");

				echo "<div class='modal fade' id='exampleModal{$id}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel{$id}' aria-hidden='true'>
				  <div class='modal-dialog' role='document'>
				    <div class='modal-content'>
				      <div class='modal-header'>
				        <h5 class='modal-title' id='exampleModalLabel{$id}'>Vendo Cliente {$nome}</h5>
				        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
				          <span aria-hidden='true'>&times;</span>
				        </button>
				      </div>
				      <div class='modal-body'>
				       Nome: {$nome}<br>
				       Email: {$cliente}<br>
				       Telefone: {$telefone}<br>
				       Endereço: {$endereco}<br>
				       Cep: {$cep}<br>
				       Bairro: {$bairro}<br>
				       Estado: {$estado}<br>

				      </div>
				    </div>
				  </div>
				</div>";
		}

		public static function website_admin_geCompras(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM compras ORDER BY id DESC");
			$stmt->execute();
			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$status = self::website_getDadosFatura($dados['id_fatura'], "status");

					if($status == 1 && $dados['status'] == 0){
						echo "<tr>
				  <td>1</td>
				  <td><a href='ver-cliente/{$dados['id_comprador']}' target='_blank'>".self::website_admin_getDadosCliente($dados['id_comprador'], "nome")."</a></td>
				  <td>R$ ".self::website_getDadosFatura($dados['id_fatura'], "preco")."</td>
				  <td>{$dados['external_reference']}</td>
				  <td>
				    <a class='btn btn-outline-primary btn-sm' data-toggle='modal' data-target='#exampleModal{$dados['id']}'>Ver detalhes</a>
				    <a href='marcar-entregue/{$dados['id_fatura']}' class='btn btn-outline-success btn-sm'>Entregue</a>
				    <a href='deletar-venda/{$dados['id_fatura']}' class='btn btn-outline-danger btn-sm'>Deletar</a>
				  </td>
				</tr>";
				self::website_admin_modalDetailProduto($dados['id'], $dados['detalhes']);
					}
				}
			}
		}


		public static function website_admin_geComprasCliente($cliente){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM compras WHERE id_comprador = :id_comprador ORDER BY id DESC");
			$stmt->execute([':id_comprador' => $cliente]);
			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$status = self::website_getDadosFatura($dados['id_fatura'], "status");
						echo "<tr>
				  <td>1</td>
				  <td>{$dados['nome_produto']}</td>
				  <td>R$ ".self::website_getDadosFatura($dados['id_fatura'], "preco")."</td>
				  <td>
				    <a class='btn btn-outline-primary btn-sm' data-toggle='modal' data-target='#exampleModal{$dados['id']}'>Ver detalhes</a> ";

				    if($status == 1){

				    echo "<a href='marcar-entregue/{$dados['id_fatura']}' class='btn btn-outline-success btn-sm'>Entregue</a> ";
					}
				    echo "<a href='deletar-venda/{$dados['id_fatura']}' class='btn btn-outline-danger btn-sm'>Deletar</a>
				  </td>
				</tr>";
				self::website_admin_modalDetailProduto($dados['id'], $dados['detalhes']);
				}
			}
		}

		public static function website_admin_getFaturasCliente($cliente){
			$pdo = db::pdo();


			$stmt = $pdo->prepare("SELECT * FROM faturas WHERE id_cliente = :id_cliente ORDER BY id DESC");
			$stmt->execute([':id_cliente' => $cliente]);
			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
				// $statusF;

				switch($dados['status']){
					case 0:
						$statusF = "<span class='badge badge-danger badge-fix'>Aguardando Pagamento</span>";
					break;

					case 1:
						$statusF = "<span class='badge badge-success badge-fix'>Pago</span>";
					break;
				}
			echo "<tr>
		  <td>{$dados['id']}</td>
		  <td>".self::website_admin_getInfosCompras($dados['id'],"nome_produto")."</td>
		  <td>R$ {$dados['preco']}</td>
		  <td>{$statusF}</a>
		  </td>
		</tr>";
				}
			}
		}

		public static function website_admin_geComprasConcluidas(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM compras WHERE status = :status ORDER BY id DESC");
			$stmt->execute([':status' => 1]);
			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$status = self::website_getDadosFatura($dados['id_fatura'], "status");

						echo "<tr>
				  <td>1</td>
				  <td><a href='ver-cliente/{$dados['id_comprador']}' target='_blank'>".self::website_admin_getDadosCliente($dados['id_comprador'], "nome")."</a></td>
				  <td>R$ ".self::website_getDadosFatura($dados['id_fatura'], "preco")."</td>
				  <td>
				    <a class='btn btn-outline-primary btn-sm' data-toggle='modal' data-target='#exampleModal{$dados['id']}'>Ver detalhes</a>
				  </td>
				</tr>";
				self::website_admin_modalDetailProduto($dados['id'], $dados['detalhes']);
				}
			}
		}



		public static function website_admin_delCompras($id){
			self::website_admin_delete("compras", "id_fatura", $id, "gerenciar-compras");
			self::website_admin_delete("faturas", "id", $id, false);
			exit();
		}

		public static function website_admin_delCategoria($id){
			self::website_admin_delete("categorias", "id", $id, "gerenciar-categorias");
			self::website_admin_delete("subcategorias", "id_categoria", $id, false);
			exit();
		}


		public static function website_admin_buscarCompras(){

			if(isset($_POST['env']) && $_POST['env'] == "busca"){
				$pdo = db::pdo();
				$resultado = "%{$_POST['resultado']}%";
				$stmt = $pdo->prepare("SELECT * FROM compras WHERE id_comprador LIKE :id_comprador ORDER BY id DESC");
				$stmt->execute([':id_comprador' => $resultado]);
				$total = $stmt->rowCount();

				if($total > 0){
					while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$status = self::website_getDadosFatura($dados['id_fatura'], "status");
					
					echo "<tr>
				  <td>{$dados['id']}</td>
				  <td>{$dados['nome_produto']}</td>
				  <td><a href='ver-cliente/{$dados['id_comprador']}' target='_blank'>".self::website_admin_getDadosCliente($dados['id_comprador'], "nome")."</a></td>
				  <td>R$ ".self::website_getDadosFatura($dados['id_fatura'], "preco")."</td>
				  <td>
				    <a class='btn btn-outline-primary btn-sm' data-toggle='modal' data-target='#exampleModal{$dados['id']}'>Ver Detalhes</a>";
				    if($status == 1 && $dados['status'] == 0){
				    echo "<a href='marcar-entregue/{$dados['id']}' class='btn btn-outline-success btn-sm'>Entregue</a>";};
				   echo "<a href='deletar-venda/{$dados['id']}' class='btn btn-outline-danger btn-sm'>Deletar</a>
				  </td>
				</tr>";
				self::website_admin_modalDetailProduto($dados['id'], $dados['detalhes']);
					}
				}
			}
		}

		public static function website_admin_updateFatura($id, $backpage){
			$pdo = db::pdo();

			try{
				$stmt = $pdo->prepare("UPDATE faturas SET status = :status WHERE id = :id");
				$stmt->execute([':status' => 1, 
								':id' => $id]);

				$resultado = $stmt->rowCount();

				if($resultado > 0){
					self::website_direciona($backpage);
					exit();
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public static function website_admin_updateCompra($id, $backpage){
			$pdo = db::pdo();

			try{
				$stmt = $pdo->prepare("UPDATE compras SET status = :status WHERE id = :id");
				$stmt->execute([':status' => 1, 
								':id' => $id]);

				$resultado = $stmt->rowCount();

				if($resultado > 0){
					self::website_direciona($backpage);
					exit();
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}


		public static function website_admin_getPendingFaturas(){
			$pdo = db::pdo();


			$stmt = $pdo->prepare("SELECT * FROM faturas WHERE status = 0 ORDER BY id DESC");
			$stmt->execute();

			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$idVenda = self::website_admin_getInfosFromIdFatura($dados['id'], "id_fatura");
					echo "<tr>
		  <td>{$dados['id']}</td>
		  <td><a href='ver-cliente/{$dados['id_cliente']}' target='_blank'>".self::website_admin_getDadosCliente($dados['id_cliente'], "nome")."</a></td>
		  <td>".self::website_admin_getInfosFromIdFatura($dados['id'],"nome_produto")."</td>
		  <td>R$ {$dados['preco']}</td>
		  <td>".self::website_admin_getInfosFromIdFatura($dados['id'],"external_reference")."</td>
		  <td>
		    <a href='marcar-pago/{$dados['id']}' class='btn btn-outline-success btn-sm'>Marcar como pago</a> 
		    <a href='deletar-venda/{$idVenda}' class='btn btn-outline-danger btn-sm'>Deletar Fatura</a>
		  </td>
		</tr>";
				}
			}
		}

		public static function website_admin_getFaturasPagas(){
			$pdo = db::pdo();


			$stmt = $pdo->prepare("SELECT * FROM faturas WHERE status = 1 ORDER BY id DESC");
			$stmt->execute();

			$total = $stmt->rowCount();

			if($total > 0){
				while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>
		  <td>{$dados['id']}</td>
		  <td><a href='ver-cliente/{$dados['id_cliente']}' target='_blank'>".self::website_admin_getDadosCliente($dados['id_cliente'], "nome")."</a></td>
		  <td>".self::website_admin_getInfosFromIdFatura($dados['id'],"nome_produto")."</td>
		  <td>R$ {$dados['preco']}</td>
		</tr>";
				}
			}
		}

		public static function website_admin_buscaClientes(){
			$pdo = db::pdo();

			if(isset($_POST['env']) && $_POST['env'] == "busca"){
				$resultado = "%{$_POST['resultado']}%";
				$stmt = $pdo->prepare("SELECT * FROM clientes WHERE email LIKE :email OR nome like :email");
				$stmt->execute([':email' => $resultado]);
				$total = $stmt->rowCount();

				if($total > 0){
					while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr>
				  <td>-></td>
				  <td><a href='ver-cliente/{$dados['email']}' target='_blank'>{$dados['nome']}</a></td>
				  <td>{$dados['email']}</td>
				  <td><a data-toggle='modal' data-target='#exampleModal{$dados['id']}' class='btn btn-outline-info btn-sm'>Ver Cliente</a></td>
				</tr>";
				self::website_admin_modalDetailCliente($dados['id'], $dados['email']);
					}
				}
			}
		}

		public static function admin_badgeCompras(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM compras WHERE status = 0");
			$stmt->execute();
			$total = $stmt->rowCount();

			if($total > 0){
				echo "<span class='badge badge-danger'>{$total}</span>";	
			}
		}

		public static function admin_badgeFaturas(){
			$pdo = db::pdo();

			$stmt = $pdo->prepare("SELECT * FROM faturas WHERE status = 0");
			$stmt->execute();
			$total = $stmt->rowCount();

			if($total > 0){
				echo "<span class='badge badge-danger'>{$total}</span>";	
			}
		}
	}


	class clientes{
		private $id;
		public $nome;
		public $email;
		public $telefone;
		public $senha;
		public $endereco;
		public $numero;
		public $complemento;
		public $cep;
		public $cidade;
		public $estado;
		public $bairro;
		public $isadmin;

        public function getId() {
            return $this->id;
        }

		public function __construct(){
			if(isset($_SESSION['userEmail'])){
				$this->clientes_updatesInfos();
			}
		}

		public function clientes_updatesInfos(){
			$email = $_SESSION['userEmail'];

			try{
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = :email");
				$stmt->execute([':email' => $email]);

				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				$this->id = $dados['id'];
				$this->nome = $dados['nome'];
				$this->email = $dados['email'];
				$this->telefone = $dados['telefone'];
				$this->senha = $dados['senha'];
				$this->endereco = $dados['endereco'];
				$this->numero = $dados['numero'];
				$this->complemento = $dados['complemento'];
				$this->cep = $dados['cep'];
				$this->bairro = $dados['bairro'];
				$this->cidade = $dados['cidade'];
				$this->estado = $dados['estado'];
				$this->isadmin = $dados['isadmin'];
			
			}catch(PDOException $e){
				return $e->getMessage();
			}
		}
	}
	class vendedores{
		private $id;
		public $nome;
		public $email;
		public $telefone;
		public $senha;
		public $endereco;
		public $numero;
		public $cpf;
		public $bio;
		public $cep;
		public $cidade;
		public $estado;
		public $bairro;
		public $isadmin;

        public function getId() {
            return $this->id;
        }

		public function __construct(){
			if(isset($_SESSION['userEmail'])){
				$this->vendedores_updatesInfos();
			}
		}

		public function vendedores_updatesInfos(){
			$email = $_SESSION['userEmail'];

			try{
				$pdo = db::pdo();

				$stmt = $pdo->prepare("SELECT * FROM vendedores WHERE email = :email");
				$stmt->execute([':email' => $email]);

				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				$this->id = $dados['id'];
				$this->nome = $dados['nome'];
				$this->email = $dados['email'];
				$this->telefone = $dados['telefone'];
				$this->senha = $dados['senha'];
				$this->cpf = $dados['cpf'];
				$this->endereco = $dados['endereco'];
				$this->numero = $dados['numero'];
				$this->bio = $dados['bio'];
				$this->cep = $dados['cep'];
				$this->bairro = $dados['bairro'];
				$this->cidade = $dados['cidade'];
				$this->estado = $dados['estado'];
				
			
			}catch(PDOException $e){
				return $e->getMessage();
			}
		}
	}

	class produtos{
		private $id;
		public $nome;
		public $foto;
		public $tipo_fatura;
		public $estoque;
		public $preco;
		public $categoria;
		public $genero;
		public $detalhes;



	public function __construct($id){
		$this->produtos_setInfos($id);
	}

	public function produtos_setInfos($id){
		if(isset($id)){
			$pdo = db::pdo();
			$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
			$stmt->execute([':id' => $id]);
			$total = $stmt->rowCount();


			if($total > 0){
				$dados = $stmt->fetch(PDO::FETCH_ASSOC);
				$this->id = $dados['id'];
				$this->nome = $dados['nome'];
				$this->foto = $dados['foto'];
				$this->tipo_fatura = $dados['tipo_fatura'];
				$this->estoque = $dados['estoque'];
				$this->preco = $dados['preco'];
				$this->categoria = $dados['categoria'];
				$this->genero = $dados['genero'];
				$this->detalhes = $dados['detalhes'];
			}
		}
	}

	public function produtos_get_total(){
		switch ($this->estoque) {
			case -1:
				echo "<a href='comprar/{$this->id}' class='btn btn-primary'>Comprar</a>";
			break;

			case 0:
				echo "<code>Infelizmente estamos com o estoque zerado :(</code>";
			break;
			
			default:
				echo "<a href='comprar/{$this->id}' class='btn btn-primary'>Comprar</a>";
			break;
		}
	}

	public static function produtos_vefica_login(){
		if(!isset($_SESSION['userEmail'])){
			$mensagemHtml = "<span class='text-danger'>Desculpe, você precisa entrar em sua conta. Redirecionando para o login...</span>";
			website::website_pop_up($mensagemHtml);
			website::website_direciona("enter");
			exit();
		}
	}

	public static function produtos_cria_fatura($preco){
		$pdo = db::pdo();
		$data = website::get_data();
		$data_vencimento = date('d/m/Y', strtotime('+5 days'));

		$stmt = $pdo->prepare("INSERT INTO faturas (preco, data, data_vencimento, id_cliente) VALUES (:preco, :data, :data_vencimento, :id_cliente)");
		$stmt->execute([':preco' => $preco, ':data' => $data, ':data_vencimento' => $data_vencimento, ':id_cliente' => $_SESSION['userId']]);
		
		return $pdo->lastInsertId();
	}

    public static function produtos_adicionar_ao_carrinho() {
        if(isset($_POST['env']) && $_POST['env'] == "adicionarAoCarrinho"){
            produtos::produtos_vefica_login();
            
            if (produtos::produtos_ja_adicionado_ao_carrinho($_POST['id_produto'], $_SESSION['userId'])) {
                echo "<span class='text-danger'>Produto já adicionado ao carrinho!</span>";
                return null;
            }
            
            $pdo = db::pdo();

            $stmt = $pdo->prepare(
                "INSERT INTO carrinho (
                    idProduto,
                    idCliente
                ) VALUES (
                    :idProduto,
                    :idCliente
                )
            ");

            $stmt->execute([
                ':idProduto' => $_POST['id_produto'],
                ':idCliente' => $_SESSION['userId'],
            ]);

            $result = $stmt->rowCount();

            if ($result > 0) {
                echo "<script>location.reload();</script>";
                echo "<div class='alert alert-success'>Adicionado ao Carrinho</div>";
            }
        }
    }

    public static  function produtos_ja_adicionado_ao_carrinho($idProduto, $idCliente) {
        $pdo = db::pdo();

        $stmt = $pdo->prepare("SELECT * FROM carrinho WHERE idProduto = :idProduto AND idCliente = :idCliente");
        $stmt->execute(array(':idProduto' => $idProduto, ':idCliente' => $idCliente));
        $total = $stmt->rowCount();

        if ($total > 0) {
            return true;
        }
    }

    public static function produtos_quantidade_adicionado_ao_carrinho($idCliente) {
        $pdo = db::pdo();

        $stmt = $pdo->prepare("SELECT * FROM carrinho WHERE idCliente = :idCliente");
        $stmt->execute(array(':idCliente' => $idCliente));
        $total = $stmt->rowCount();

        return $total;
    }

    public static function produtos_adicionar_aos_favoritos() {
        if(isset($_POST['envFavoritos']) && $_POST['envFavoritos'] == "adicionarAosFavoritos"){
            produtos::produtos_vefica_login();
            
            if (produtos::produtos_adicionado_aos_favoritos($_POST['id_produto'], $_SESSION['userId'])) {
                echo "<span class='text-danger'>Produto já adicionado aos favoritos!</span>";
                return null;
            }
            
            $pdo = db::pdo();

            $stmt = $pdo->prepare(
                "INSERT INTO produtosFavoritos (
                    idProduto,
                    idCliente
                ) VALUES (
                    :idProduto,
                    :idCliente
                )
            ");

            $stmt->execute([
                ':idProduto' => $_POST['id_produto'],
                ':idCliente' => $_SESSION['userId'],
            ]);

            $result = $stmt->rowCount();

            if ($result > 0) {
                echo "<script>location.reload();</script>";
                echo "<div class='alert alert-success'>Adicionado aos Favoritos</div>";
            }
        }
    }

    public static function produtos_adicionado_aos_favoritos($idProduto, $idCliente) {
        $pdo = db::pdo();

        $stmt = $pdo->prepare("SELECT * FROM produtosFavoritos WHERE idProduto = :idProduto AND idCliente = :idCliente");
        $stmt->execute(array(':idProduto' => $idProduto, ':idCliente' => $idCliente));
        $total = $stmt->rowCount();

        if ($total > 0) {
            return true;
        }
    }

	public function produtos_cria_compra($id_fatura){
		$pdo = db::pdo();
		$data = website::get_data();
		$external_reference = "ID: ".rand(1, 99999);

		$stmt = $pdo->prepare("INSERT INTO compras (id_comprador, id_fatura, nome_produto, data_compra, detalhes, external_reference) VALUES (:id_comprador, :id_fatura, :nome_produto, :data_comprada, :detalhes, :external_reference)");
		$stmt->execute([':id_comprador' => $_SESSION['userId'], ':id_fatura' => $id_fatura, ':nome_produto' => $_POST['nome_produto'], ':data_comprada' => $data, ':detalhes' => $_POST['detalhes'], ':external_reference' => $external_reference]);
	}

	public function produtos_reduzirEstoque($id, $estoque){
		try{
			$pdo = db::pdo();
			$nEstoque = ($estoque) - 1;

			$stmt = $pdo->prepare("UPDATE produtos SET estoque = :estoque WHERE id = :id");
			$stmt->execute([':estoque' => $nEstoque, ':id' => $id]);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function produtos_getMax(){
		switch ($this->estoque) {
			case -1:
				echo 1;
			break;
			
			default:
				echo $this->estoque;
			break;
		}
	}

	public function produtos_verificaEstoque(){
		if($this->estoque == 0){
			echo "<br><div class='alert alert-danger'>Produto sem estoque</div>";
			exit();
		}
	}

	public function produtos_finalizar_compra($id){
		if(isset($_POST['env']) && $_POST['env'] == "compra"){
			$id_fatura = $this->produtos_cria_fatura($_POST['subtotal']);
			$this->produtos_cria_compra($id_fatura);
			$this->produtos_reduzirEstoque($id, $this->estoque);
			website::website_direciona("fatura/{$id_fatura}");
		}
	}

	public function produtos_switchEstoque(){
		switch ($this->estoque) {
			case -1:
				return "Ilimitado";	
			break;
			
			case 0:
				return "<code>0</code>";	
			break;

			default:
				return "{$this->estoque}";	
			break;
		}
	}

}

?>