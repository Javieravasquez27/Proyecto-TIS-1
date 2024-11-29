<?php
    include 'database/conexion.php';

    // Capturar filtros de formulario
    $filtro_ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
    $filtro_comuna = isset($_POST['comuna']) ? $_POST['comuna'] : null;
    $filtro_region = isset($_POST['region']) ? $_POST['region'] : null;
    $filtro_profesion = isset($_POST['profesion']) ? $_POST['profesion'] : null;
    $filtro_servicio = isset($_POST['servicio']) ? $_POST['servicio'] : null;
    $filtro_nombre = isset($_POST['nombreprof']) ? $_POST['nombreprof'] : null;

    // Redirigir si no hay filtros
    if (empty($filtro_ciudad) && empty($filtro_comuna) && empty($filtro_region) && empty($filtro_profesion) && empty($filtro_servicio) && empty($filtro_nombre)) {
        header('Location: index.php');
        exit;
    }

    // Crear la consulta SQL en función de los filtros
    $query = "SELECT usuario.foto_perfil, profesional.rut, profesion.nombre_profesion, usuario.nombres, 
              GROUP_CONCAT(DISTINCT servicio.nombre_servicio ORDER BY servicio.nombre_servicio SEPARATOR '|') AS servicios, 
              GROUP_CONCAT(DISTINCT servicio_profesional.precio_serv_prof ORDER BY servicio.nombre_servicio SEPARATOR '|') AS montos,
              GROUP_CONCAT(DISTINCT comuna.nombre_comuna ORDER BY comuna.nombre_comuna SEPARATOR '|') AS lugares_atencion 
              FROM usuario
              JOIN profesional ON profesional.rut = usuario.rut
              JOIN profesion ON profesion.id_profesion = profesional.id_profesion
              JOIN servicio_profesional ON servicio_profesional.rut_profesional = profesional.rut
              JOIN servicio ON servicio.id_servicio = servicio_profesional.id_servicio
              JOIN lugar_atencion_presencial ON lugar_atencion_presencial.rut_profesional = profesional.rut
              JOIN comuna ON lugar_atencion_presencial.id_comuna = comuna.id_comuna
              WHERE 1=1";

    // Añadir condiciones según los filtros recibidos
    if (!empty($filtro_nombre)) {
        $query .= " AND usuario.nombres LIKE'%$filtro_nombre%'";
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
    $query .= " GROUP BY profesional.rut";

    // Ejecutar la consulta
    $resultado_prof = mysqli_query($conexion, $query);
?>

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

    <div class="container mt-3">
        <div class="text-center mb-4" style="font-size: 20px;">Resultado búsqueda de profesionales</div>
        <?php while ($row_prof = mysqli_fetch_assoc($resultado_prof)): ?>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="profile-section">
                        <img src="<?php echo $row_prof['foto_perfil'] ?>" alt="Foto de perfil">
                        <div>
                            <h5 class="mt-2"><a href="index.php?p=profesional/perfil_cita&rut=<?php echo $row_prof['rut']; ?>" class="text-decoration-none"><b><?php echo $row_prof['nombres']; ?></b></a></h5>
                            <p class="text-muted"><?php echo $row_prof['nombre_profesion']; ?></p>
                        </div>
                    </div>
                    
                    <!-- Navbar con pestañas de servicios y lugares de atención -->
                    <ul class="nav nav-tabs" id="myTab-<?php echo $row_prof['rut']; ?>" role="tablist">
                        <?php 
                        $servicios = explode('|', $row_prof['servicios']);
                        $lugares = explode('|', $row_prof['lugares_atencion']);
                        foreach ($servicios as $index => $servicio) {
                            echo "<li class='nav-item' role='presentation'>
                                    <button class='nav-link " . ($index === 0 ? 'active' : '') . "' id='servicio-{$index}-tab-{$row_prof['rut']}' data-bs-toggle='tab' data-bs-target='#servicio-{$index}-{$row_prof['rut']}' type='button' role='tab' aria-controls='servicio-{$index}-{$row_prof['rut']}' aria-selected='" . ($index === 0 ? 'true' : 'false') . "'>Servicio " . ($index + 1) . "</button>
                                  </li>";
                        }
                        ?>
                    </ul>

                    <!-- Contenido de cada pestaña de servicios -->
                    <div class="tab-content" id="myTabContent-<?php echo $row_prof['rut']; ?>">
                        <?php 
                        foreach ($servicios as $index => $servicio) {
                            $monto = explode('|', $row_prof['montos'])[$index];
                            echo "<div class='tab-pane fade " . ($index === 0 ? 'show active' : '') . "' id='servicio-{$index}-{$row_prof['rut']}' role='tabpanel' aria-labelledby='servicio-{$index}-tab-{$row_prof['rut']}'>
                                    <br>
                                    <p><b>Servicio:</b> " . htmlspecialchars($servicio) . " - <b>Precio:</b> " . htmlspecialchars($monto) . "$</p>
                                  </div>";
                        }
                        ?>
                    </div>

                    <div class="mt-3">
                        <ul class="nav nav-tabs" id="direccionTab-<?php echo $row_prof['rut']; ?>" role="tablist">
                            <?php foreach ($lugares as $index => $lugar): ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?php echo ($index === 0 ? 'active' : ''); ?>" id="direccion-<?php echo $index; ?>-tab-<?php echo $row_prof['rut']; ?>" data-bs-toggle="tab" data-bs-target="#direccion-<?php echo $index; ?>-<?php echo $row_prof['rut']; ?>" type="button" role="tab" aria-controls="direccion-<?php echo $index; ?>-<?php echo $row_prof['rut']; ?>" aria-selected="<?php echo ($index === 0 ? 'true' : 'false'); ?>">
                                        Dirección <?php echo $index + 1; ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content" id="direccionTabContent-<?php echo $row_prof['rut']; ?>">
                            <?php 
                            foreach ($lugares as $index => $lugar) {
                                echo "<div class='tab-pane fade " . ($index === 0 ? 'show active' : '') . "' id='direccion-{$index}-{$row_prof['rut']}' role='tabpanel' aria-labelledby='direccion-{$index}-tab-{$row_prof['rut']}'>
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
