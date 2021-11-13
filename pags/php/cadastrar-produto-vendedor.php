<?php include('components/header-component.php'); ?>

<div class="container">
  <div class="r-content">
    Área do vendedor - Cadastrar Produto
  </div>
    
  <form method="POST" autocomplete="off" enctype="multipart/form-data" class="form-dados-produto-vendedor">
    <div class="row">
      <div class="col-sm-6">
        <label>Nome do produto</label>
        <input type="text" name="nome" class="form-control" required>
      </div>

      <div class="col-sm-6">
        <label>Estoque</label>
        <input type="number" name="estoque" min="-1" value="1" class="form-control">
        <p style="margin-bottom: 10px; margin-top: -3px !important;">Coloque -1 para inicar que o estoque é ilimitado</p>
      </div>

      <div class="col-sm-6">
        <label>Imagem do produto</label>
        <input type="file" name="produtofile" class="form-control">
      </div>

      <div class="col-sm-6">
        <label>Preço do produto</label>

        <input type="text" name="valor" class="form-control">
      </div>

      <div class="col-sm-6">
        <label>Tipo de fatura</label>

        <select name="tipo_fatura" class="form-control">
          <option value="0">Pagamento Único</option>
          <option value="1">Mensal</option>
        </select>
      </div>

      <div class="col-sm-6">
        <label>Categoria</label>

        <select name="categoria" class="form-control">
          <?php website::website_admin_getCategoriaN();?>
        </select>
      </div>
      
      <div class="col-sm-6">
        <label>Gênero</label>

        <select name="genero" class="form-control">
          <?php website::website_admin_getGeneros();?>
        </select>
      </div>

      <div class="col-sm-6">
        <label>Detalhes do produto</label>

        <textarea name="detalhes" class="form-control" rows="5" required></textarea>
      </div>

    </div>

    <div class="embeded-buttons">
      <input type="submit" class="btn btn-outline-success btn-lg btn-block" value="Cadastrar">
    </div>
    <input type="hidden" name="env" value="prod">
  </form>

  <?php website::website_admin_cadastrarProdutoVendedor();?>
</div> 
          
<?php include('components/footer-component.php'); ?>
