<?php website::website_verificaIsLogado(); $vendedores = new vendedores();?>
          
          <div id="r-content">
            <div class="r-description">
             Confira ou edite seus dados cadastrais
            </div>
          </div>

          <form class="me-form" method="POST" autocomplete="off">
            <div class="row">
              <div class="col-sm-6">
                <label>Nome</label>
                <input type="text" name="nome" value="<?php echo $vendedores->nome;?>" class="form-control" required>
              </div>

              <div class="col-sm-6">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $vendedores->email;?>" class="form-control" disabled><br>
              </div>

              <div class="col-sm-6">
                <label>Senha</label>
                <input type="password" name="senha" value="<?php echo $vendedores->senha;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>Telefone de contato</label>
                <input type="text" name="telefone" id="telefone" value="<?php echo $vendedores->telefone;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-12">
                <label>Bio</label>
                <textarea name="bio" class="form-control" required ><?php echo $vendedores->bio;?></textarea><br>
              </div>

              <div class="col-sm-6">
                <label>CPF</label>
                <input type="text" name="cpf" id="cpf" value="<?php echo $vendedores->cpf;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>Nome Endereço</label>
                <input type="text" name="endereco" id="endereco" value="<?php echo $vendedores->endereco;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>Número</label>
                <input type="text" name="numero" id="numero" value="<?php echo $vendedores->numero;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>CEP</label>
                <input type="text" name="cep" value="<?php echo $vendedores->cep;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>Bairro</label>
                <input type="text" name="bairro" value="<?php echo $vendedores->bairro;?>" class="form-control" placeholder="Casa x" required><br>
              </div>

              <div class="col-sm-6">
                  <label>Cidade</label>
                  <input type="text" name="cidade" value="<?php echo $vendedores->cidade;?>"  class="form-control" placeholder="Casa x" required><br>
              </div>

              <div class="col-sm-6">
                  <label>Estado</label>
                  <input type="text" name="estado" value="<?php echo $vendedores->estado;?>" class="form-control" placeholder="Casa x" required><br>
              </div>
            </div>

            <div class="embeded-buttons">
              <input type="submit" value="Alterar Dados" class="btn btn-outline-success btn-lg btn-block">
            </div>
            <input type="hidden" name="alt" value="cad">
          </form>
          <?php website::website_alterarDadosSeller();?>
         

        