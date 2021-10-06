<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>Novo vendedor? Cadaste-se</h2>
        <form method="POST" autocomplete="center" enctype="multipart/form-data" class="register-user-form-container">
            <div class="form-content-row">
                <input type="text" name="nome" placeholder="Nome" required/>
                <input type="text" name="telefone" id="telefone" placeholder="Telefone" required/>
            </div>

            <div class="form-content-row">
                <input type="email" name="email" placeholder="Email" required/>
                <input type="password" name="senha" placeholder="Senha" required/>
            </div>
            
            <input class="cpf" id="cpf" type="text" name="cpf" placeholder="CPF" required/>

            <h5>Biografia</h5>
            <textarea name="bio" id="bio" cols="30" rows="5" placeholder="Conte um pouco sobre você..." required></textarea>

            <h5>Foto de Perfil</h5>
            <input type="file" class="foto-vendedor" name="foto-vendedor" />

            <h5>Genêro</h5>
            <div class="form-content-row">
                <div class="gender-radio-content">
                    <label for="generoMasculino">Masculino</label>
                    <input type="radio" name="genero" value="masculino" id="generoMasculino" checked required />
                </div>
                <div class="gender-radio-content">
                    <label for="generoFeminino">Feminino</label>
                    <input type="radio" name="genero" value="feminino" id="generoFeminino" required />
                </div>
            </div>
            
            <h5>Endereço</h5>
            <div class="form-content-row">
                <input type="text" name="cep" id="cep" placeholder="CEP" required/>
                <input type="text" name="estado" placeholder="Estado" required/>
            </div>

            <div class="form-content-row">
                <input type="text" name="cidade" placeholder="Cidade" required/>
                <input type="text" name="bairro" placeholder="Bairro" required/>
            </div>

            <input type="hidden" name="cad" value="astroVendedor">
            <button type="submit" class="btn btn-default btn-register">Cadastrar</button>
        </form>

        <?php website::website_register_seller(); ?>

    </div><!--/sign up form-->
</div>