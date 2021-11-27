<div class="price-range"><!--price-range-->
    <h2>Faixa de Preço</h2>
    <div class="price-range-control">
        <div class="well text-center">
            <form method="POST" action="inicio">
                <input 
                    type="text" 
                    name="searchString" 
                    class="span2" 
                    value="<?php 
                        echo isset($_POST['searchString']) && $_POST['typeSearch'] == 'priceRange'
                            ? urldecode($_POST['searchString']) 
                            : '800,3550';
                    ?>" 
                    data-slider-min="0" 
                    data-slider-max="10000" 
                    data-slider-step="50" 
                    data-slider-value="[<?php
                        echo isset($_POST['searchString']) && $_POST['typeSearch'] == 'priceRange'
                            ? urldecode($_POST['searchString']) 
                            : '800,3550';
                    ?>]" 
                    id="sl2" 
                ><br />
                <b class="pull-left">R$ 0</b> <b class="pull-right">R$ 10000</b>
                <div class="control-container">
                    <button class="filter-button" type="submit"><i class="fa fa-filter"></i> Filtrar</button>
                </div>

                <input type="hidden" name="typeSearch" value="priceRange">
            </form>

            <?php website::website_pesquisa();?>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br> 
<br>
<br>
<br>
<br>
<br>
<!--/price-range-->
