<style>
    .modal {
        display: none;
        position: fixed; /* Centrado en la pantalla */
        left: 50%; /* Centrar horizontalmente */
        top: 10%; /* Desplaza el modal hacia abajo, evita la barra morada */
        transform: translateX(-50%); /* Solo centrar horizontalmente */
        width: 80%; /* Ajusta el ancho del modal */
        max-width: 600px; /* Limitar el ancho máximo */
        max-height: 80%; /* Limitar la altura máxima */
        background-color: #f8f9fa; /* Fondo claro */
        border: 1px solid #e0e0e0; /* Borde claro */
        border-radius: 15px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra elegante */
        padding: 20px; /* Espaciado interno */
        overflow-y: auto; /* Habilitar scroll interno si es necesario */
    }


    .modal-content {
        margin: 0;
        padding: 0;
    }

    .close {
        float: right;
        font-size: 24px;
        font-weight: bold;
        color: #888;
        cursor: pointer;
        margin-top: -10px; /* Ajuste para que se alinee mejor */
        margin-right: -10px;
    }

    .close:hover,
    .close:focus {
        color: #333;
        text-decoration: none;
    }
</style>


<?php
    define('PERMISO_REQUERIDO', 'client_pages_access');
    include("middleware/auth.php");
    include("database/conexion.php");
    $rut = $_GET['rut'];

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
?>

<link rel="stylesheet" href="public/css/perfil_cita.css">

<div class="container my-5">
    <title>Reservar cita profesional con
        <?php echo $fila_profesional['nombres']; ?> - KindomJob's
    </title>
    <div class="profile-header" style="position: relative;">
        <img src="<?php echo $fila_profesional['foto_perfil'] ?>" alt="Foto de perfil" class="rounded-circle mb-3">
        <!-- Botón de Reportar -->
        <button id="reportar-btn" class="btn btn-danger" style="position: absolute; top: 10px; right: 10px;">Reportar</button>
        <!-- Fin del Botón de Reportar -->
        <h2>
            <?php echo $fila_profesional['nombres']?>
            <?php echo $fila_profesional['apellido_p']?>
            <?php echo $fila_profesional['apellido_m']?>
        </h2>
        <p>
            <?php echo $fila_profesional['nombre_profesion']?>
        </p>
        <p>
            <i class="bi bi-geo-alt"></i> <?php echo $fila_profesional['nombre_comuna']?>
        </p>
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
                    <div class="graph-placeholder">[Gráfico]</div>
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
                    <p>Opiniones de los clientes...</p>
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

<!-- Modal de Reportar al Profesional -->
<div id="reportar-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 style="text-align: center;">Reportar al Profesional</h2>
        <form id="form-reporte" method="POST">
            <input type="hidden" name="rut_profesional" value="<?php echo $rut; ?>">
            <label for="motivo" style="font-weight: bold;">Motivo del Reporte:</label>
            <textarea name="motivo" id="motivo" rows="4" cols="50" placeholder="Describe el motivo del reporte..." required style="width: 100%; border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 15px;"></textarea><br>
            <div style="text-align: center;">
                <button type="submit" class="btn btn-danger">Enviar Reporte</button>
            </div>
        </form>
    </div>
</div>
<!-- Fin del Modal de Reportar al Profesional -->


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Detecta cuando cambia la fecha y hace una solicitud AJAX
        $('#fecha').on('change', function () {
            const fechaSeleccionada = $(this).val();
            const rut = document.querySelector("#rut_prof").value;
            if (fechaSeleccionada) {
                $.ajax({
                    url: 'pages/profesional/consultar_disponibilidad.php', // Archivo PHP que manejará la solicitud
                    type: 'POST',
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
<script>
// Manejo del modal de reporte
document.getElementById('reportar-btn').onclick = function () {
    document.getElementById('reportar-modal').style.display = "block";
};

document.querySelector('.close').onclick = function () {
    document.getElementById('reportar-modal').style.display = "none";
};

window.onclick = function (event) {
    if (event.target == document.getElementById('reportar-modal')) {
        document.getElementById('reportar-modal').style.display = "none";
    }
};
</script>
<script>
document.getElementById('form-reporte').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

    const formData = new FormData(this); // Obtener los datos del formulario

    fetch('api/reporte/reportar_usuario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Reporte enviado exitosamente.');
            document.getElementById('reportar-modal').style.display = 'none'; // Cerrar el modal
        } else {
            alert(data.error || 'Error al enviar el reporte');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al procesar la solicitud.');
    });
});
</script>
