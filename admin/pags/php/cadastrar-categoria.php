<div id="r-content">
  <div class="r-title">Admin / Cadastrar Categoria</div>
  <br>
  <div class="r-description">
   Cadastrar categoria<br>
   <span class="badge badge-dark">Indique o nome da categoria</span>
  </div>
</div>

<form method="POST" class="form-inline form-busca">
	<input type="text" name="categoria" placeholder="Nome da Categoria" class="form-control col-sm-3" required>
	<input type="text" name="descricao" placeholder="Descrição da categoria" class="form-control col-sm-6" required>
	<input type="submit" value="Cadastrar" id="busca-produto" class="btn btn-primary">
	<input type="hidden" name="alt" value="cat">
</form>

<?php website::website_admin_addCategorias();?>                  
