<?php
    define('PERMISO_REQUERIDO', 'client_pages_access');
    include("middleware/auth.php");
    include("database/conexion.php");
    $consulta_usuario = "SELECT u.rut, u.dv, u.nombre_usuario, u.nombres, u.apellido_p, u.apellido_m, u.correo,
                                u.telefono, u.fecha_nac, u.direccion, u.foto_perfil, c.nombre_comuna AS comuna,
                                r.nombre_rol AS rol
                         FROM usuario u LEFT JOIN comuna c ON u.id_comuna = c.id_comuna
                                        LEFT JOIN usuario ON c.id_comuna = u.id_comuna
                                        LEFT JOIN rol r ON u.id_rol = r.id_rol
                         WHERE u.rut = '$_SESSION[rut]'";
    $resultado_usuario = mysqli_query($conexion, $consulta_usuario);
    $usuario = mysqli_fetch_assoc($resultado_usuario);

    $colsulta_horarios = "SELECT horario from tipo_horario";
    $resultado_horarios = mysqli_query($conexion, $colsulta_horarios);
    if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 3):
        
    endif;
?>

<link rel="stylesheet" href="public/css/profile_profesional.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function cargarhorariolunes() {
            fetch("utils/get_horarios.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("horarioLunes");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';


                    // Rellenar el select con las servicios recibidas
                    data.forEach(horarios => {
                        const option = document.createElement("option");
                        option.value = horarios.horario;
                        option.textContent = horarios.horario;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar servicios:", error));
        }
    function cargarhorariomartes() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horariomartes");

                // Vaciar el select por si tiene opciones
                select.innerHTML = '';


                // Rellenar el select con las servicios recibidas
                data.forEach(horarios => {
                    const option = document.createElement("option");
                    option.value = horarios.horario;
                    option.textContent = horarios.horario;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error("Error al cargar servicios:", error));
    }
    function cargarhorariomiercoles() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horariomiercoles");

                // Vaciar el select por si tiene opciones
                select.innerHTML = '';


                // Rellenar el select con las servicios recibidas
                data.forEach(horarios => {
                    const option = document.createElement("option");
                    option.value = horarios.horario;
                    option.textContent = horarios.horario;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error("Error al cargar servicios:", error));
    }
    function cargarhorariojueves() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horariojueves");

                // Vaciar el select por si tiene opciones
                select.innerHTML = '';


                // Rellenar el select con las servicios recibidas
                data.forEach(horarios => {
                    const option = document.createElement("option");
                    option.value = horarios.horario;
                    option.textContent = horarios.horario;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error("Error al cargar servicios:", error));
    }
    function cargarhorarioviernes() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horarioviernes");

                // Vaciar el select por si tiene opciones
                select.innerHTML = '';


                // Rellenar el select con las servicios recibidas
                data.forEach(horarios => {
                    const option = document.createElement("option");
                    option.value = horarios.horario;
                    option.textContent = horarios.horario;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error("Error al cargar servicios:", error));
    }
    function cargarhorariosabado() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horariosabado");

                // Vaciar el select por si tiene opciones
                select.innerHTML = '';


                // Rellenar el select con las servicios recibidas
                data.forEach(horarios => {
                    const option = document.createElement("option");
                    option.value = horarios.horario;
                    option.textContent = horarios.horario;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error("Error al cargar servicios:", error));
    }

    cargarhorariolunes();
    cargarhorariomartes();
    cargarhorariomiercoles();
    cargarhorariojueves();
    cargarhorarioviernes();
    cargarhorariosabado();
</script>
<title>Perfil <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 3): ?> Profesional <?php endif; ?> de
    <?php echo $_SESSION['nombre_usuario']; ?> - KindomJob's
</title>

<div class="container mt-5">
    <!-- Sección de Perfil -->
    <div class="card mb-4">
        <div class="card-header header-bg text-center" style=" background-color: RGB(204, 204, 255);">
            <h3 style="margin-top: 2px; margin-bottom: -5px;">Perfil de Usuario</h3>
        </div>
        <div class="card-body text-center">
            <img src="<?php echo $usuario['foto_perfil']?>" class="rounded-circle mb-3" alt="Foto de Perfil" width="120"
                height="120">
            <h4 class="text-dark">
                <?php echo $usuario['nombres']; ?> <?php echo $usuario['apellido_p']; ?> <?php echo $usuario['apellido_m']; ?>
            </h4>
            <p class="text-muted">
                <i class="bi bi-geo-alt"></i> <?php echo $usuario['comuna']; ?><br>
                <i class="bi bi-envelope"></i> <?php echo $usuario['correo']; ?> - <i class="bi bi-telephone"></i> <?php echo $usuario['telefono']; ?>
            </p>
            <button class="btn btn-custom">Editar Perfil</button>
        </div>
    </div>

    <!-- Sección de Rellenar Horarios para profesionales -->
    <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 3): ?>
    <div class="card mb-4">
        <form id="form-disponibilidad">
            <div class="card-header header-bg text-center" style=" background-color: RGB(204, 204, 255);">
                <h3 style="margin-top: 2px; margin-bottom: -5px;">Establecer Horarios</h3>
            </div>
            <div class="card-body section-bg">
                <div class="tab-content mt-3">
                    <div class="availability">
                        <div class="row">
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='lunes'>
                                <label for="">
                                    Selecciona aquí el horario para el dia <b>lunes</b>
                                </label><br><br>
                                <select class="form-control" id="horarioLunes" multiple="multiple" name="horario[]" required></select>
                                <script>
                                    $('#horarioLunes').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='martes'>
                                <label for="">
                                    Selecciona aquí el horario para el dia <b>martes</b>
                                </label><br><br>
                                <select class="form-control" id="horariomartes" multiple="multiple" name="horario[]" required></select>
                                <script>
                                    $('#horariomartes').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='miercoles'>
                                <label for="">
                                    Selecciona aquí el horario para el dia <b>miercoles</b>
                                </label><br><br>
                                <select class="form-control" id="horariomiercoles" multiple="multiple" name="horario[]" required></select>
                                <script>
                                    $('#horariomiercoles').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='jueves'>
                                <label for="">
                                    Selecciona aquí el horario para el dia <b>jueves</b>
                                </label><br><br>
                                <select class="form-control" id="horariojueves" multiple="multiple" name="horario[]" required></select>
                                <script>
                                    $('#horariojueves').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='viernes'>
                                <label for="">
                                    Selecciona aquí el horario para el dia <b>viernes</b>
                                </label><br><br>
                                <select class="form-control" id="horarioviernes" multiple="multiple" name="horario[]" required></select>
                                <script>
                                    $('#horarioviernes').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='sabado'>
                                <label for="">
                                    Selecciona aquí el horario para el dia <b>sabado</b>
                                </label><br><br>
                                <select class="form-control" id="horariosabado" multiple="multiple" name="horario[]" required></select>
                                <script>
                                    $('#horariosabado').select2();
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <button class="btn btn-primary" type="button" id="guardar-disponibilidad">Guardar Disponibilidad</button>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                $('#guardar-disponibilidad').click(function () {
                    const formData = $('#form-disponibilidad').serialize();
                
                    $.ajax({
                        url: 'pages/profesional/guardar_disponibilidad.php',
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Disponibilidad guardada correctamente.',
                                timer: 1500,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error al guardar la disponibilidad: ' + error
                            });
                        }
                    });
                });
            });
        </script>
        
        <?php endif; ?>
    </div>

    <!-- Sección de Métodos de Pago -->
</div>