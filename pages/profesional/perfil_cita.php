<?php
define('PERMISO_REQUERIDO', 'client_pages_access');
include("middleware/auth.php");
include("database/conexion.php");
$rut = $_GET['rut'];
$rut_cliente = $_SESSION['rut'];

$consulta_profesional = "SELECT * FROM comuna, institucion, usuario JOIN profesional USING (rut)
                                       JOIN profesion USING (id_profesion)
                         WHERE profesional.id_institucion = institucion.id_institucion
                         AND usuario.id_comuna = comuna.id_comuna
                         AND profesional.rut = '$rut';";
$resultado_profesional = mysqli_query($conexion, $consulta_profesional);
$fila_profesional = mysqli_fetch_assoc($resultado_profesional);

$consulta_serv_prof = "SELECT sp.id_servicio, sp.rut_profesional, s.nombre_servicio AS nombre_servicio,
                              sp.precio_serv_prof
                       FROM servicio_profesional sp LEFT JOIN servicio s ON sp.id_servicio = s.id_servicio 
                       WHERE rut_profesional = '$rut';";
$resultado_serv_prof = mysqli_query($conexion, $consulta_serv_prof);

$consulta_lugar_at_presencial = "SELECT nombre_comuna, nombre_provincia, nombre_region
                                 FROM lugar_atencion_presencial JOIN comuna USING (id_comuna)
                                      JOIN provincia USING (id_provincia) JOIN region USING (id_region)
                                 WHERE rut_profesional = '$rut';";
$resultado_lugar_at_presencial = mysqli_query($conexion, $consulta_lugar_at_presencial);

$consulta_lugar_at_virtual = "SELECT * 
                              FROM lugar_atencion_virtual
                              WHERE rut_profesional = '$rut';";
$resultado_lugar_at_virtual = mysqli_query($conexion, $consulta_lugar_at_virtual);

// Consulta para obtener el promedio de estrellas
$consulta_promedio_estrellas = "SELECT AVG(rating_star) as promedio_estrellas FROM clasificacion WHERE rut_profesional = '$rut'";
$resultado_promedio_estrellas = mysqli_query($conexion, $consulta_promedio_estrellas);
$fila_promedio_estrellas = mysqli_fetch_assoc($resultado_promedio_estrellas);
$promedio_estrellas = $fila_promedio_estrellas['promedio_estrellas'];

// Consulta para obtener los comentarios de los clientes
$consulta_comentarios = "SELECT comentario FROM clasificacion WHERE rut_profesional = '$rut'";
$resultado_comentarios = mysqli_query($conexion, $consulta_comentarios);

// Verificar si el profesional ya está marcado como favorito
$consulta_favorito = "SELECT * FROM favoritos WHERE rut_profesional = '$rut' AND rut_usuario = '$rut_cliente'";
$resultado_favorito = mysqli_query($conexion, $consulta_favorito);
$es_favorito = mysqli_num_rows($resultado_favorito) > 0;

// Preparar datos para el gráfico
$servicios = [];
$precios = [];
$promedios_precios = [];
while($fila_serv_prof = mysqli_fetch_assoc($resultado_serv_prof)){
    $servicios[] = $fila_serv_prof['nombre_servicio'];
    $precios[] = $fila_serv_prof['precio_serv_prof'];

    // Consulta para obtener el promedio de los precios de este servicio específico de todos los profesionales
    $id_servicio = $fila_serv_prof['id_servicio'];
    $consulta_promedio_precio_servicio = "SELECT AVG(precio_serv_prof) as promedio_precio_servicio FROM servicio_profesional WHERE id_servicio = '$id_servicio'";
    $resultado_promedio_precio_servicio = mysqli_query($conexion, $consulta_promedio_precio_servicio);
    $fila_promedio_precio_servicio = mysqli_fetch_assoc($resultado_promedio_precio_servicio);
    $promedios_precios[] = $fila_promedio_precio_servicio['promedio_precio_servicio'];
}
?>

