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
?>

<link rel="stylesheet" href="public/css/perfil_cita.css">

<div class="container my-5">
    <title>Reservar cita profesional con
        <?php echo $fila_profesional['nombres']; ?> - KindomJob's
    </title>

    <div class="profile-header">
        <img src="<?php echo $fila_profesional['foto_perfil'] ?>" alt="Foto de perfil" class="rounded-circle mb-3">
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
            <!-- A pagar -->
            <form action="" method="POST"></form>
            <div class="calendar">
                <h5 class="mb-3">Reservar Cita</h5>
                <input type="hidden" id="rut_prof" value="<?php echo $rut?>">
                <select class="form-select mb-3">
                    <option value="" selected>Seleccione un servicio</option>
                    <?php
                        $consulta_select_sp = $consulta_serv_prof;
                        $resultado_select_sp = mysqli_query($conexion, $consulta_select_sp);

                        while($fila_select_sp = mysqli_fetch_assoc($resultado_select_sp)){
                            $nombre = $fila_select_sp['nombre_servicio'];
                            $id = $fila_select_sp['id_servicio'];
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
</script>