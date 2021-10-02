<div class="features-items-container col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">
        <?php website::website_getInfosGenero($explode[1]);?>
        </h2>
        <?php 
            website::website_produtoFromGenero($explode[1]);
        ?>
    </div><!--features_items-->
</div>