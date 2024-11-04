<?php
    require('../admin/conexion.php');
    session_start();
    $username = $_GET['username'];
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página del Profesional</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
<body >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="../pag_principal/index.php">
                <img src="../pag_principal/Logo_KindomJob's.png" alt="Logo_kindomjobs" height="50">
                <span class="h3">KindomJob's</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="../pag_principal/index.php"><b>Inicio</b></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><b>Profesionales</b></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><b>Servicios</b></a></li>
                </ul>
                <?php if (isset($_SESSION['rut'])): ?>
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="../user/perfil.php"><button type="button" class="btn btn-light">Perfil</button></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Login/logout.php"><button type="button" class="btn btn-light">Cerrar Sesión</button></a></li>
                    </ul>
                <?php else: ?>
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="../Login/login.php"><button type="button" class="btn btn-light">Iniciar Sesión</button></a></li>
                        <li class="nav-item"><a class="nav-link" href="../Login/registration.php"><button type="button" class="btn btn-light">Registrarse</button></a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <?php
        $query = "SELECT * FROM comuna,institucion, usuario join profesional using (nombre_usuario) join profesion using (id_profesion)
                  where profesional.id_institucion = institucion.id_institucion
                  and usuario.id_comuna = comuna.id_comuna ";
        $resultado_prof = mysqli_query($conexion, $query);
        $row_prof = mysqli_fetch_assoc($resultado_prof);
        ?>
        
        <div class="profile-header">
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
                <!-- A pagar -->
                <form action="" method="POST"></form>
                <div class="calendar">
                    <h5 class="mb-3">Reservar Cita</h5>
                    <select class="form-select mb-3">
                        <option value="" selected>Servicio</option>
                        <?php
                                    $nombre_servicio="SELECT * FROM servicio";
                                    $resultado_servicio=mysqli_query($conexion,$nombre_servicio);
                                    while($row_servicio= mysqli_fetch_assoc($resultado_servicio)){
                                        $nombre = $row_servicio["nombre_servicio"];
                                        $id = $row_servicio["id_servicio"];
                                        echo "<option value=".$id.">".$nombre."</option>";
                                    }
                                ?>
                    </select>
                    <input type="date" class="form-control mb-3" id="fecha" name="fecha">
                    <div class="d-grid gap-2" id="horas-disponibles">
                    </div>
                </div>
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
