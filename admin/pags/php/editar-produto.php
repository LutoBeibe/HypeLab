<?php $produtos = new produtos($explode['1']);?>
          <div id="r-content">
            <div class="r-title">Admin / Editar Produto</div>
            <br>
            <div class="r-description">
             Editar Produto
            </div>
          </div>
          
          <form method="POST" autocomplete="off" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <label>Nome do produto</label>
              <input type="text" name="nome" value="<?php echo $produtos->nome;?>" class="form-control" required>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Estoque</label>
              <input type="number" name="estoque" value="<?php echo $produtos->estoque;?>" min="-1" value="1" name="nome" class="form-control">
              <code><small>Coloque -1 para inicar que o estoque é ilimitado</small></code>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Preço do produto</label>
              <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">R$</span>
              </div>
              <input type="text" name="valor" value="<?php echo $produtos->preco;?>" class="form-control">
            </div>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Tipo de fatura</label>
              <select name="tipo_fatura" value="" class="form-control">
                <?php
                  switch($produtos->tipo_fatura){
                    case 0:
                    echo "<option value='0'>Pagamento Único(Atual)</option>";
                    break;

                    case 1:
                    echo "<option value='1'>Mensal(Atual)</option>";
                    break;
                  }
                ?>
                <option value='0'>Pagamento Único</option>
                <option value="1">Mensal</option>
              </select>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Categoria</label>
              <select name="categoria" class="form-control">
                <option value="<?php echo $produtos->categoria;?>"><?php echo website::website_admin_getNomeCategoria($produtos->categoria);?>(Atual)</option>
                <?php website::website_admin_getCategorias();?>
              </select>
              <br>
            </div>

            <div class="col-sm-6">
              <label>Detalhes do produto</label>
              <textarea name="detalhes" class="form-control" rows="5"><?php echo $produtos->detalhes;?></textarea>
              <br>
            </div>

          </div>

          <hr>
            <p align="right"><input type="submit" value="Salvar Alterações" class="btn btn-outline-success"></p>
            <input type="hidden" name="alt" value="prod">
          </form>
          <?php website::website_admin_altProduto($explode['1']);?>