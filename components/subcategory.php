

<div class="features-items-container col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">
        <?php website::website_getInfosSubCategoria($explode[1]);?>
        </h2>
        <?php 
            website::website_produtoFromSubCategoria($explode[1]);
        ?>
        
    </div><!--features_items-->
    
   
    
</div>