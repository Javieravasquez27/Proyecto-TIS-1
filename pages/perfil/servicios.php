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

<title>Gestionar Servicios - KindomJob's</title>

<!-- Sección de Disponibilidad (Profesionales) -->
<?php if (($_SESSION['rut'] == $fila_usuario['rut']) && ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 3)): ?>
    <div class="card mb-4">
        <form id="form-disponibilidad">
            <div class="card-header header-bg text-center" style=" background-color: RGB(204, 204, 255);">
                <h3 style="margin-top: 2px; margin-bottom: -5px;">Establecer Horarios de Disponibilidad</h3>
            </div>
            <div class="card-body section-bg" style="margin-top: -30px;">
                <div class="tab-content mt-3">
                    <div class="availability">
                        <div class="row">
                            <div class="col-2 day-column">
                                <strong>lunes</strong>
                                <input type="hidden" name="dia[]" value='lunes'>
                                <label for=""><b>Hora Inicio</b></label>
                                <input type="time" name="hora_inicio[]" required>
                                <label for=""><b>Hora Fin</b></label>
                                <input type="time" name="hora_fin[]" required>
                            </div>
                            <div class="col-2 day-column">
                                <strong>martes</strong>
                                <input type="hidden" name="dia[]" value='martes'>
                                <label for=""><b>Hora Inicio</b></label>
                                <input type="time" name="hora_inicio[]" required>
                                <label for=""><b>Hora Fin</b></label>
                                <input type="time" name="hora_fin[]" required>
                            </div>
                            <div class="col-2 day-column">
                                <strong>miércoles</strong>
                                <input type="hidden" name="dia[]" value='miércoles'>
                                <label for=""><b>Hora Inicio</b></label>
                                <input type="time" name="hora_inicio[]" required>
                                <label for=""><b>Hora Fin</b></label>
                                <input type="time" name="hora_fin[]" required>
                            </div>
                            <div class="col-2 day-column">
                                <strong>jueves</strong>
                                <input type="hidden" name="dia[]" value='jueves'>
                                <label for=""><b>Hora Inicio</b></label>
                                <input type="time" name="hora_inicio[]" required>
                                <label for=""><b>Hora Fin</b></label>
                                <input type="time" name="hora_fin[]" required>
                            </div>
                            <div class="col-2 day-column">
                                <strong>viernes</strong>
                                <input type="hidden" name="dia[]" value='viernes'>
                                <label for=""><b>Hora Inicio</b></label>
                                <input type="time" name="hora_inicio[]" required>
                                <label for=""><b>Hora Fin</b></label>
                                <input type="time" name="hora_fin[]" required>
                            </div>
                            <div class="col-2 day-column">
                                <strong>sábado</strong>
                                <input type="hidden" name="dia[]" value='sábado'>
                                <label for=""><b>Hora Inicio</b></label>
                                <input type="time" name="hora_inicio[]" required>
                                <label for=""><b>Hora Fin</b></label>
                                <input type="time" name="hora_fin[]" required>
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
    </div>
<?php endif; ?>