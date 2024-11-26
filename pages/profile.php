<?php
    define('PERMISO_REQUERIDO', 'client_pages_access');
    include("middleware/auth.php");
    include("database/conexion.php");
    $consulta = "SELECT * FROM usuario
                 WHERE rut = '$_SESSION[rut]'";
    $resultado = mysqli_query($conexion, $consulta);
    $usuario = mysqli_fetch_assoc($resultado);
?>

<link rel="stylesheet" href="public/css/profile_profesional.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                <?php echo $usuario['correo']; ?>
            </p>
            <button class="btn btn-custom">Editar Perfil</button>
        </div>
    </div>

    <!-- Sección de Direcciones -->
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
        <?php endif; ?>
    </div>

    <!-- Sección de Métodos de Pago -->
</div>