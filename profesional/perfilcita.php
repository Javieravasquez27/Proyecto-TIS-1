<?php
    require('../admin/conexion.php');
    session_start();
    $username = $_GET['username'];
    if (isset($_SESSION['rut'])) {
        $query = "SELECT * FROM usuario
        where rut = '$_SESSION[rut]'";
        $resultado=mysqli_query($conexion,$query);
        $user= mysqli_fetch_assoc($resultado);  
    }
    $_SESSION["username"] = $username;
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página del Profesional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script
        src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* Colores y estilos personalizados */
        body {
            background-color: white;
            font-family: Arial, sans-serif;
            color: black;
        }
        .navbar {
            background-color: rgb(150, 120, 182);
        }
        .navbar .navbar-brand span {
            color: black;
        }
        .navbar .navbar-nav .nav-link {
            color: white;
        }
        .profile-header, .calendar {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .profile-header {
            text-align: center;
        }
        .profile-header img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
        }
        .nav-tabs .nav-link {
            border: 1px solid #ddd;
            border-radius: 0;
            color: black;
        }
        .nav-tabs .nav-link.active {
            background-color: #ddd;
            color: black;
        }
        .tab-content {
            border: 1px solid #ddd;
            padding: 20px;
        }
        .service-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .graph-placeholder {
            height: 150px;
            border: 1px solid #ddd;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }
        .calendar select, .calendar input {
            margin: 5px 0;
            width: 100%;
            padding: 5px;
        }
        .calendar .btn-time {
            background-color: rgb(153, 102, 255);
            color: white;
            border: none;
            margin: 5px 0;
            width: 100%;
        }
        .calendar .btn-time:hover {
            background-color: rgb(128, 0, 128);
        }
    </style>
</head>
<body style="font-family: 'Josefin Sans', sans-serif;" >
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
    <div class="container my-5">
        <?php
        $query = "SELECT * FROM comuna,institucion, usuario join profesional using (nombre_usuario) join profesion using (id_profesion)
                  where profesional.id_institucion = institucion.id_institucion
                  and usuario.id_comuna = comuna.id_comuna 
                  and usuario.nombre_usuario = '$username'";
        $resultado_prof = mysqli_query($conexion, $query);
        $row_prof = mysqli_fetch_assoc($resultado_prof);
        ?>
        
        <div class="profile-header">
            <?php ?>
            <img src="../<?php echo $row_prof['foto_perfil']?>" alt="Foto de perfil" class="rounded-circle mb-3">
            <h2><?php echo $row_prof['nombres']?> <?php echo $row_prof['apellido_p']?> <?php echo $row_prof['apellido_m']?></h2>
            <p><?php echo $row_prof['nombre_profesion']?></p>
            <p><?php echo $row_prof['nombre_comuna']?></p>
        </div>

        <div class="row mt-4">
            <!-- Sección de información y servicios -->
            <div class="col-md-8">
                <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button">Servicios y precios</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button">Experiencia</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="opinions-tab" data-bs-toggle="tab" data-bs-target="#opinions" type="button">Opiniones</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#direcciones" type="button">Direcciones</button>
                    </li>
                </ul>
                <div class="tab-content" id="profileTabContent">
                    <div class="tab-pane fade show active" id="services" role="tabpanel">
                        <h5>Servicios y Precios</h5>
                        <?php
                        $query = "SELECT nombre_servicio, monto from servicio_prof join servicio using (id_servicio)
                        where nombre_usuario_prof = '$username'";
                        $resultado_prof = mysqli_query($conexion, $query);
                        while($row_prof = mysqli_fetch_assoc($resultado_prof)){

                        ?>
                        <div class="service-item"><span><?php echo $row_prof['nombre_servicio'] ?></span><span>$<?php echo $row_prof['monto'] ?></span></div>
                        <?php
                        }
                        ?>
                        <div class="graph-placeholder">[Gráfico]</div>
                    </div>
                    <div class="tab-pane fade" id="direcciones" role="tabpanel">
                        <h5>Direcciones</h5>
                        <?php
                        $query = "SELECT nombre_comuna, nombre_ciudad,nombre_region from lugar_atencion_presencial join comuna using (id_comuna) join ciudad using (id_ciudad) join region using (id_region)
                        where nombre_usuario_prof = '$username'";
                        $resultado_prof = mysqli_query($conexion, $query);
                        while($row_prof = mysqli_fetch_assoc($resultado_prof)){

                        ?>
                        <div class="service-item"><span><b>Direccion: </b><?php echo $row_prof['nombre_comuna'] ?> , <?php echo $row_prof['nombre_ciudad'] ?> , <?php echo $row_prof['nombre_region'] ?></div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="experience" role="tabpanel">
                        <h5>Experiencia</h5>
                        <p>esto lo escribe el profesional</p>
                    </div>
                    <div class="tab-pane fade" id="opinions" role="tabpanel">
                        <h5>Opiniones</h5>
                        <p>Opiniones de los clientes...</p>
                    </div>
                </div>
            </div>

            <!-- Sección de reserva de citas -->
            <div class="col-md-4">
                <form action="../pasarela_pago/index.php" method="POST">
                <!-- A pagar -->
                    <div class="calendar">
                        <h5 class="mb-3">Reservar Cita</h5>
                        <select class="form-select mb-3" name="amount" required>
                            <option value="" selected>Servicio</option>
                            <?php
                                        $nombre_servicio="SELECT * FROM servicio join servicio_prof using (id_servicio)
                                        where nombre_usuario_prof = '$username'";
                                        $resultado_servicio=mysqli_query($conexion,$nombre_servicio);
                                        while($row_servicio= mysqli_fetch_assoc($resultado_servicio)){
                                            $nombre = $row_servicio["nombre_servicio"];
                                            $monto = $row_servicio["monto"];
                                            echo "<option value=".$monto.">".$nombre."</option>";
                                        }
                                    ?>
                        </select>
                        <input type="date" class="form-control mb-3" id="fecha" name="fecha">
                        <div class="d-grid gap-2" id="horas-disponibles">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Detecta cuando cambia la fecha y hace una solicitud AJAX
        $('#fecha').on('change', function () {
            const fechaSeleccionada = $(this).val();

            if (fechaSeleccionada) {
                $.ajax({
                    url: 'consultar_disponibilidad.php', // Archivo PHP que manejará la solicitud
                    type: 'POST',
                    data: { fecha: fechaSeleccionada },
                    success: function (data) {
                        // Actualiza la lista de horas disponibles
                        $('#horas-disponibles').html(data);
                    },
                    error: function () {
                        $('#horas-disponibles').html('<li>Error al obtener disponibilidad</li>');
                    }
                });
            }
        });
    </script>
</body>
</html>
