<?php 
    include('components/header-component.php');
    $produtos = new produtos($explode['1']);
?>

<div class="container">
  <div id="r-content">
    <div class="r-title"> Editar Produto</div>
  </div>
    
  <form method="POST" autocomplete="off" enctype="multipart/form-data" class="form-dados-produto-vendedor">
    <div class="row">
      <div class="col-sm-6">
        <label>Nome do produto</label>
        <input type="text" name="nome" value="<?php echo $produtos->nome;?>" class="form-control" required>
      </div>

      <div class="col-sm-6">
        <label>Estoque</label>
        <input type="number" name="estoque" value="<?php echo $produtos->estoque;?>" min="-1" value="1" name="nome" class="form-control">
        
        <p style="margin-bottom: 10px; margin-top: -3px !important;">Coloque -1 para inicar que o estoque é ilimitado</p>
      </div>

      <div class="col-sm-6">
        <label>Preço do produto</label>

        <input type="text" name="valor" value="<?php echo $produtos->preco;?>" class="form-control">
      </div>

      <div class="col-sm-6">
        <label>Tipo de fatura</label>

        <select name="tipo_fatura" value="" class="form-control">
          <option value="0" <?php echo $produtos->tipo_fatura === "0" ? "selected" : "" ?>>Pagamento Único</option>
          <option value="1" <?php echo $produtos->tipo_fatura === "1" ? "selected" : "" ?>>Mensal</option>
        </select>
      </div>

      <div class="col-sm-6">
        <label>Categoria</label>

        <select name="categoria" class="form-control">
          <?php website::website_admin_getCategoriaN($produtos->categoria);?>
        </select>
      </div>

      <div class="col-sm-6">
        <label>Gênero</label>

        <select name="genero" class="form-control">
          <?php website::website_admin_getGeneros($produtos->genero);?>
        </select>
      </div>

      <div class="col-sm-6">
        <label>Detalhes do produto</label>

        <textarea name="detalhes" class="form-control" rows="5"><?php echo $produtos->detalhes;?></textarea>
      </div>

    </div>

    <div class="embeded-buttons">
      <input type="submit" value="Salvar Alterações" class="btn btn-outline-success">
    </div>

    <input type="hidden" name="alt" value="prod">
  </form>

  <?php website::website_seller_altProduto($explode['1']);?>
</div>

<?php include('components/footer-component.php'); ?>