<?php
   // define('PERMISO_REQUERIDO', 'Acceder a las páginas de profesionales');
    include("middleware/auth.php");
    include("database/conexion.php");
    $rut = $_GET['rut'];
?>
<div class="container my-5">
    <?php
    $query = "SELECT * FROM comuna, institucion, usuario join profesional using (rut) join profesion using (id_profesion)
            where profesional.id_institucion = institucion.id_institucion
            and usuario.id_comuna = comuna.id_comuna
            and profesional.rut = '$rut'";
    $resultado = mysqli_query($conexion,$query);
    $row_prof = mysqli_fetch_assoc($resultado);
    ?>
    
    <div class="profile-header">
        <img src="<?php  echo $row_prof['foto_perfil'] ?>" alt="Foto de perfil" class="rounded-circle mb-3">
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
                    $query = "SELECT nombre_servicio, precio_serv_prof from servicio_profesional join servicio using (id_servicio)
                    where rut_profesional = '$rut'";
                    $resultado_prof = mysqli_query($conexion, $query);
                    while($row_prof = mysqli_fetch_assoc($resultado_prof)){
                    ?>
                    <div class="service-item"><span><?php echo $row_prof['nombre_servicio'] ?></span><span>$<?php echo $row_prof['precio_serv_prof'] ?></span></div>
                    <?php
                    }
                    ?>
                    <div class="graph-placeholder">[Gráfico]</div>
                </div>
                <div class="tab-pane fade" id="direcciones" role="tabpanel">
                    <h5>Direcciones</h5>
                    <?php
                    $query = "SELECT nombre_comuna, nombre_provincia,nombre_region from lugar_atencion_presencial join comuna using (id_comuna) join provincia using (id_provincia) join region using (id_region)
                    where rut_profesional = '$rut'";
                    $resultado_prof = mysqli_query($conexion, $query);
                    while($row_prof = mysqli_fetch_assoc($resultado_prof)){
                    ?>
                    <div class="service-item"><span><b>Direccion: </b><?php echo $row_prof['nombre_comuna'] ?> , <?php echo $row_prof['nombre_provincia'] ?> , <?php echo $row_prof['nombre_region'] ?></div>
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
                <input type="hidden" id="rut_prof" value="<?php echo $rut?>">
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
        const rut = document.querySelector("#rut_prof").value;
        if (fechaSeleccionada) {
            $.ajax({
                url: 'pages/profesional/consultar_disponibilidad.php', // Archivo PHP que manejará la solicitud
                type: 'POST',
                data: { rut:rut,fecha: fechaSeleccionada
                },
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
