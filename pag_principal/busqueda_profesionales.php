<?php
require('conexion.php');
session_start();

// Capturar filtros de formulario
$filtro_ciudad = isset($_POST['filtro_ciudad']) ? $_POST['filtro_ciudad'] : null;
$filtro_comuna = isset($_POST['filtro_comuna']) ? $_POST['filtro_comuna'] : null;
$filtro_region = isset($_POST['filtro_region']) ? $_POST['filtro_region'] : null;
$filtro_profesion = isset($_POST['filtro_profesion']) ? $_POST['filtro_profesion'] : null;
$filtro_servicio = isset($_POST['filtro_servicio']) ? $_POST['filtro_servicio'] : null;
$filtro_nombre = isset($_POST['filtro_nombreprof']) ? $_POST['filtro_nombreprof'] : null;

// Redirigir si no hay filtros
if (empty($filtro_ciudad) && empty($filtro_comuna) && empty($filtro_region) && empty($filtro_profesion) && empty($filtro_servicio) && empty($filtro_nombre)) {
    header('Location: index.php');
    exit;
}

// Crear la consulta SQL en función de los filtros
$query = "SELECT usuario.foto_perfil, profesional.nombre_usuario, profesion.nombre_profesion, usuario.nombres, 
          GROUP_CONCAT(DISTINCT servicio.nombre_servicio ORDER BY servicio.nombre_servicio SEPARATOR '|') AS servicios, 
          GROUP_CONCAT(DISTINCT servicio_prof.monto ORDER BY servicio.nombre_servicio SEPARATOR '|') AS montos,
          GROUP_CONCAT(DISTINCT comuna.nombre_comuna ORDER BY comuna.nombre_comuna SEPARATOR '|') AS lugares_atencion 
          FROM usuario
          JOIN profesional ON profesional.nombre_usuario = usuario.nombre_usuario
          JOIN profesion ON profesion.id_profesion = profesional.id_profesion
          JOIN servicio_prof ON servicio_prof.nombre_usuario_prof = profesional.nombre_usuario
          JOIN servicio ON servicio.id_servicio = servicio_prof.id_servicio
          JOIN lugar_atencion_presencial ON lugar_atencion_presencial.nombre_usuario_prof = profesional.nombre_usuario
          JOIN comuna ON lugar_atencion_presencial.id_comuna = comuna.id_comuna
          WHERE 1=1";

// Añadir condiciones según los filtros recibidos
if (!empty($filtro_nombre)) {
    $query .= " AND LOWER(usuario.nombre_usuario) LIKE LOWER('%$filtro_nombre%')";
}
if (!empty($filtro_comuna)) {
    $query .= " AND lugar_atencion_presencial.id_comuna = '$filtro_comuna'";
}
if (!empty($filtro_ciudad)) {
    $query .= " AND comuna.id_ciudad = '$filtro_ciudad'";
}
if (!empty($filtro_region)) {
    $query .= " AND comuna.id_ciudad IN (SELECT id_ciudad FROM ciudad WHERE id_region = '$filtro_region')";
}
if (!empty($filtro_servicio)) {
    $query .= " AND servicio.id_servicio = '$filtro_servicio'";
}
if (!empty($filtro_profesion)) {
    $query .= " AND profesion.id_profesion = '$filtro_profesion'";
}

// Agrupar por profesional para evitar duplicados
$query .= " GROUP BY profesional.nombre_usuario";

