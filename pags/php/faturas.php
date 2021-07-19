<?php website::website_verificaIsLogado();?>
          <div id="r-content">
            <div class="r-title">Central / Minhas Faturas</div>
            <br>
            <div class="r-description">Minhas Faturas</div>
          </div>

          <div id="menu-buys">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th>#</th>
                  <th width="40%">Pedido</th>
                  <th>Status</th>
                  <th>Detalhes</th>
                </tr>

                <?php $website = new website();
                      $website->website_cliente_faturas();?>
                
              </table>
            </div>
          </div>