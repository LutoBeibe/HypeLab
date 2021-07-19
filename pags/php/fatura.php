<?php
  website::website_verificaIsLogado(); 
  $clientes = new clientes();
  $website = new website();
  $website->website_verficaFaturaCliente($explode['1']);
?>

<div id="r-content">
  <div class="r-title">Central / Fatura</div>
  <br>
  <div class="r-description">Minha Fatura</div>
</div>

    <div id="invoice">
    <div class="color-invoice">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6">
          <h1>FATURA #<?php echo $explode['1'];?></h1>
          <strong>Email: </strong> vendas@tutoriaiseinformatica.com
          <br />
          <strong>Telefone: </strong> +55 (21) 98012-7711
          <br><br>
        </div>

        <div class="col-sm-6">
          <h3> Tutoriais e Informática</h3> Rua Leonardo VilasBoas 100 C/ 32
          <br> 22775-150 - Curicica - Jacarepaguá
          <br> Rio de Janeiro - RJ
        </div><br>
      </div>
      <hr>

      <div class="row">
        <div class="col-sm-7">
          <h4>Dados do cliente: </h4>
          <h5><?php echo $clientes->nome;?></h5> <?php echo $clientes->endereco." ".$clientes->numero." ".$clientes->complemento;;?>  <br/> 
          <?php echo $clientes->cep;?> -           
          <?php echo $clientes->bairro;?><br>
          <?php echo $clientes->cidade;?> - <?php echo $clientes->estado;?>
          
          <br><br>
        </div>
        <div class="col-sm-4">
          <h4>Contato Cliente:</h4> Telefone: <?php echo $clientes->telefone;?>          <br> Email: <?php echo $clientes->email;?>        <br><br>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <strong>FATURA REFERENTE AO PRODUTO:</strong>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-sm-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Nº</th>
                  <th>Titulo</th>
                  <th>Data</th>
                  <th>Vencimento</th>
                  <th>Total</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>

                <?php $website->website_getDadosCompra($explode['1']);?>

              </tbody>
            </table>
            </div>
            <hr>
              <strong> Leia com atenção: </strong>
                <ol>
                  <li>
                    Pagamentos feito por depósito bancário deverá ser confirmado através de um <b>ticket</b>.
                  </li>
                  <li>
                    Caso realize o pagamento através de depósito, você pode optar por anotar os dados da conta bancária ao invés de imprimir este boleto, mas cuidado, verifique se os dados do sacador estão iguais ao do boleto.
                  </li>
                  <li>
                    A fatura poderá ser paga com cartão de crédito ou com boleto através do método <b>PagSeguro</b>.
                  </li>
                  <li>
                    Os pagamentos com cartão de crédito/boleto serão confirmados <b>automaticamente</b>.
                  </li>
                </ol><br><br>
            <hr>
              <strong>FORMAS DE PAGAMENTO:</strong>
            <hr>
            <div class="row">
              <div class="col-sm-7">
                <h5>Cartão/boleto/Transferência: </h5>
                <hr>
                <p>
                <?php
                $id_compra = website::website_getDetailsCompra($explode[1], "id");
                $nome_produto = website::website_getDetailsCompra($explode[1], "nome_produto");
                $preco = website::website_getDadosFatura(website::website_getDetailsCompra($explode[1], "id_fatura"), "preco");
                $external_reference = website::website_getDetailsCompra($explode[1], "external_reference");
                                   
                website::website_getUniqPaymentMP([$explode[1],$nome_produto, $preco, $external_reference]);
                ?>
                  </p>
              </div>

              <div class="col-sm-4" align="left">
                <h5>Depósito bancário: </h5>
                <p align="left">
                  <?php website::website_selectBanco(banco);?><br>
                  <span>Agência: <b><?php echo banco_ag;?></b></span><br>
                  <span>Conta: <b><?php echo banco_conta;?></b></span><br>
                  <span>Tipo: <b><?php echo banco_tipo;?></b></span><br>
                  <span>Favorecido: <b><?php echo banco_favorecido;?></b></span><br>
                </p>
              </div>
            </div>
            <hr>
              <div align="right">
                  <a class="btn btn-success btn-sm" style="color:#FFF;" onclick="printBy('#central-content-page-invoice-printable');">Imprimir Boleto</a>    
                  <a href="#" class="btn btn-info btn-sm">Baixar em PDF</a>
              </div>
            <hr>
        </div>
      </div>
    </div>
  </div>
</div>   

        </div>
