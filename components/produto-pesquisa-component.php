<div class="features-items-container col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Produtos Encontrados</h2>

        <?php 
            website::website_produtos_pesquisa($_SESSION['searchString']);
        ?>
    </div>
</div>