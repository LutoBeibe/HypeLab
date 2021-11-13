
<?php 
    include('components/header-component.php');
?>
<div class="container">
  <div class="r-content">
    Busque produtos pelo Nome ou Preço
  </div>
          
  <form method="POST" class="form-inline form-busca-produto-vendedor offset-md-2">
    <input 
      type="text" 
      name="resultado" 
      class="form-control col-sm-8" 
      placeholder="Busque seus produtos..."
      value="<?php 
        echo isset($_POST['resultado'])
            ? urldecode($_POST['resultado']) 
            : '';
      ?>"
    >

    <button type="submit" id="busca-produto" class="btn btn-default">Buscar</button>
    <input type="hidden" name="env" value="busca">
  </form>

  <hr>

  <div class="r-content">
    <div class="r-title">Gerenciar Produtos</div>
  </div>

  <div id="resultado-busca-produto">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th width="2%">#</th>
          <th width="40%">Nome</th>
          <th>Preço</th>
          <th>Estoque</th>
          <th>Categoria</th>
          <th>Gerenciar</th>
        </tr>

        <?php website::website_seller_getProdutos();?>
      </table>
    </div>
  </div>
</div>
<?php include('components/footer-component.php'); ?>         
