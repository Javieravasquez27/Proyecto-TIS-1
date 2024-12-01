<?php 
    define('PERMISO_REQUERIDO', 'admin_panel_access');
    include("middleware/auth.php");
?>

<title>Panel de Administradores - KindomJob's</title>

<div class="container">
    <h1 class="text-center my-5">Panel de Administradores</h1>
    <div class="row">
        <?php if ($_SESSION['id_rol'] == 1): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mantenedores</h5>
                        <p class="card-text">Administra los mantenedores de la plataforma.</p>
                        <a href="index.php?p=admin/mantenedores/index" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Administra los usuarios de la plataforma, activando o desactivando sus cuentas.
                                         <?php if ($_SESSION['id_rol'] == 1): ?>También puedes cambiar sus roles dentro de la página.<?php endif; ?></p>
                    <a href="index.php?p=admin/users/index" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profesionales</h5>
                    <p class="card-text">Gestiona las autorizaciones de los profesionales que solicitan registrarse en la plataforma.</p>
                    <a href="index.php?p=admin/profesionales/index" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>
        <?php if ($_SESSION['id_rol'] == 1): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Permisos para Roles</h5>
                        <p class="card-text">Gestiona los permisos que tienen cada uno de los roles de usuario dentro de la plataforma.</p>
                        <a href="index.php?p=admin/profesionales/index" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($_SESSION['id_rol'] == 1): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Servicios para Profesiones</h5>
                        <p class="card-text">Gestiona los servicios que pueden prestar los profesionales de acuerdo a su profesión.</p>
                        <a href="index.php?p=admin/servicio_profesion/index" class="btn btn-primary">Entrar</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Página Principal</h5>
                    <p class="card-text">Ir a la página principal de KindomJob's.</p>
                    <a href="index.php?p=home" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>