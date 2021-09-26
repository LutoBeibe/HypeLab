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
                include('components/recommended-items-component.php');
            ?>

        </div>
    </div>
</section>

<?php include('components/footer-component.php'); ?>