<?php
    define('PERMISO_REQUERIDO', 'client_pages_access');
    include("middleware/auth.php");
    include("database/conexion.php");

    if (!isset($_GET['nombre_usuario'])) {
        header('Location: index.php?p=error/pagina_no_existe.php');
    }
    
    $nombre_usuario = mysqli_real_escape_string($conexion, $_GET['nombre_usuario']);
    $sql_consulta_usuario = "SELECT u.*, c.nombre_comuna AS comuna, r.nombre_rol AS rol
                             FROM usuario u
                             LEFT JOIN comuna c ON u.id_comuna = c.id_comuna
                             LEFT JOIN rol r ON u.id_rol = r.id_rol
                             WHERE u.nombre_usuario = '$nombre_usuario'";
    $resultado_consulta_usuario = mysqli_query($conexion, $sql_consulta_usuario);
    $fila_usuario = mysqli_fetch_assoc($resultado_consulta_usuario);

    if (!$fila_usuario) {
       header('Location: index.php?p=error/pagina_no_existe.php');
    }
?>

<link rel="stylesheet" href="public/css/perfil.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<title>Perfil <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 3): ?> Profesional <?php endif; ?> de
    <?php echo $_SESSION['nombre_usuario']; ?> - KindomJob's
</title>

<div class="container mt-5">
    <!-- Sección de Perfil -->
    <div class="card mb-4">
        <div class="card-header header-bg text-center" style=" background-color: RGB(204, 204, 255);">
            <h3 style="margin-top: 2px; margin-bottom: -5px;">Perfil de Usuario</h3>
        </div>
        <div class="card-body text-center">
            <img src="<?php echo $fila_usuario['foto_perfil']?>" class="rounded-circle mb-3" alt="Foto de Perfil" width="120"
                height="120">
            <h4 class="text-dark">
                <?php echo $fila_usuario['nombres']; ?> <?php echo $fila_usuario['apellido_p']; ?> <?php echo $fila_usuario['apellido_m']; ?>
            </h4>
            <p class="text-muted">
                <i class="bi bi-geo-alt"></i> <?php echo $fila_usuario['comuna']; ?><br>
                <i class="bi bi-envelope"></i> <?php echo $fila_usuario['correo']; ?> - <i class="bi bi-telephone"></i> <?php echo $fila_usuario['telefono']; ?>
            </p>
            <?php if ($_SESSION['rut'] == $fila_usuario['rut']): ?>
                <a href="index.php?p=perfil/editar&rut=<?php echo $_SESSION['rut']; ?>" class="btn btn-custom">Editar Perfil</a>
            <?php endif; ?>
        </div>
    </div>
</div>