<link rel="stylesheet" href="public/css/perfil_cita.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<div class="container my-5">
    <title>Reservar cita profesional con
        <?php echo $fila_profesional['nombres']; ?> - KindomJob's
    </title>

    <div class="profile-header">
        <div style="position: relative;">
            <img src="<?php echo $fila_profesional['foto_perfil'] ?>" alt="Foto de perfil" class="rounded-circle mb-3">
            <i id="favorite-icon" class="bi <?php echo $es_favorito ? 'bi-heart-fill' : 'bi-heart'; ?>" style="position: absolute; top: 10px; left: 10px; font-size: 2rem; cursor: pointer; color: <?php echo $es_favorito ? 'purple' : 'black'; ?>;"></i>
        </div>
        <h2>
            <?php echo $fila_profesional['nombres']?>
            <?php echo $fila_profesional['apellido_p']?>
            <?php echo $fila_profesional['apellido_m']?>
        </h2>
        <p>
            <?php echo $fila_profesional['nombre_profesion']?>
        </p>
        <?php if ($promedio_estrellas): ?>
            <p>
                <strong>Promedio de Estrellas:</strong> <?php echo number_format($promedio_estrellas, 1); ?> &#9733;
            </p>
        <?php endif; ?>
    </div>
    <div class="row mt-4">
        <!-- Sección de información y servicios -->
        <div class="col-md-8">
            <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="services-tab" data-bs-toggle="tab" data-bs-target="#services"
                        type="button">Servicios y precios</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience"
                        type="button">Experiencia</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="opinions-tab" data-bs-toggle="tab" data-bs-target="#opinions"
                        type="button">Opiniones</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#direcciones"
                        type="button">Direcciones</button>
                </li>
            </ul>
            <div class="tab-content" id="profileTabContent">
                <div class="tab-pane fade show active" id="services" role="tabpanel">
                    <h5>Servicios y Precios</h5>
                    <?php
                        mysqli_data_seek($resultado_serv_prof, 0); // Reset the result pointer to the beginning
                        while($fila_serv_prof = mysqli_fetch_assoc($resultado_serv_prof)){
                    ?>
                    <div class="service-item"><span>
                            <?php echo $fila_serv_prof['nombre_servicio'] ?>
                        </span><span>$
                            <?php echo $fila_serv_prof['precio_serv_prof'] ?>
                        </span></div>
                    <?php
                        }
                    ?>
                    <canvas id="serviciosChart"></canvas>
                    <script>
                        var ctx = document.getElementById('serviciosChart').getContext('2d');
                        var serviciosChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode($servicios); ?>,
                                datasets: [{
                                    label: 'Precio del Servicio',
                                    data: <?php echo json_encode($precios); ?>,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }, {
                                    label: 'Promedio del Precio del Servicio',
                                    data: <?php echo json_encode($promedios_precios); ?>,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
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
                    </script>
                </div>
                <div class="tab-pane fade" id="direcciones" role="tabpanel">
                    <h5>Direcciones</h5>
                    <?php
                        while($fila_lugar_at_presencial = mysqli_fetch_assoc($resultado_lugar_at_presencial)){
                    ?>
                    <div class="service-item"><span><b>Direccion: </b>
                            <?php echo $fila_lugar_at_presencial['nombre_comuna'] ?>,
                            <?php echo $fila_lugar_at_presencial['nombre_provincia'] ?>,
                            <?php echo $fila_lugar_at_presencial['nombre_region'] ?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="tab-pane fade" id="experience" role="tabpanel">
                    <h5>Experiencia</h5>
                    <p>
                        <?php echo $fila_profesional['experiencia'] ?>
                    </p>
                </div>
                <div class="tab-pane fade" id="opinions" role="tabpanel">
                    <h5>Opiniones</h5>
                    <?php
                        $comentario_num = 1;
                        while($fila_comentario = mysqli_fetch_assoc($resultado_comentarios)){
                            echo "<p><strong>Comentario $comentario_num:</strong> " . htmlspecialchars($fila_comentario['comentario']) . "</p>";
                            $comentario_num++;
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- Sección de reserva de citas -->
        <div class="col-md-4">
            <a href="index.php?p=mensaje&rut=<?php echo $rut; ?>" class="btn btn-primary mb-3">Chatear con profesional</a>
            <!-- A pagar -->
            <form id="form-reserva" action="index.php?p=profesional/webpay" method="POST">
                <div class="calendar">
                    <h5 class="mb-3">Reservar Cita</h5>
                    <input type="hidden" id="rut_prof" name="rut_prof" value="<?php echo $rut?>">
                    <input type="hidden" id="nombre_profesional" name="nombre_profesional" value="<?php echo $fila_profesional['nombres'] . ' ' . $fila_profesional['apellido_p'] . ' ' . $fila_profesional['apellido_m']; ?>">
                    <input type="hidden" id="nombre_servicio" name="nombre_servicio">
                    <input type="hidden" id="fecha_cita" name="fecha_cita">
                    <input type="hidden" id="hora_cita" name="hora_cita">
                    <input type="hidden" id="lugar_atencion" name="lugar_atencion">
                    <input type="hidden" id="monto_total" name="monto_total" value="0">
                    <select class="form-select mb-3" id="servicio" name="servicio">
                        <option value="" selected>Seleccione un servicio</option>
                        <?php
                            $consulta_select_sp = $consulta_serv_prof;
                            $resultado_select_sp = mysqli_query($conexion, $consulta_select_sp);

                            while($fila_select_sp = mysqli_fetch_assoc($resultado_select_sp)){
                                $nombre = $fila_select_sp['nombre_servicio'];
                                $id = $fila_select_sp['id_servicio'];
                                $precio = $fila_select_sp['precio_serv_prof'];
                                echo "<option value='$id' data-precio='$precio'>$nombre</option>";
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
    $(document).ready(function() {
        $('#favorite-icon').on('click', function() {
            var isFavorite = $(this).hasClass('bi-heart-fill');
            var url = isFavorite ? 'utils/eliminar_favorito.php' : 'utils/guardar_favorito.php';
            var newClass = isFavorite ? 'bi-heart' : 'bi-heart-fill';
            var newColor = isFavorite ? 'black' : 'purple';

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    rut_profesional: '<?php echo $rut; ?>',
                    rut_cliente: '<?php echo $rut_cliente; ?>'
                },
                success: function(response) {
                    $('#favorite-icon').removeClass('bi-heart bi-heart-fill').addClass(newClass).css('color', newColor);
                    alert(isFavorite ? 'Profesional eliminado de favoritos' : 'Profesional agregado a favoritos');
                },
                error: function() {
                    alert('Error al actualizar favoritos');
                }
            });
        });
    });
</script>
<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmar Servicio</h5>
            </div>
            <div class="modal-body">
                <div class="voucher">
                    <div class="voucher-header">Detalles del servicio</div>
                    <div class="voucher-section">
                        <strong>Servicio:</strong> <span id="nombre-servicio-modal">Nombre del Servicio</span>
                    </div>
                    <div class="voucher-section">
                        <strong>Profesional:</strong> <span id="rut-profesional"><?php echo $rut; ?></span>, <span id="nombre-profesional-modal"><?php echo $fila_profesional['nombres'] . ' ' . $fila_profesional['apellido_p'] . ' ' . $fila_profesional['apellido_m']; ?></span>
                    </div>
                    <div class="voucher-section">
                        <strong>Fecha:</strong> <span id="fecha-cita-modal"></span>
                    </div>
                    <div class="voucher-section">
                        <strong>Hora:</strong> <span id="hora-cita-modal"></span>
                    </div>
                    <div class="voucher-section">
                        <strong>Lugar de Atención:</strong>
                        <select class="form-control" id="lugar-atencion-modal">
                            <option value="">Seleccione el lugar de atencion virt o presencial</option>
                            <optgroup label="Virtual"></optgroup>
                            <?php
                                while($fila_lugar_at_virtual = mysqli_fetch_assoc($resultado_lugar_at_virtual)){
                                    echo "<option value='$fila_lugar_at_virtual[link_sala_virtual]'>$fila_lugar_at_virtual[nombre_atv]</option>";
                                }
                            ?>
                            <optgroup label="Presencial"></optgroup>
                            <?php
                                while($fila_lugar_at_presencial = mysqli_fetch_assoc($resultado_lugar_at_presencial)){
                                    $direccion = $fila_lugar_at_presencial['nombre_comuna'] . ', ' . $fila_lugar_at_presencial['nombre_provincia'] . ', ' . $fila_lugar_at_presencial['nombre_region'];
                                    echo "<option value='$direccion'>$direccion</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="voucher-section">
                        <input type="checkbox" id="cita-adicional" name="cita-adicional">
                        <label for="cita-adicional">Desea ingresar cita adicional (+$1000)</label>
                    </div>
                    <div class="voucher-section">
                        <strong>Monto:</strong> $<span id="monto-servicio">0</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelar-cita" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmar-cita">Confirmar</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        // Detecta cuando cambia la fecha y hace una solicitud AJAX
        $('#fecha').on('change', function () {
            const fechaSeleccionada = $(this).val();
            const rut = document.querySelector("#rut_prof").value;
            if (fechaSeleccionada) {
                $.ajax({
                    url: 'pages/profesional/consultar_disponibilidad.php',
                    data: { rut: rut, fecha: fechaSeleccionada },
                    success: function (data) {
                        // Se actualiza la lista de horas disponibles
                        $('#horas-disponibles').html(data);
                    },
                    error: function () {
                        $('#horas-disponibles').html('<li>Error al obtener disponibilidad</li>');
                    }
                });
            }
        });

        // Maneja la selección de una hora disponible
        $(document).on('click', '.btn-time', function (e) {
            e.preventDefault();
            const servicioSeleccionado = $('#servicio').val();
            if (!servicioSeleccionado) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Tiene que seleccionar un servicio para poder elegir una hora",
                    });
                return;
            }

            const horaSeleccionada = $(this).val();
            const fechaSeleccionada = $('#fecha').val();
            const nombreServicio = $('#servicio option:selected').text();
            const precioServicio = $('#servicio option:selected').data('precio');

            $('#nombre-servicio-modal').text(nombreServicio);
            $('#fecha-cita-modal').text(fechaSeleccionada);
            $('#hora-cita-modal').text(horaSeleccionada);
            $('#monto-servicio').text(precioServicio);

            $('#nombre_servicio').val(nombreServicio);
            $('#fecha_cita').val(fechaSeleccionada);
            $('#hora_cita').val(horaSeleccionada);
            $('#monto_total').val(precioServicio);

            $('#confirmModal').modal('show');
        });

        // Actualiza el monto cuando se selecciona/deselecciona el checkbox
        $('#cita-adicional').change(function () {
            const precioServicio = parseFloat($('#servicio option:selected').data('precio'));
            let montoTotal = precioServicio;
            if ($(this).is(':checked')) {
                montoTotal += 1000;
            }
            $('#monto-servicio').text(montoTotal);
            $('#monto_total').val(montoTotal);
        });

        // Confirmar la cita
        $('#confirmar-cita').click(function () {
            const lugarAtencion = $('#lugar-atencion-modal').val();
            $('#lugar_atencion').val(lugarAtencion);
            $('#form-reserva').submit();
        });
        $('#cancelar-cita').click(function () {
            $('#confirmModal').modal('hide');
        });
    });
</script>