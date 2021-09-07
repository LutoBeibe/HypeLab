<?php 
    include('components/header-component.php');
    // include('components/slider-component.php');
?>

<div class="container carousel-container">
    <?php include('components/carousel-about-component.php'); ?>
</div>

<section>
    <div class="container">
        <div class="row">

            <?php
                include('components/left-sidebar-component.php');
                include('components/features-items-component.php');
            ?>

        </div>
    </div>
</section>

<?php include('components/footer-component.php'); ?>

<!-- <div id="r-content">
  <div class="r-title">Eshop</div>
</div>

<div id="products-list">
  <div class="row">
  <?php // website::website_produtos_home(); ?>
  </div>
</div>
</div> -->