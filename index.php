<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="login-page" style="display: flex; justify-content: center; align-items: center; background-color: #f8f9fa; padding: 2rem;">
    <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px;">
        <div class="text-center">
           <h1 style="color: #38006b; font-weight: bold;">Bienvenido</h1>
           <p style="color: #6c757d;">Iniciar sesión</p>
        </div>
        <?php echo display_msg($msg); ?>
        <form method="post" action="auth.php" class="clearfix">
            <div class="form-group">
                <label for="username" class="control-label">Usuario</label>
                <input type="name" class="form-control" name="username" placeholder="Usuario" style="border-radius: 5px;">
            </div>
            <div class="form-group">
                <label for="Password" class="control-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" style="border-radius: 5px;">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">Entrar</button>
            </div>
        </form>
    </div>
</div>
<?php include_once('layouts/footer.php'); ?>
