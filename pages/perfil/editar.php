<?php
    include('middleware/auth.php');
    
    if ($_SESSION['rut'] !== $_GET['rut']) {
        header("Location: index.php?p=error/acceso_denegado");
        exit();
    }

    $rut = $_SESSION['rut'];
    $sql_consulta_profesional = "SELECT DISTINCT p.rut, prof.nombre_profesion, i.nombre_institucion,
                                                 p.biografia_prof, p.experiencia, p.titulo_profesional
                                 FROM profesional p JOIN profesion prof ON p.id_profesion = prof.id_profesion
                                                    JOIN profesional ON prof.id_profesion = p.id_profesion
                                                    JOIN institucion i ON p.id_institucion = i.id_institucion
                                 WHERE p.rut = '$rut';";
    $resultado_consulta_profesional = mysqli_query($conexion, $sql_consulta_profesional);
    $fila_profesional = mysqli_fetch_assoc($resultado_consulta_profesional);
?>

<title>Editar perfil - KindomJob's</title>

<h1 class="text-center mt-5">Editar perfil</h1>

<div class="container" style="margin-bottom: 50px;">
    <div class="row justify-content-sm-center mt-5">
        <div class="col-lg-8 col-sm-10">
            <div class="card">
                <div class="card-body mb-2" style="margin-bottom: -15px;">
                    <form name="edit-profile" id="edit-profile-form" action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rol" class="form-label">Rol</label>
                                <select id="rol" name="rol" class="form-select" disabled>
                                    <option selected><?php echo $_SESSION['nombre_rol']; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rut" class="form-label">RUT</label>
                                <input type="text" class="form-control" id="rut" name="rut" value="<?php echo $fila_usuario['rut']; echo $fila_usuario['dv']; ?>" maxlength="9" disabled>
                            </div>
                            <div class="col">
                                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Sin espacios ni carácteres especiales (ej: JuanPerez)" value="<?php echo $fila_usuario['nombre_usuario']; ?>" maxlength="20" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ejemplo: Juan Carlos" value="<?php echo $fila_usuario['nombres']; ?>" maxlength="50" required>
                            </div>
                            <div class="col">
                                <label for="apellido_p" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellido_p" name="apellido_p" placeholder="Ejemplo: Pérez" value="<?php echo $fila_usuario['apellido_p']; ?>" maxlength="50" required>
                            </div>
                            <div class="col">
                                <label for="apellido_m" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellido_m" name="apellido_m" placeholder="Ejemplo: García" value="<?php echo $fila_usuario['apellido_m']; ?>" maxlength="50" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ejemplo: juan@email.com" value="<?php echo $fila_usuario['correo']; ?>" maxlength="50" required>
                            </div>
                            <div class="col">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ejemplo: 912345678" value="<?php echo $fila_usuario['telefono']; ?>" maxlength="9" required>
                            </div>
                            <div class="col">
                                <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="<?php echo $fila_usuario['fecha_nac']; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Debe contener al menos 8 carácteres" maxlength="100">
                            </div>
                            <div class="col">
                                <label for="confirmar_password" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" placeholder="Reingrese la contraseña" maxlength="100">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                                <input type="file" class="form-control" name="foto_perfil" id="foto_perfil" accept="image/*">
                            </div>
                        </div>
                        <!-- Campos adicionales para "Profesional" -->
                        <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 3): ?>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="profesion" class="form-label">Profesión</label>
                                    <select id="profesion" name="profesion" class="form-select" disabled>
                                        <option selected>Seleccione una profesión</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="institucion" class="form-label">Institución</label>
                                    <select id="institucion" name="institucion" class="form-select" disabled>
                                        <option selected>Seleccione una institución</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="experiencia" class="form-label">Experiencia</label>
                                    <textarea class="form-control" id="experiencia" name="experiencia" placeholder="Breve resumen de su experiencia (ej: Soy Ingeniero Civil Informático, Magíster en Ciencias de la Computación...)" maxlength="500"></textarea>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="d-grid gap-2">
                            <button type="button" id="save-profile" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#save-profile').click(function() {
        var formData = new FormData($('#edit-profile-form')[0]);
        $.ajax({
            url: 'api/perfil/update.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Perfil actualizado',
                    text: 'Tus cambios se han guardado correctamente.',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    // Redirige al perfil del usuario actual
                    window.location.href = 'index.php?p=perfil&nombre_usuario=' + $('#nombre_usuario').val();
                });
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudieron guardar los cambios.'
                });
            }
        });
    });
</script>