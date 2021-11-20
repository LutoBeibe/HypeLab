<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>Novo vendedor? Cadastre-se</h2>
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

            <div class="form-content-row">
                <div class="seller-avatar-container">
                    <h5>Foto de Perfil</h5>

                    <div class="seller-avatar-file">
                        <label for="foto-vendedor">Escolher arquivo</label>
                        <span id="seller-avatar-filename"></span>

                        <input type="file" class="foto-vendedor" name="foto-vendedor" id="foto-vendedor" />
                    </div>
                </div>
            </div>

            <h5>Genêro</h5>
            <div class="form-content-row">
                <div class="gender-radio-content">
                    <input type="radio" name="genero" value="masculino" id="generoMasculino" checked required />
                    <label for="generoMasculino">Masculino</label>
                </div>

                <div class="gender-radio-content">
                    <input type="radio" name="genero" value="feminino" id="generoFeminino" required />
                    <label for="generoFeminino">Feminino</label>
                </div>
            </div>
            
            <h5>Endereço</h5>
            <div class="form-content-row">
                <input type="text" name="endereco" placeholder="Nome Endereço" required/>
                <input type="text" name="numero" id="numero" placeholder="Número" required/>
            </div>

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

<script>
    const avatarFile = document.querySelector('#foto-vendedor');
    const avatarFileNameContainer = document.querySelector('#seller-avatar-filename');

    avatarFile.addEventListener('change', () => {
        const avatarFilePath = avatarFile.value.split('\\');
        const avatarFileName = avatarFilePath[avatarFilePath.length - 1];

        avatarFileNameContainer.innerHTML = avatarFileName;
    });
</script>
