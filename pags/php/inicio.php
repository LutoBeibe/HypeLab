<?php 
    include('components/header-component.php');
?>

<div class="container carousel-container">
    <?php include('components/carousel-about-component.php'); ?>
</div>

<section>
    <div class="container">
        <div class="row">

            <?php
                include('components/left-sidebar-component.php');

                if ($_SESSION['searchString'] == '') {
                    include('components/recommended-items-component.php');
                    include('components/recents-items-component.php');
                } else {
                    include('components/produto-pesquisa-component.php');
                }
            ?>

        </div>
    </div>
</section>

<?php include('components/footer-component.php'); ?>