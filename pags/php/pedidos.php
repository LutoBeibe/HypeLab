<?php 
    include('components/header-component.php');
?>
<div class="container">
<?php website::website_verificaIsLogado(); ?>
          <div id="r-content">
            <div class="r-description acount-option-title">Meus últimos pedidos</div>
          </div>

          <div id="menu-buys">
            <div class="table-responsive">
              <table class="table table-unboders">
                <tr style="border-top: none;">
                  <th >#</th>
                  <th width="40%">Nome</th>
                  <th >Status</th>
                  <th >Fatura</th>
                  <th >Detalhes</th>
                </tr>

                <?php $website = new website();?>
                      <th style="border: none;"><?php $website->website_cliente_compras();?></th>
                
              </table>
            </div>
          </div>
          </div>

<?php include('components/footer-component.php'); ?>
