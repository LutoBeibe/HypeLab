          <div id="r-content">
            <div class="r-title">Admin / Buscar Compras</div>
            <br>
            <div class="r-description">
             Buscar compras<br>
             <span class="badge badge-dark">Busque a compra pelo email do cliente</span>
            </div>
          </div>
          
          <form method="POST" class="form-inline form-busca offset-md-2">
            <input type="text" name="resultado" class="form-control col-sm-8">
            <input type="submit" value="Buscar" id="busca-produto" class="btn btn-primary">
            <input type="hidden" name="env" value="busca">
          </form>

          <hr>

          <div id="resultado-busca-produto">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th width="2%">#</th>
                  <th>Produto</th>
                  <th>Cliente</th>
                  <th>Preço</th>
                  <th>Gerenciar</th>
                </tr>

                <?php website::website_admin_buscarCompras();?>
              </table>
            </div>
          </div>         
