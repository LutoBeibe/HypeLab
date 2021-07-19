          <div id="r-content">
            <div class="r-title">Admin / Cadastrar Produto</div>
            <br>
            <div class="r-description">
             Cadastrar Produto
            </div>
          </div>
          
          <form method="POST" autocomplete="off" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <label>Nome do produto</label>
              <input type="text" name="nome" class="form-control" required>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Estoque</label>
              <input type="number" name="estoque" min="-1" value="1" class="form-control">
              <code><small>Coloque -1 para inicar que o estoque é ilimitado</small></code>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Imagem do produto</label>
              <input type="file" name="produtofile" class="form-control">
              <br>
            </div>

            <div class="col-sm-6">
              <label>Preço do produto</label>
              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">R$</span>
              </div>
              <input type="text" name="valor" class="form-control">
            </div>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Tipo de fatura</label>
              <select name="tipo_fatura" class="form-control">
                <option value="0">Pagamento Único</option>
                <option value="1">Mensal</option>
              </select>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Categoria</label>
              <select name="categoria" class="form-control">
                <?php website::website_admin_getCategoriaN();?>
              </select>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Detalhes do produto</label>
              <textarea name="detalhes" class="form-control" rows="5" required></textarea>
              <br>
            </div>

          </div>

          <hr>
            <p align="right"><input type="submit" value="Cadastrar" class="btn btn-outline-success"></p>
            <input type="hidden" name="env" value="prod">
          </form>
          <?php website::website_admin_cadastrarProduto();?>
