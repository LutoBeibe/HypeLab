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
        <input type="number" name="estoque" min="-1" value="1" class="form-control" required>
      </div>

      <div class="col-sm-6">
        <label>Preço do produto</label>

        <input type="text" name="valor" class="form-control" required>
      </div>

      <div class="col-sm-6">
        <label>Tipo de fatura</label>

        <select name="tipo_fatura" class="form-control" required>
          <option value="0">Pagamento Único</option>
          <option value="1">Mensal</option>
        </select>
      </div>

      <div class="col-sm-6">
        <label>Categoria</label>

        <select name="categoria" class="form-control" required>
          <?php website::website_admin_getCategoriaN();?>
        </select>
      </div>
      
      <div class="col-sm-6">
        <label>Gênero</label>

        <select name="genero" class="form-control" required>
          <?php website::website_admin_getGeneros();?>
        </select>
      </div>

      <div class="col-sm-6">
        <label>Detalhes do produto</label>

        <textarea name="detalhes" class="form-control" rows="5" required></textarea>
      </div>

      <div class="col-sm-6 product-image-container">
        <label>Imagem do produto</label>
        
        <div class="product-image-file">
          <label for="produtofile">Escolher arquivo</label>
          <span id="product-filename"></span>

          <input type="file" name="produtofile" class="form-control" id="produtofile" required>
        </div>
      </div>

    </div>

    <div class="embeded-buttons">
      <input type="submit" class="btn btn-outline-success btn-lg btn-block" value="Cadastrar">
    </div>
    <input type="hidden" name="env" value="prodVendedor">
  </form>

  <?php website::website_cadastrarProdutoVendedor();?>
</div> 
          
<?php include('components/footer-component.php'); ?>

<script>
    const productFile = document.querySelector('#produtofile');
    const productFileNameContainer = document.querySelector('#product-filename');

    productFile.addEventListener('change', () => {
        const productFilePath = productFile.value.split('\\');
        const productFileName = productFilePath[productFilePath.length - 1];

        productFileNameContainer.innerHTML = productFileName;
    });
</script>
