<?php website::website_verificaIsLogado(); $clientes = new clientes();?>
<div id="r-content">
  <div class="r-title">Bem vindo <b><?php echo $clientes->nome;?></b></div>
  <br>
  <div class="r-description">Esta é a sua área do cliente. Navegue através do menu abaixo.
  </div>
</div>

<div id="menu-logged">
  <ul>
    <li><a href="me">Dados Cadastrais</a></li>
    <li><a href="pedidos">Meus pedidos</a></li>
    <li><a href="faturas">Minhas Faturas</a></li>
    <li><a href="configs">Configurações</a></li>
    <li><a href="sair">Sair</a></li>
  </ul>

