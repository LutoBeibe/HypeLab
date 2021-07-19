
          <div id="r-content">
            <div class="r-title">Admin / Gerenciar Produtos</div>
            <br>
            <div class="r-description">
             Digite o produto que deseja buscar<br>
            </div>
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

                <?php website::website_admin_getProdutos();?>
              </table>
            </div>
          </div>         
