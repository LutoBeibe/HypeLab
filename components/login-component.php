<div class="col-sm-4 col-sm-offset-1">
    <div class="login-form"><!--login form-->
        <h2>Entre na sua conta</h2>
        <form method="POST" autocomplete="center">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="senha" placeholder="Senha" required />
            <span>
                <input type="checkbox" class="checkbox"> 
                Mantenha-me conectado
            </span>
            <input type="hidden" name="log" value="in">
            <button type="submit" class="btn btn-default">Entrar</button>
        </form>

        <?php website::website_autenticaLogin(); ?>

    </div><!--/login form-->
</div>