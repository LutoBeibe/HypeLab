<?php
  $produtos = new produtos($explode['0']);
  $produtos->produtos_vefica_login();
?>
<form method="POST">
          <div id="r-content">
            <div class="r-title">Carrinho</div>
            <br>
            <div class="r-description">
             Revise antes de continuar
            </div>
          </div>

        	<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th>#</th>
						<th>Produto</th>
						<th width="20%">Quantidade</th>
						<th>Preço</th>
					</tr>
					<?php $produtos->produtos_verificaEstoque();?>
					<tr>
						<td>1</td>
						<td><?php echo $produtos->nome;?></td>
						<td align="center"><input type="number" id="quantity" min="1" max="<?php $produtos->produtos_getMax();?>" class="col-sm-7" value="1"></td>
            <input type="hidden" id="valor_produto" value="<?php echo $produtos->preco;?>">
						<td>R$ <?php echo $produtos->preco;?></td>
					</tr>
				</table>
			</div>
			<div class="float-right">
				<div class="form-inline">
				<label class="my-1 mr-2">Subtotal:</label> 
				<input type="text" name="subtotal" readonly class="custom-select my-1 mr-sm-2" id="subtotal" style="border: none;">
			</div>

			<br>
			<label>Informações Adicionais</label>
			<textarea class="form-control" name="detalhes" rows="4" placeholder="Especifique algo"></textarea>
			<br>

			<p align="right"><input type="submit" value="Finalizar e pagar" class="btn btn-outline-success"></p>
			<input type="hidden" name="nome_produto" value="<?php echo $produtos->nome;?>">
			<input type="hidden" name="env" value="compra">
</form>
	<?php $produtos->produtos_finalizar_compra($explode['1']); ?>
</div>
