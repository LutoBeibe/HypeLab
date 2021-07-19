<?php
  $produtos = new produtos($explode['1']);
?>
<div id="r-content">
  <div class="r-title">Eshop / Produto</div>
</div>

<div id="products-list">
    <div class="row">
<div class="col-sm-5">
	<img src="<?php echo $produtos->foto;?>" width="200">
</div>

<div class="col-sm-7">
	<h4><?php echo $produtos->nome;?></h4>
	<div class="product"> 
		<div class="price">
			<span class="cf">R$</span> 
			<span class="prc"><?php echo $produtos->preco;?></span>
		</div>
    <p>Estoque: <?php echo $produtos->produtos_switchEstoque();?></p>
	</div>
	<br>
	<?php $produtos->produtos_get_total();?>
</div>
  	</div>
</div><br>
<div id="r-content"></div>
<?php echo $produtos->detalhes;?>