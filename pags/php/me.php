<?php 
    include('components/header-component.php');
?>
<div class="container">
<?php 
  if (isset ($_SESSION['isVendedor']) && $_SESSION['isVendedor']){
     include('components/me-seller.php');
  }else{
    include('components/me-client.php');
  }
?>        
</div>
          <?php include('components/footer-component.php'); ?>
          