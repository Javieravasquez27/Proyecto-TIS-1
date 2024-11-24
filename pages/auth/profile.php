<?php 
    define('PERMISO_REQUERIDO', 'client_pages_access');
    include("middleware/auth.php");
?>

<link rel="stylesheet" href="public/css/profile_profesional.css">

<title>Perfil de
    <?php echo $_SESSION['nombre_usuario']; ?> - KindomJob's
</title>

<div class="container mt-5">
    <!-- Sección de Perfil -->
    <div class="card mb-4">
        <div class="card-header header-bg text-center" style=" background-color: RGB(204, 204, 255);">
            <h3 style="margin-top: 2px; margin-bottom: -5px;">Perfil de Usuario</h3>
        </div>
        <div class="card-body text-center">
            <img src="<?php echo $usuario['foto_perfil']?>" class="rounded-circle mb-3" alt="Foto de Perfil" width="120"
                height="120">
            <h4 class="text-dark">
                <?php echo $usuario['nombres']; ?>
            </h4>
            <p class="text-muted">
                <?php echo $usuario['correo']; ?>
            </p>
            <button class="btn btn-custom">Editar Perfil</button>
        </div>
    </div>