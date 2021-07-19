          <div id="r-content">
            <div class="r-title">Admin / Gerenciar Faturas</div>
            <br>
            <div class="r-description">
             Gerenciar faturas<br>
            </div>
          </div>

        <div class="card">
          <div class="card-header bg-danger text-light">
            Faturas pendentes
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th width="2%">#</th>
                  <th>Cliente</th>
                  <th>Serviço</th>
                  <th>Preço</th>
                  <th>Referência</th>
                  <th>Gerenciar</th>
                </tr>

                <?php website::website_admin_getPendingFaturas();?>
              </table>
            </div>
          </div>

        </div>
        <br>

        <div class="card">
          <div class="card-header bg-success text-light">
            Faturas Pagas
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th width="2%">#</th>
                  <th>Cliente</th>
                  <th>Serviço</th>
                  <th>Preço</th>
                </tr>

                <?php website::website_admin_getFaturasPagas();?>
              </table>
            </div>
          </div>
        </div>