          <div id="r-content">
            <div class="r-title">Admin / Gerenciar Compras</div>
            <br>
            <div class="r-description">
             Gerenciar compras<br>
            </div>
          </div>

        <div class="card">
          <div class="card-header bg-warning text-light">
            Compras Aguardando Entrega
          </div>
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

                <?php website::website_admin_geCompras();?>
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

                <?php website::website_admin_geComprasConcluidas();?>
              </table>
            </div>
          </div>
        </div>
      
