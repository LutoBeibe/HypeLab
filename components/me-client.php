<?php website::website_verificaIsLogado(); $clientes = new clientes();?>
          
          <div id="r-content">
            <div class="r-description">
             <h4>Confira ou edite seus dados cadastrais</h4>
            </div>
          </div>
          
          <form class="me-form" method="POST" autocomplete="off">
            <div class="row">
              <div class="col-sm-6">
                <label>Nome</label>
                <input type="text" name="nome" value="<?php echo $clientes->nome;?>" class="form-control" required>
              </div>

              <div class="col-sm-6">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $clientes->email;?>" class="form-control" disabled><br>
              </div>

              <div class="col-sm-6">
                <label>Senha</label>
                <input type="password" name="senha" value="<?php echo $clientes->senha;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>Telefone de contato</label>
                <input type="text" name="telefone" id="telefone" value="<?php echo $clientes->telefone;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>Endereço</label>
                <input type="text" name="endereco" value="<?php echo $clientes->endereco;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>Numero</label>
                <input type="text" name="numero" value="<?php echo $clientes->numero;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>CEP</label>
                <input type="text" name="cep" value="<?php echo $clientes->cep;?>" class="form-control" required><br>
              </div>

              <div class="col-sm-6">
                <label>Bairro</label>
                <input type="text" name="bairro" value="<?php echo $clientes->bairro;?>" class="form-control" placeholder="Casa x" required><br>
              </div>

              <div class="col-sm-6">
                  <label>Cidade</label>
                  <input type="text" name="cidade" value="<?php echo $clientes->cidade;?>"  class="form-control" placeholder="Casa x" required><br>
              </div>

              <div class="col-sm-6">
                  <label>Estado</label>
                  <input type="text" name="estado" value="<?php echo $clientes->estado;?>" class="form-control" placeholder="Casa x" required><br>
              </div>
            </div>

            <div class="change-data">
              <input type="submit" value="Alterar Dados" class="btn btn-outline-success btn-lg btn-block">
            </div>
            <input type="hidden" name="alt" value="cad">
          </form>
          <?php website::website_alterarDadosCliente();?>
         

        