<?php
    include 'database/conexion.php';

    // Capturar filtros de formulario
    $filtro_ciudad = isset($_POST['provincia']) ? $_POST['provincia'] : null;
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
    if (!empty($filtro_provincia)) {
        $query .= " AND comuna.id_provincia = '$filtro_provincia'";
    }
    if (!empty($filtro_region)) {
        $query .= " AND comuna.id_provincia IN (SELECT id_provincia FROM provincia WHERE id_region = '$filtro_region')";
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

                <div class="form-check">
                    <?php
                     $query_cant_citas="select COUNT(*) as citas from cita where rut_profesional='$row_prof[rut]'";
                     $resultado_cant_citas = mysqli_query($conexion, $query_cant_citas);
                     while ($row_cant_citas = mysqli_fetch_assoc($resultado_cant_citas)){
                        $citas = $row_cant_citas["citas"];
                     }
                    ?>
                    <input class="form-check-input comparar-checkbox" type="checkbox" value="" id="comparar-<?php echo $row_prof['rut']; ?>" data-id='<?php echo $row_prof['rut']; ?>' data-nombre='<?php echo $row_prof['nombres']; ?>' data-precio='<?php echo $monto; ?>' data-servicios='<?php echo implode(",", $servicios); ?>' data-citas='<?php echo $citas; ?>'>
                    <label class="form-check-label" for="comparar-<?php echo $row_prof['rut']; ?>">
                        Comparar
                    </label>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<!-- Modal para mostrar la comparación -->
<div class="modal fade" id="compararModal" tabindex="-1" role="dialog" aria-labelledby="compararModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="compararModalLabel">Comparar Profesionales</h5>
            </div>
            <div class="modal-body">
                <div id="comparar-profesionales">
                    <!-- Aquí se mostrarán los profesionales seleccionados para comparar -->
                </div>
                <canvas id="compararChart" width="400" height="200"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" id="cerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        let profesionalesSeleccionados = [];
        let compararChart = null;

        // Maneja el clic en el checkbox "Comparar"
        $('.comparar-checkbox').change(function () {
            const id = $(this).data('id');
            const nombre = $(this).data('nombre');
            const precio = $(this).data('precio');
            const servicios = $(this).data('servicios').split(',');
            const citas = $(this).data('citas');

            // Agrega o elimina el profesional de la lista de seleccionados
            const index = profesionalesSeleccionados.findIndex(prof => prof.id === id);
            if (index === -1) {
                if (profesionalesSeleccionados.length < 2) {
                    profesionalesSeleccionados.push({ id, nombre, precio, servicios, citas });
                } else {
                    alert('Solo puedes comparar dos profesionales a la vez.');
                    $(this).prop('checked', false);
                }
            } else {
                profesionalesSeleccionados.splice(index, 1);
            }

            // Verifica si los profesionales seleccionados tienen al menos un servicio en común
            if (profesionalesSeleccionados.length === 2) {
                const serviciosComunes = profesionalesSeleccionados[0].servicios.filter(servicio => profesionalesSeleccionados[1].servicios.includes(servicio));
                if (serviciosComunes.length === 0) {
                    alert('Los profesionales seleccionados no tienen servicios en común.');
                    profesionalesSeleccionados.pop();
                    $(this).prop('checked', false);
                }
            }

            // Actualiza la visualización de los profesionales seleccionados
            actualizarComparacion();
        });

        // Actualiza la visualización de los profesionales seleccionados
        function actualizarComparacion() {
            const contenedor = $('#comparar-profesionales');
            contenedor.empty();

            if (profesionalesSeleccionados.length === 0) {
                contenedor.append('<p>No has seleccionado ningún profesional para comparar.</p>');
            } else {
                profesionalesSeleccionados.forEach(prof => {
                    contenedor.append(`
                        <div class="profesional-comparar">
                            <h4>${prof.nombre}</h4>
                            <p>Precio: $${prof.precio}</p>
                        </div>
                    `);
                });

                if (profesionalesSeleccionados.length === 2) {
                    const diferencia = Math.abs(profesionalesSeleccionados[0].precio - profesionalesSeleccionados[1].precio);
                    if (profesionalesSeleccionados[0].precio < profesionalesSeleccionados[1].precio) {
                        contenedor.append(`<p>Diferencia de precio: $${diferencia} , la mejor eleccion segun precio es: ${profesionalesSeleccionados[0].nombre}</p>`);
                    }
                    if (profesionalesSeleccionados[0].precio==profesionalesSeleccionados[1].precio) {
                        contenedor.append(`<p>Los precios son iguales</p>`);
                    }
                    if (profesionalesSeleccionados[0].precio > profesionalesSeleccionados[1].precio) {
                       contenedor.append(`<p>Diferencia de precio: $${diferencia} , la mejor eleccion segun precio es: ${profesionalesSeleccionados[1].nombre}</p>`);  
                    }

                    

                    // Crear gráfico de comparación de citas
                    const ctx = document.getElementById('compararChart').getContext('2d');
                    if (compararChart) {
                        compararChart.destroy();
                    }
                    compararChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [profesionalesSeleccionados[0].nombre, profesionalesSeleccionados[1].nombre],
                            datasets: [{
                                label: 'Número de Citas',
                                data: [profesionalesSeleccionados[0].citas, profesionalesSeleccionados[1].citas],
                                backgroundColor: ['#007bff', '#28a745'],
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    if (profesionalesSeleccionados[0].citas < profesionalesSeleccionados[1].citas) {
                        contenedor.append(`<p>la mejor eleccion segun citas es: ${profesionalesSeleccionados[1].nombre} ,ya que tiene: ${profesionalesSeleccionados[1].citas} citas</p>`);
                    }
                    if (profesionalesSeleccionados[0].citas==profesionalesSeleccionados[1].citas) {
                        contenedor.append(`<p>Los profesionales tienen la misma cantidad de citas</p>`);
                    }
                    if (profesionalesSeleccionados[0].citas > profesionalesSeleccionados[1].citas) {
                       contenedor.append(`<p>la mejor eleccion segun citas es: ${profesionalesSeleccionados[0].nombre} ,ya que tiene: ${profesionalesSeleccionados[0].citas} citas</p>`);  
                    }
                }
            }

            // Muestra el modal si hay dos profesionales seleccionados
            if (profesionalesSeleccionados.length === 2) {
                $('#compararModal').modal('show');
            }
            $('#cerrar').click(function () {
                $('#compararModal').modal('hide');
            });
        }
    });
</script>