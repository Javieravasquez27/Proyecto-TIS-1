<?php
    include('middleware/auth.php');
    include('database/conexion.php');
    include('includes/navbar_usuario.php');

    if (!isset($_GET['nombre_usuario'])) {
        header('Location: index.php?p=error/pagina_no_existe.php');
    }
    
    $nombre_usuario = mysqli_real_escape_string($conexion, $_GET['nombre_usuario']);
    $sql_consulta_usuario = "SELECT u.*, c.nombre_comuna AS comuna, r.nombre_rol AS rol
                             FROM usuario u
                             LEFT JOIN comuna c ON u.id_comuna = c.id_comuna
                             LEFT JOIN rol r ON u.id_rol = r.id_rol
                             WHERE u.nombre_usuario = '$nombre_usuario'";
    $resultado_consulta_usuario = mysqli_query($conexion, $sql_consulta_usuario);
    $fila_usuario = mysqli_fetch_assoc($resultado_consulta_usuario);

    if (!$fila_usuario) {
       header('Location: index.php?p=error/pagina_no_existe.php');
    }
?>

<link rel="stylesheet" href="public/css/perfil.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function cargarHorarioLunes() {
            fetch("utils/get_horarios.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("horario_lunes");

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
    function cargarHorarioMartes() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horario_martes");

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
    function cargarHorarioMiercoles() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horario_miercoles");

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
    function cargarHorarioJueves() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horario_jueves");

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
    function cargarHorarioViernes() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horario_viernes");

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
    function cargarHorarioSabado() {
        fetch("utils/get_horarios.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("horario_sabado");

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

    cargarHorarioLunes();
    cargarHorarioMartes();
    cargarHorarioMiercoles();
    cargarHorarioJueves();
    cargarHorarioViernes();
    cargarHorarioSabado();
</script>

<title>Gestionar Servicios - KindomJob's</title>

<!-- Sección de Disponibilidad -->
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
                                <label for="horario_lunes">
                                    Selecciona aquí el horario para el dia <b>lunes</b>
                                </label><br><br>
                                <select class="form-control" id="horario_lunes" multiple="multiple" name="horario_lunes[]" required></select>
                                <script>
                                    $('#horario_lunes').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='martes'>
                                <label for="horario_martes">
                                    Selecciona aquí el horario para el dia <b>martes</b>
                                </label><br><br>
                                <select class="form-control" id="horario_martes" multiple="multiple" name="horario_martes[]" required></select>
                                <script>
                                    $('#horario_martes').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='miercoles'>
                                <label for="horario_miercoles">
                                    Selecciona aquí el horario para el dia <b>miercoles</b>
                                </label><br><br>
                                <select class="form-control" id="horario_miercoles" multiple="multiple" name="horario_miercoles[]" required></select>
                                <script>
                                    $('#horario_miercoles').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='jueves'>
                                <label for="horario_jueves">
                                    Selecciona aquí el horario para el dia <b>jueves</b>
                                </label><br><br>
                                <select class="form-control" id="horario_jueves" multiple="multiple" name="horario_jueves[]" required></select>
                                <script>
                                    $('#horario_jueves').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='viernes'>
                                <label for="horario_viernes">
                                    Selecciona aquí el horario para el dia <b>viernes</b>
                                </label><br><br>
                                <select class="form-control" id="horario_viernes" multiple="multiple" name="horario_viernes[]" required></select>
                                <script>
                                    $('#horario_viernes').select2();
                                </script>
                            </div>
                            <div class="col-2 day-column">
                                <input type="hidden" name="dia[]" value='sabado'>
                                <label for="horario_sabado">
                                    Selecciona aquí el horario para el dia <b>sabado</b>
                                </label><br><br>
                                <select class="form-control" id="horario_sabado" multiple="multiple" name="horario_sabado[]" required></select>
                                <script>
                                    $('#horario_sabado').select2();
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <button class="btn btn-primary" type="submit" id="guardar-disponibilidad">Guardar Disponibilidad</button>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                $('#guardar-disponibilidad').click(function (e) {
                    e.preventDefault(); // Se previene el comportamiento predeterminado del formulario
                
                    const formData = $('#form-disponibilidad').serialize();
                
                    $.ajax({
                        url: 'pages/profesional/guardar_disponibilidad.php',
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: response.message,
                                    timer: 1500,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message
                                });
                            }
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