<div id="r-content">
	<div class="r-title">Admin / Ver Cliente</div>
	<br>
	<div class="r-description">
	 Ver dados do cliente<br>
	</div>
</div>

<hr>
<div class="row">
	<div class="col-sm-6">
		<h4>Informações Pessoais</h4>
		<hr>
		<p><b>Nome:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "nome");?></p>
		<p><b>Email:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "email");?></p>
		<p><b>Telefone:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "telefone");?></p>
	</div>

	<div class="col-sm-6">
		<h4>Outras Informações</h4>
		<hr>
		<p><b>Endereço:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "endereco");?></p>
		<p><b>Número:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "numero");?></p>
		<p><b>Complemento:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "complemento");?></p>
		<p><b>Cep:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "cep");?></p>
		<p><b>Cidade:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "cidade");?></p>
		<p><b>Estado:</b> <?php echo website::website_admin_getDadosCliente($explode['1'], "estado");?></p>
	</div>
</div>

<hr>

		<div class="card">
		  <div class="card-header bg-info text-light">
		    Compras
		  </div>
		  <div class="card-body">
		    <div class="table-responsive">
		      <table class="table">
		        <tr>
		          <th width="2%">#</th>
		          <th>Referente ao produto</th>
		          <th>Preço</th>
		          <th>Gerenciar</th>
		        </tr>

		        <?php website::website_admin_geComprasCliente($explode['1']);?>
		      </table>
		    </div>
		  </div>

		</div>
		<br>

        <div class="card">
          <div class="card-header bg-danger text-light">
            Faturas
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th width="2%">#</th>
                  <th>Referente ao pedido</th>
                  <th>Preço</th>
                  <th>Status</th>
                </tr>

                <?php website::website_admin_getFaturasCliente($explode['1']);?>
              </table>
            </div>
          </div>
        </div>
    </div>
      
