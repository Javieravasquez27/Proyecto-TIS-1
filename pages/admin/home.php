<?php
    include("middleware/auth.php");
?>

<title>Panel de Administradores - KindomJob's</title>

<div class="container">
    <h1 class="text-center my-5">Panel de Administradores</h1>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mantenedores</h5>
                    <p class="card-text">Administra los mantenedores de la plataforma.</p>
                    <a href="index.php?p=admin/mantenedores/index" class="btn btn-primary">Ir a Mantenedores</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Administra los usuarios de la plataforma.</p>
                    <a href="index.php?p=admin/users/index" class="btn btn-primary">Ir a Usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Página Principal</h5>
                    <p class="card-text">Ir a la página principal de KindomJob's.</p>
                    <a href="index.php?p=home" class="btn btn-primary">Ir a Página Principal</a>
                </div>
            </div>
        </div>
    </div>
</div>