<?php
// Incluye el archivo de conexión a la base de datos
require('../admin/conexion.php');
session_start();
$query = "SELECT * FROM usuario
where rut = '$_SESSION[rut]'";
$resultado=mysqli_query($conexion,$query);
$user= mysqli_fetch_assoc($resultado);

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Josefin Sans', sans-serif;  background-color: rgb(240, 223, 255 );" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" style="background-color: rgb(150, 120, 182);">
        <div class="container-fluid ">
            <a class="navbar-brand " href="../pag_principal/index.php">
                <img src="../pag_principal/Logo_KindomJob's.png" alt="Logo_kindomjobs" height="50" class="imagen d-inline-block">
                <span class="h3 align-bottom" style="font-size: 30px;">KindomJob's</span>
            </a>
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class=" navbar-nav mx-auto ">
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href="../pag_principal/index.php"><b>Inicio</b></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href="#"><b>Profesiones</b></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href="#"><b>Servicios</b></a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['rut'])) {
                    ?>
                    <ul class=" navbar-nav mr-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="../user/perfil.php"><button type="button" class="btn btn-light">Perfil</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/logout.php"><button type="button" class="btn btn-light">Cerrar Session</button></a>
                    </li>
                </ul>
                 <?php
                } else{
                    ?>
                    <ul class=" navbar-nav mr-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/login.php"><button type="button" class="btn btn-light">Inicio Sesión</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/registration.php"><button type="button" class="btn btn-light">Registrarse</button></a>
                    </li>
                </ul>
                <?php
                }
                ?>
            </div>
        </div>
    </nav> 
<div class="container mt-5">
    <!-- Sección de Perfil -->
    <div class="card mb-4">
        <div class="card-header header-bg text-center" style=" background-color: RGB(204, 204, 255);">
            <h3>Perfil de Usuario</h3>
        </div>
        <div class="card-body text-center">
            <img src="../<?php echo $user['foto_perfil']; ?>" class="rounded-circle mb-3" alt="Foto de Perfil" width="120" height="120">
            <h4 class="text-dark"><?php echo $user['nombres']; ?></h4>
            <p class="text-muted"><?php echo $user['correo']; ?></p>
            <button class="btn btn-custom">Editar Perfil</button>
        </div>
    </div>

    <!-- Sección de Direcciones -->
    <div class="card mb-4">
        <div class="card-header header-bg" style=" background-color: RGB(204, 204, 255);">
            <h3 class="text-center">Direcciones de Envío</h3>
        </div>
        <div class="card-body section-bg">
            <?php while ($direccion = mysqli_fetch_assoc($result_direccion)) { ?>
                <div class="row mb-3">
                    <div class="col-md-1 text-center">
                        <span class="icon-bg"><i class="bi bi-geo-alt-fill"></i></span>
                    </div>
                    <div class="col-md-10">
                        <p><strong>Dirección:</strong> <?php echo $direccion['direccion']; ?></p>
                        <p><strong>Ciudad:</strong> <?php echo $direccion['ciudad']; ?></p>
                        <p><strong>Teléfono:</strong> <?php echo $direccion['telefono']; ?></p>
                    </div>
                    <div class="col-md-1 text-center">
                        <button class="btn btn-secondary">Editar</button>
                    </div>
                </div>
                <hr>
            <?php } ?>
            <div class="text-center">
                <button class="btn btn-custom mt-3">Agregar Nueva Dirección</button>
            </div>
        </div>
    </div>

    <!-- Sección de Métodos de Pago -->
    <div class="card mb-4">
        <div class="card-header header-bg">
            <h3 class="text-center">Métodos de Pago</h3>
        </div>
        <div class="card-body section-bg">
            <?php while ($pago = mysqli_fetch_assoc($result_pago)) { ?>
                <div class="row mb-3">
                    <div class="col-md-1 text-center">
                        <span class="icon-bg"><i class="bi bi-credit-card-fill"></i></span>
                    </div>
                    <div class="col-md-10">
                        <p><strong>Tipo de Tarjeta:</strong> <?php echo $pago['tipo_tarjeta']; ?></p>
                        <p><strong>Número de Tarjeta:</strong> **** **** **** <?php echo substr($pago['numero_tarjeta'], -4); ?></p>
                    </div>
                    <div class="col-md-1 text-center">
                        <button class="btn btn-secondary">Editar</button>
                    </div>
                </div>
                <hr>
            <?php } ?>
            <div class="text-center">
                <button class="btn btn-custom mt-3">Agregar Nuevo Método de Pago</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>