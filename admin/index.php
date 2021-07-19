<?php include_once("../lib/includes.php"); $website = new website();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="<?php echo base_href;?>admin/">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.scss">

     <!--JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/97bdcc5c17.js"></script>
    <script src="../js/script.js"></script>
    <title><?php echo titulo;?></title>
  </head>
  <body>

    <nav id="nav" class="navbar navbar-expand-lg navbar-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../">Site</a>
          </li>
        </ul>
      </div>
      <div class="float-right">
        <?php website::website_navLogin();?>
    </nav>

    <div id="content">
      <div class="row">
        <div class="col-sm-3 bg">
          <?php if(isset($_SESSION['userEmail']) && website::website_getDadosCliente("isadmin")){?>
          <div class="content-left-menu">
            <div class="title-content-left-menu">Produtos</div>
            <div class="content">
              <ul>
                <li class="add"><a href="cadastrar-produto">Cadastrar</a></li>
                <li class="search"><a href="buscar-produto">Buscar</a></li>
                <li class="cog"><a href="gerenciar-produtos">Gerenciar</a></li>
              </ul>
            </div>
          </div>

          <div class="content-left-menu">
            <div class="title-content-left-menu">Categorias</div>
            <div class="content">
              <ul>
                <li class="add"><a href="cadastrar-categoria">Cadastrar Categoria</a></li>
                <li class="add"><a href="cadastrar-subcategoria">Cadastrar Subcategoria</a></li>
              <li class="cog"><a href="gerenciar-categorias">Gerenciar</a></li>
              </ul>
            </div>
          </div>

          <div class="content-left-menu">
            <div class="title-content-left-menu">Compras</div>
            <div class="content">
              <ul>
                <li class="cog"><a href="gerenciar-compras">Gerenciar</a> <?php website::admin_badgeCompras();?></li>
              <li class="search"><a href="buscar-compras">Buscar</a></li>
              </ul>
            </div>
          </div>
          

          <div class="content-left-menu">
            <div class="title-content-left-menu">Faturas</div>
            <div class="content">
              <ul>
              <li class="cog"><a href="gerenciar-faturas">Gerenciar</a> <?php website::admin_badgeFaturas();?></li>
              </ul>
            </div>
          </div>

          <div class="content-left-menu">
            <div class="title-content-left-menu">Clientes</div>
            <div class="content">
              <ul>
                <li class="search"><a href="buscar-clientes">Buscar</a></li>
              </ul>
            </div>
          </div><?php }?>
        </div>
        <div class="col-sm-9">
          <?php website::website_admin_paginacao();?>
        </div>
      </div>
    </div>
    <footer><?php echo titulo;?> <span class="float-right">Criado por Luto Beibe o brabao</span></footer>

   
  </body>
</html>