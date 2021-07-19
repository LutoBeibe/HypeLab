<div id="r-content">
  <div class="r-title">Admin / Cadastrar Subcategoria</div>
  <br>
  <div class="r-description">
   Cadastrar Subcategoria<br>
   <span class="badge badge-dark">Indique o nome da Subcategoria</span>
  </div>
</div>
<label>Selecione a Categoria</label><br>
<form method="POST" class="form-inline form-busca ">
	
	<select class="form-control" name="categoria">
		<?php website::website_admin_getCategorias();?>
	</select>
	<input type="text" name="subcategoria" class="form-control col-sm-3" placeholder="Nome da Subcategoria" required>
	<input type="text" name="descricao" class="form-control col-sm-4" placeholder="Descrição da subcategoria" required>
	<input type="submit" value="Cadastrar" id="busca-produto" class="btn btn-primary">
	<input type="hidden" name="alt" value="cat">
</form>

<?php website::website_admin_addSubcategorias();?>                  
