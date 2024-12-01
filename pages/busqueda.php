<?php
    include 'database/conexion.php';

    // Se capturan los filtros de formulario
    $filtro_provincia = isset($_POST['provincia']) ? $_POST['provincia'] : null;
    $filtro_comuna = isset($_POST['comuna']) ? $_POST['comuna'] : null;
    $filtro_region = isset($_POST['region']) ? $_POST['region'] : null;
    $filtro_profesion = isset($_POST['profesion']) ? $_POST['profesion'] : null;
    $filtro_servicio = isset($_POST['servicio']) ? $_POST['servicio'] : null;
    $filtro_nombre = isset($_POST['nombreprof']) ? $_POST['nombreprof'] : null;

    // Se redirige si no hay filtros
    if (empty($filtro_provincia) && empty($filtro_comuna) && empty($filtro_region) && empty($filtro_profesion) && empty($filtro_servicio) && empty($filtro_nombre)) {
        header('Location: index.php');
        exit;
    }

    // Se crea la consulta SQL en función de los filtros
    $sql_consulta_busqueda_profesional = "SELECT usuario.foto_perfil, profesional.rut, profesion.nombre_profesion, usuario.nombres, 
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
                                          WHERE 1 = 1";

    // Se añaden condiciones según los filtros recibidos
    if (!empty($filtro_nombre)) {
        $sql_consulta_busqueda_profesional .= " AND usuario.nombres LIKE'%$filtro_nombre%'";
    }
    if (!empty($filtro_comuna)) {
        $sql_consulta_busqueda_profesional .= " AND lugar_atencion_presencial.id_comuna = '$filtro_comuna'";
    }
    if (!empty($filtro_provincia)) {
        $sql_consulta_busqueda_profesional .= " AND comuna.id_provincia = '$filtro_provincia'";
    }
    if (!empty($filtro_region)) {
        $sql_consulta_busqueda_profesional .= " AND comuna.id_provincia IN (SELECT id_provincia FROM provincia WHERE id_region = '$filtro_region')";
    }   
    if (!empty($filtro_servicio)) {
        $sql_consulta_busqueda_profesional .= " AND servicio.id_servicio = '$filtro_servicio'";
    }
    if (!empty($filtro_profesion)) {
        $sql_consulta_busqueda_profesional .= " AND profesion.id_profesion = '$filtro_profesion'";
    }

    // Se agrupa por profesional para evitar duplicados
    $sql_consulta_busqueda_profesional .= " GROUP BY profesional.rut";

    // Se ejecuta la consulta
    $resultado_busqueda_profesional = mysqli_query($conexion, $sql_consulta_busqueda_profesional);
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
        <div class="text-center mb-4" style="font-size: 20px;">Resultado de búsqueda de profesionales</div>
        <?php while ($fila_busqueda_profesional = mysqli_fetch_assoc($resultado_busqueda_profesional)): ?>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="profile-section">
                        <img src="<?php echo $fila_busqueda_profesional['foto_perfil'] ?>" alt="Foto de perfil">
                        <div>
                            <h5 class="mt-2"><a href="index.php?p=profesional/perfil_cita&rut=<?php echo $fila_busqueda_profesional['rut']; ?>" class="text-decoration-none"><b><?php echo $fila_busqueda_profesional['nombres']; ?></b></a></h5>
                            <p class="text-muted"><?php echo $fila_busqueda_profesional['nombre_profesion']; ?></p>
                        </div>
                    </div>
                    
                    <!-- Navbar con pestañas de servicios y lugares de atención -->
                    <ul class="nav nav-tabs" id="myTab-<?php echo $fila_busqueda_profesional['rut']; ?>" role="tablist">
                        <?php 
                            $servicios = explode('|', $fila_busqueda_profesional['servicios']);
                            $lugares = explode('|', $fila_busqueda_profesional['lugares_atencion']);
                            foreach ($servicios as $index => $servicio) {
                                echo "<li class='nav-item' role='presentation'>
                                        <button class='nav-link " . ($index === 0 ? 'active' : '') . "' id='servicio-{$index}-tab-{$fila_busqueda_profesional['rut']}' data-bs-toggle='tab' data-bs-target='#servicio-{$index}-{$fila_busqueda_profesional['rut']}' type='button' role='tab' aria-controls='servicio-{$index}-{$fila_busqueda_profesional['rut']}' aria-selected='" . ($index === 0 ? 'true' : 'false') . "'>Servicio " . ($index + 1) . "</button>
                                      </li>";
                            }
                        ?>
                    </ul>

                    <!-- Contenido de cada pestaña de servicios -->
                    <div class="tab-content" id="myTabContent-<?php echo $fila_busqueda_profesional['rut']; ?>">
                        <?php 
                            foreach ($servicios as $index => $servicio) {
                                $monto = explode('|', $fila_busqueda_profesional['montos'])[$index];
                                echo "<div class='tab-pane fade " . ($index === 0 ? 'show active' : '') . "' id='servicio-{$index}-{$fila_busqueda_profesional['rut']}' role='tabpanel' aria-labelledby='servicio-{$index}-tab-{$fila_busqueda_profesional['rut']}'>
                                        <br>
                                        <p><b>Servicio:</b> " . htmlspecialchars($servicio) . " - <b>Precio:</b> $" . htmlspecialchars($monto) . "</p>
                                      </div>";
                            }
                        ?>
                    </div>

                    <div class="mt-3">
                        <ul class="nav nav-tabs" id="direccionTab-<?php echo $fila_busqueda_profesional['rut']; ?>" role="tablist">
                            <?php foreach ($lugares as $index => $lugar): ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?php echo ($index === 0 ? 'active' : ''); ?>" id="direccion-<?php echo $index; ?>-tab-<?php echo $fila_busqueda_profesional['rut']; ?>" data-bs-toggle="tab" data-bs-target="#direccion-<?php echo $index; ?>-<?php echo $fila_busqueda_profesional['rut']; ?>" type="button" role="tab" aria-controls="direccion-<?php echo $index; ?>-<?php echo $fila_busqueda_profesional['rut']; ?>" aria-selected="<?php echo ($index === 0 ? 'true' : 'false'); ?>">
                                        Dirección <?php echo $index + 1; ?>
                                    </button>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content" id="direccionTabContent-<?php echo $fila_busqueda_profesional['rut']; ?>">
                            <?php 
                                foreach ($lugares as $index => $lugar) {
                                    echo "<div class='tab-pane fade " . ($index === 0 ? 'show active' : '') . "' id='direccion-{$index}-{$fila_busqueda_profesional['rut']}' role='tabpanel' aria-labelledby='direccion-{$index}-tab-{$fila_busqueda_profesional['rut']}'>
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
