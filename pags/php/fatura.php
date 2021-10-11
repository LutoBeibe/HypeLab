<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <?php website::website_navTop() ?>
                </div>
                <div class="col-sm-6">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            <?php website::website_navLogin(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
<?php
  website::website_verificaIsLogado(); 
  $clientes = new clientes();
  $website = new website();
  $website->website_verficaFaturaCliente($explode['1']);
?>

 <div class="container">
    <div id="invoice">
    <div class="color-invoice">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-6">
        <br /> 
        <div class="logo pull-left">
          <a href="inicio"><img src="images/home/logo-secondary.png" alt="<?php echo titulo; ?> Logo" /></a>
           </div>
           <br /> <br /> <br /> <br />
           <hr>
          <h1>Fatura Nº<?php echo $explode['1'];?></h1>
          <strong>Email: </strong> Hypelab@vendas.com
          <br />
          <strong>Telefone: </strong> +55 (11) 98012-7711
          <br><br>
        </div>
        <div class="col-sm-6">
          <h3> HypeLab </h3> 1941 Av. Paulista - Bela Vista
          <br> CEP: 01310-200
          <br> São Paulo - SP
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
                

              <div class="col-sm-4" align="left">
                <h4>Depósito bancário: </h4>
                <div class="batatinha-frita-123" align="left">
                  <span><?php website::website_selectBanco(banco);?></span>
                  <span>Agência: <b><?php echo banco_ag;?></b></span>
                  <span>Conta: <b><?php echo banco_conta;?></b></span>
                  <span>Tipo: <b><?php echo banco_tipo;?></b></span>
                  <span>Favorecido: <b><?php echo banco_favorecido;?></b></span>
                </div>
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
</div>

<?php include('components/footer-component.php'); ?>

        
