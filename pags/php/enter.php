<?php include('components/header-component.php'); ?>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">

            <?php include('components/login-component.php'); ?>

            <div class="col-sm-1">
                <h2 class="or">OU</h2>
            </div>

            <?php include('components/register-component.php'); ?>
            
        </div>

        <div class="seller-buttom" >
            
                <a href="entrar-como-vendedor">
                    <button type="submit" class="btn btn-default">Entrar Como Vendedor</button>
                </a>
            
        </div>

    </div>
</section>

<?php include('components/footer-component.php'); ?>
