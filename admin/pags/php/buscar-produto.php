
          <div id="r-content">
            <div class="r-title">Admin / Buscar Produto</div>
            <br>
            <div class="r-description">
             Digite o produto que deseja buscar<br>
             <span class="badge badge-dark">Busque produtos pelo Nome ou Preço</span>
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
              <table id="result-produto" class="table table-bordered">
                <tr>
                  <th width="2%">#</th>
                  <th width="40%">Nome</th>
                  <th>Preço</th>
                  <th>Categoria</th>
                  <th>Gerenciar</th>
                </tr>

                <?php website::website_admin_buscarproduto();?>
                
              </table>
            </div>
          </div>         
