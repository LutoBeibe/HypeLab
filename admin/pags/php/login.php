<?php website::website_admin_verificaLogin();?> 
  <div id="r-content">
    <div class="r-title">Admin / Login</div>
    <br>
    <div class="r-description">
     Logue-se para continuar
    </div>
  </div>
  
  <form method="POST" autocomplete="off" class="col-sm-6 offset-md-2" autocomplete="center">
  <p>
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </p>

  <p>
    <label>Senha</label>
    <input type="password" name="senha" class="form-control" required>
  </p>

    <input type="submit" value="Entrar" class="btn btn-outline-primary btn-lg btn-block">
    <input type="hidden" name="log" value="in">
  </form>
  <?php website::website_autenticaLogin();?>
  <br>