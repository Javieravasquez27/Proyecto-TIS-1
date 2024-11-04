<?php
    include 'database/conexion.php';
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
        $query .= " AND usuario.nombres = '$filtro_nombre'";
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
