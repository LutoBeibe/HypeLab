          <div id="r-content">
            <div class="r-title">Admin / Buscar Clientes</div>
            <br>
            <div class="r-description">
             Buscar clientes<br>
             <span class="badge badge-dark">Busque o cliente pelo email ou nome</span>
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
                  <th>#</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Gerenciar</th>
                </tr>

                <?php website::website_admin_buscaClientes();?>
              </table>
            </div>
          </div>         
