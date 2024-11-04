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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../estilos.css">
    <script
        src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
        crossorigin="anonymous"></script>
    <style>
        /* Estilos principales */
        .card { 
            max-width: 900px; 
            margin: 20px auto; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }
        
        /* Perfil */
        .profile-section { 
            display: flex; 
            align-items: center; 
            margin-bottom: 15px; 
        }
        .profile-section img { 
            border-radius: 50%; 
            width: 100px; 
            height: 100px; 
            margin-right: 15px; 
            border: 2px solid #ddd;
        }
        .badge { 
            background-color: #e6f4ea; 
            color: #28a745; 
            font-size: 0.8rem; 
            padding: 5px 10px; 
            border-radius: 5px; 
        }
        
        /* Texto */
        .text-muted { 
            font-size: 0.9rem; 
        }
        .price-info { 
            font-weight: bold; 
            font-size: 1.1rem; 
            color: #333; 
        }

        /* Disponibilidad */
        .availability { 
            margin-top: 20px; 
        }
        .day-column { 
            text-align: center; 
            margin: 10px 0; 
        }
        .day-column strong { 
            display: block; 
            font-weight: 600; 
            margin-bottom: 10px; 
            font-size: 0.9rem; 
        }
        .day-column input { 
            width: 100%; 
            margin: 5px 0; 
            font-size: 0.9rem; 
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .profile-section { 
                flex-direction: column; 
                align-items: flex-start; 
                text-align: left; 
            }
            .profile-section img { 
                margin-bottom: 10px; 
            }
            .day-column button { 
                width: 100%; 
            }
        }
        .nav-tabs .nav-link.active {
            font-weight: bold; /* Texto en negrita */
            border: none;
            border-bottom: 3px solid #000; /* Línea inferior en negrita */
            color: #000; /* Color del texto */
        }
        /* Estilo para las pestañas inactivas */
        .nav-tabs .nav-link {
            color: #666; /* Color del texto inactivo */
        }
    </style>
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
                    <?php if ($user['id_rol']==11) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="../profesional/perfil.php"><button type="button" class="btn btn-light">Perfil</button></a>
                        </li>
                    <?php
                    }else{?>
                        <li class="nav-item">
                            <a class="nav-link" href="../user/perfil.php"><button type="button" class="btn btn-light">Perfil</button></a>
                        </li>
                    <?php
                    }
                    ?>
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
        <form action="guardar_disponibilidad.php" method="POST">
        <div class="card-header header-bg" style=" background-color: RGB(204, 204, 255);">
            <h3 class="text-center">Establecer Horarios</h3>
        </div>
        <div class="card-body section-bg">
        <div class="tab-content mt-3">
            <div class="availability">
                <div class="row">
                    <div class="col-2 day-column">
                        <strong>lunes</strong>
                        <!-- Aquí puedes añadir los horarios -->
                        <input type="hidden" name="dia[]" value='lunes'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                        <strong>martes</strong>
                        <input type="hidden" name="dia[]" value='martes'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                        <strong>Mié</strong>
                        <input type="hidden" name="dia[]" value='miércoles'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                        <strong>jue</strong>
                        <input type="hidden" name="dia[]" value='jueves'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                    <strong>Vir</strong>
                    <input type="hidden" name="dia[]" value='viernes'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                    <strong>Sab</strong>
                    <input type="hidden" name="dia[]" value='sábado'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                </div>
                <div class="row">
                <div class="col-4"></div>
                <div class="col-4"><button type="submit">Guardar Disponibilidad</button></div>
                <div class="col-4"></div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <!-- Sección de Métodos de Pago -->
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>