<?php 
    include('components/header-component.php');
?>
<div class="container">
<?php website::website_verificaIsLogado(); ?>
          <div id="r-content">
            <div class="r-description">Meus últimos pedidos</div>
          </div>

          <div id="menu-buys">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th>#</th>
                  <th width="40%">Nome</th>
                  <th>Status</th>
                  <th>Fatura</th>
                  <th>Detalhes</th>
                </tr>

                <?php $website = new website();
                      $website->website_cliente_compras();?>
                
              </table>
            </div>
          </div>
          </div>

<?php include('components/footer-component.php'); ?>