// Ejecutar la consulta
$resultado_prof = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KindomJob's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../estilos.css">
    <style>
        .no-style-link { color: inherit; text-decoration: none; }
        .card { max-width: 900px; margin: 20px auto; border: 1px solid #ddd; border-radius: 8px; }
        .profile-section { display: flex; align-items: center; margin-bottom: 15px; }
        .profile-section img { border-radius: 50%; width: 100px; height: 100px; margin-right: 15px; border: 2px solid #ddd; }
        .badge { background-color: #e6f4ea; color: #28a745; font-size: 0.8rem; padding: 5px 10px; border-radius: 5px; }
        .text-muted { font-size: 0.9rem; }
        .nav-tabs .nav-link.active { font-weight: bold; color: #000; }
        .nav-tabs .nav-link { color: #666; }
    </style>
</head>
<body style="font-family: 'Josefin Sans', sans-serif; background-color: rgb(240, 223, 255);">
    <nav class="navbar sticky-top navbar-expand-lg bg-gradient bg-opacity-50" style="background-color: rgb(150, 120, 182);">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="./Logo_KindomJob's.png" alt="Logo_kindomjobs" height="50">
                <span class="h3 align-bottom" style="font-size: 30px;">KindomJob's</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php"><b>Inicio</b></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#"><b>Profesiones</b></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#"><b>Servicios</b></a></li>
                </ul>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="#"><button type="button" class="btn btn-light">Inicio Sesión</button></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><button type="button" class="btn btn-light">Registrarse</button></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="text-center mb-4" style="font-size: 20px;">Resultado búsqueda de profesionales</div>
        <?php while ($row_prof = mysqli_fetch_assoc($resultado_prof)): ?>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="profile-section">
                        <img src="<?php echo $row_prof['foto_perfil'] ? '../' . $row_prof['foto_perfil'] : '../images/sin_foto.jpg'; ?>" alt="Foto de perfil">
                        <div>
                            <h5 class="mt-2"><a href="../profesional/perfilcita.php?username=<?php echo $row_prof['nombre_usuario']; ?>" class="no-style-link"><b><?php echo $row_prof['nombres']; ?></b></a></h5>
                            <p class="text-muted"><?php echo $row_prof['nombre_profesion']; ?></p>
                        </div>
                    </div>
                    
                    <!-- Navbar con pestañas de servicios y lugares de atención -->
                    <ul class="nav nav-tabs" id="myTab-<?php echo $row_prof['nombre_usuario']; ?>" role="tablist">
                        <?php 
                        $servicios = explode('|', $row_prof['servicios']);
                        $lugares = explode('|', $row_prof['lugares_atencion']);
                        foreach ($servicios as $index => $servicio) {
                            echo "<li class='nav-item' role='presentation'>
                                    <button class='nav-link " . ($index === 0 ? 'active' : '') . "' id='servicio-{$index}-tab-{$row_prof['nombre_usuario']}' data-bs-toggle='tab' data-bs-target='#servicio-{$index}-{$row_prof['nombre_usuario']}' type='button' role='tab' aria-controls='servicio-{$index}-{$row_prof['nombre_usuario']}' aria-selected='" . ($index === 0 ? 'true' : 'false') . "'>Servicio " . ($index + 1) . "</button>
                                  </li>";
                        }
                        ?>
                    </ul>

                    <!-- Contenido de cada pestaña de servicios -->
                    <div class="tab-content" id="myTabContent-<?php echo $row_prof['nombre_usuario']; ?>">
                        <?php 
                        foreach ($servicios as $index => $servicio) {
                            $monto = explode('|', $row_prof['montos'])[$index];
                            echo "<div class='tab-pane fade " . ($index === 0 ? 'show active' : '') . "' id='servicio-{$index}-{$row_prof['nombre_usuario']}' role='tabpanel' aria-labelledby='servicio-{$index}-tab-{$row_prof['nombre_usuario']}'>
                                    <br>
                                    <p><b>Servicio:</b> " . htmlspecialchars($servicio) . " - <b>Precio:</b> " . htmlspecialchars($monto) . "$</p>
                                  </div>";
                        }
                        ?>
                    </div>

                    <div class="mt-3">
                        <ul class="nav nav-tabs" id="direccionTab-<?php echo $row_prof['nombre_usuario']; ?>" role="tablist">
                            <?php foreach ($lugares as $index => $lugar): ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?php echo ($index === 0 ? 'active' : ''); ?>" id="direccion-<?php echo $index; ?>-tab-<?php echo $row_prof['nombre_usuario']; ?>" data-bs-toggle="tab" data-bs-target="#direccion-<?php echo $index; ?>-<?php echo $row_prof['nombre_usuario']; ?>" type="button" role="tab" aria-controls="direccion-<?php echo $index; ?>-<?php echo $row_prof['nombre_usuario']; ?>" aria-selected="<?php echo ($index === 0 ? 'true' : 'false'); ?>">
                                        Dirección <?php echo $index + 1; ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content" id="direccionTabContent-<?php echo $row_prof['nombre_usuario']; ?>">
                            <?php 
                            foreach ($lugares as $index => $lugar) {
                                echo "<div class='tab-pane fade " . ($index === 0 ? 'show active' : '') . "' id='direccion-{$index}-{$row_prof['nombre_usuario']}' role='tabpanel' aria-labelledby='direccion-{$index}-tab-{$row_prof['nombre_usuario']}'>
                                        <br>
                                        <p>Dirección: " . htmlspecialchars($lugar) . "</p>
                                      </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
