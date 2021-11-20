<?php include('components/header-component.php'); ?>

<div class="container">
  <div id="r-content">
    <div class="r-title">Gerenciar Compras</div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th width="2%">#</th>
            <th>Cliente</th>
            <th>Preço</th>
            <th>Referência</th>
            <th>Gerenciar</th>
          </tr>

          <?php website::website_getComprasVendedor();?>
        </table>
      </div>
    </div>
  </div>
  <br>

  <div class="card">
    <div class="card-header bg-success text-light">
      Compras Concluidas
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th width="2%">#</th>
            <th>Cliente</th>
            <th>Preço</th>
            <th>Detalhes</th>
          </tr>

          <?php website::website_geComprasConcluidas();?>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include('components/footer-component.php'); ?>  