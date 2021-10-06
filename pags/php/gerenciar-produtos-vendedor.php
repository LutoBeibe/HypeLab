
<?php 
    include('components/header-component.php');
?>
<div class="container">
          <div id="r-content">
            <div class="r-title">Gerenciar Produtos</div>
          </div>

          <div id="resultado-busca-produto">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th width="2%">#</th>
                  <th width="40%">Nome</th>
                  <th>Preço</th>
                  <th>Categoria</th>
                  <th>Gerenciar</th>
                </tr>

                <?php website::website_seller_getProdutos();?>
              </table>
            </div>
          </div>
</div>
<?php include('components/footer-component.php'); ?>         
