  <div id="r-content">
    <div class="r-title">Admin / Gerenciar Categorias e Subcategorias</div>
    <br>
    <div class="r-description">
     Gerenciar Categorias e subcategorias<br>
    </div>
  </div><br>

<div class="row">
  <div class="col-sm-6">
    <h4>Categorias</h4>
    <hr>
    <div id="resultado-busca-produto">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th width="2%">#</th>
            <th width="40%">Nome</th>
            <th>Gerenciar</th>
          </tr>

          <?php website::website_admin_getCategoria();?>
        </table>
      </div>
    </div>    
  </div>

  <div class="col-sm-6">
    <h4>Subcategorias</h4>
    <hr>
    <div id="resultado-busca-produto">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th width="2%">#</th>
            <th width="40%">Nome</th>
            <th>Gerenciar</th>
          </tr>

          <?php website::website_admin_getSubCategoria();?>
        </table>
      </div>
    </div>    
  </div>
</div>

