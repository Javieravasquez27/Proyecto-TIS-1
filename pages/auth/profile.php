<?php 
    define('PERMISO_REQUERIDO', 'Acceder a las páginas de clientes');
    include("middleware/auth.php");
?>

<title>Perfil de <?php echo $_SESSION['nombre_usuario']; ?> - KindomJob's</title>