<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center" style="background-color: #f8f9fa; padding: 2rem; border-radius: 10px;">
        <h2 style="color: #38006b; font-weight: bold;">¡Bienvenido a su Sistema de Inventario!</h2>
        <p style="font-size: 1.2rem; color: #6c757d;">Gestione sus productos, ventas y usuarios de manera eficiente y sencilla.</p>
        <a href="product.php" class="btn btn-primary btn-lg" style="margin: 10px;">Ver Productos</a>
        <a href="sales.php" class="btn btn-success btn-lg" style="margin: 10px;">Registrar Ventas</a>
        <a href="users.php" class="btn btn-info btn-lg" style="margin: 10px;">Administrar Usuarios</a>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
