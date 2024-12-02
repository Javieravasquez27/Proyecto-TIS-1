<?php
    include('middleware/auth.php');
    include('includes/navbar_usuario.php');
    
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

    $sql_consulta_usuario_comuna = "SELECT u.id_comuna, c.nombre_comuna AS nombre_comuna
                                    FROM usuario u JOIN comuna c ON u.id_comuna = c.id_comuna
                                    WHERE u.rut = '$rut';";
    $resultado_consulta_usuario_comuna = mysqli_query($conexion, $sql_consulta_usuario_comuna);
    $fila_usuario_comuna = mysqli_fetch_assoc($resultado_consulta_usuario_comuna); 
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
                                <label for="rol" class="form-label">Rol <b style="color: #b30000;">(*)</b></label>
                                <select id="rol" name="rol" class="form-select" disabled>
                                    <option selected><?php echo $_SESSION['nombre_rol']; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rut" class="form-label">RUT <b style="color: #b30000;">(*)</b></label>
                                <input type="text" class="form-control" id="rut" name="rut" value="<?php echo $fila_usuario['rut']; echo $fila_usuario['dv']; ?>" maxlength="9" disabled>
                            </div>
                            <div class="col">
                                <label for="nombre_usuario" class="form-label">Nombre de Usuario <b style="color: #b30000;">(*)</b></label>
                                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Sin espacios ni carácteres especiales (ej: JuanPerez)" value="<?php echo $fila_usuario['nombre_usuario']; ?>" maxlength="20" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nombres" class="form-label">Nombres <b style="color: #b30000;">(*)</b></label>
                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ejemplo: Juan Carlos" value="<?php echo $fila_usuario['nombres']; ?>" maxlength="50" required>
                            </div>
                            <div class="col">
                                <label for="apellido_p" class="form-label">Apellido Paterno <b style="color: #b30000;">(*)</b></label>
                                <input type="text" class="form-control" id="apellido_p" name="apellido_p" placeholder="Ejemplo: Pérez" value="<?php echo $fila_usuario['apellido_p']; ?>" maxlength="50" required>
                            </div>
                            <div class="col">
                                <label for="apellido_m" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellido_m" name="apellido_m" placeholder="Ejemplo: García" value="<?php echo $fila_usuario['apellido_m']; ?>" maxlength="50">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="correo" class="form-label">Correo <b style="color: #b30000;">(*)</b></label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ejemplo: juan@email.com" value="<?php echo $fila_usuario['correo']; ?>" maxlength="50" required>
                            </div>
                            <div class="col">
                                <label for="telefono" class="form-label">Teléfono <b style="color: #b30000;">(*)</b></label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ejemplo: 912345678" value="<?php echo $fila_usuario['telefono']; ?>" maxlength="9" required>
                            </div>
                            <div class="col">
                                <label for="fecha_nac" class="form-label">Fecha de Nacimiento <b style="color: #b30000;">(*)</b></label>
                                <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" value="<?php echo $fila_usuario['fecha_nac']; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="direccion" class="form-label">Dirección <b style="color: #b30000;">(*)</b></label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ejemplo: Avenida Las Golondrinas 2456" value="<?php echo $fila_usuario['direccion']; ?>" maxlength="50" required>
                            </div>
                            <div class="col">
                                <label for="comuna" class="form-label">Comuna <b style="color: #b30000;">(*)</b></label>
                                <select id="comuna" name="comuna" class="form-select" required>
                                    <!-- Las opciones se llenarán aquí con AJAX -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="password" class="form-label">Contraseña <b style="color: #b30000;">(**)</b></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Debe contener al menos 8 carácteres" maxlength="100">
                            </div>
                            <div class="col">
                                <label for="confirmar_password" class="form-label">Confirmar Contraseña <b style="color: #b30000;">(**)</b></label>
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
                                    <label for="profesion" class="form-label">Profesión <b style="color: #b30000;">(*)</b></label>
                                    <select id="profesion" name="profesion" class="form-select" disabled>
                                        <?php if (isset($fila_profesional['nombre_profesion'])): ?>
                                            <option selected><?php echo $fila_profesional['nombre_profesion']; ?></option>
                                        <?php endif; ?>
                                        <?php if (!isset($fila_profesional['nombre_profesion'])): ?>
                                            <option selected>No definido</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="institucion" class="form-label">Institución <b style="color: #b30000;">(*)</b></label>
                                    <select id="institucion" name="institucion" class="form-select" disabled>
                                        <?php if (isset($fila_profesional['nombre_institucion'])): ?>
                                            <option selected><?php echo $fila_profesional['nombre_institucion']; ?></option>
                                        <?php endif; ?>
                                        <?php if (!isset($fila_profesional['nombre_institucion'])): ?>
                                            <option selected>No definido</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="biografia_prof" class="form-label">Biografía</label>
                                    <textarea class="form-control" id="biografia_prof" name="biografia_prof" placeholder="Escriba su biografía personal. Esto se mostrará en su perfil público" maxlength="500" required><?php echo $fila_profesional['biografia_prof']; ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="experiencia" class="form-label">Experiencia <b style="color: #b30000;">(*)</b></label>
                                    <textarea class="form-control" id="experiencia" name="experiencia" placeholder="Breve resumen de su experiencia (ej: Soy Ingeniero Civil Informático, Magíster en Ciencias de la Computación...). Esto se mostrará a los clientes al momento de reservar" maxlength="500" required><?php echo $fila_profesional['experiencia']; ?></textarea>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="d-grid gap-2">
                            <p><b style="color: #b30000;">(*)</b> Campos obligatorios.<br><b style="color: #b30000;">(**)</b> Solo llenar si se desea cambiar contraseña.</p>
                            <input type="hidden" name="latitud" id="latitud">
                            <input type="hidden" name="longitud" id="longitud">
                            <button type="button" id="save-profile" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar las comunas dinámicamente
        function cargarInstituciones() {
            fetch("utils/get_institucion.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("institucion");
                    select.innerHTML = '';
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione una institución";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);
                    data.forEach(institucion => {
                        const option = document.createElement("option");
                        option.value = institucion.id_institucion;
                        option.textContent = institucion.nombre_institucion;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar instituciones:", error));
        }
        cargarComunas();

        // Funciones de validación
        function validarTelefonoInput(telefono) {
            const regex = /^[0-9]+$/; // Solo números
            return regex.test(telefono);
        }

        function validarNombreUsuarioInput(nombreUsuario) {
            const regex = /^[a-zA-Z0-9_]+$/; // Solo letras, números y guion bajo
            return regex.test(nombreUsuario);
        }

        function validarPasswordInput(password) {
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/; // Mínimo 8 caracteres, 1 minúscula, 1 mayúscula, 1 número
            return regex.test(password);
        }

        // Función para manejar la geocodificación y envío de datos
        async function guardarPerfil() {
            const nombreUsuario = $('#nombre_usuario').val().trim();
            const telefono = $('#telefono').val().trim();
            const password = $('#password').val().trim();
            const confirmarPassword = $('#confirmar_password').val().trim();
            const direccion = $('#direccion').val().trim();
            const comuna = $('#comuna option:selected').text();

            // Validaciones
            if (!validarNombreUsuarioInput(nombreUsuario)) {
                Swal.fire({
                    title: "Error",
                    text: "El nombre de usuario solo puede contener letras, números y guion bajo (_).",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
                return;
            }

            if (!validarTelefonoInput(telefono)) {
                Swal.fire({
                    title: "Error",
                    text: "El teléfono solo puede contener números.",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
                return;
            }

            if (password && !validarPasswordInput(password)) {
                Swal.fire({
                    title: "Error",
                    text: "La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
                return;
            }

            if (password && password !== confirmarPassword) {
                Swal.fire({
                    title: "Error",
                    text: "Las contraseñas no coinciden.",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
                return;
            }

            if (!direccion || !comuna) {
                Swal.fire({
                    title: "Error",
                    text: "Debe ingresar una dirección y seleccionar una comuna",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            try {
                Swal.fire({
                    title: 'Espere un momento...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                // Geocodificación
                const query = `${direccion}, ${comuna}`;
                const geocodeResponse = await fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&format=json&limit=1`);
                const geocodeData = await geocodeResponse.json();

                if (geocodeData.length > 0) {
                    const { lat, lon } = geocodeData[0];
                    $('#latitud').val(lat);
                    $('#longitud').val(lon);
                } else {
                    Swal.close();
                    Swal.fire({
                        title: "Error",
                        text: "No se pudo geocodificar la dirección. Por favor, verifica los datos ingresados.",
                        icon: "error",
                        button: "Aceptar",
                    });
                    return;
                }
            } catch (error) {
                Swal.close();
                Swal.fire({
                    title: "Error",
                    text: "Ocurrió un error al geocodificar la dirección.",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            // Envío del formulario con AJAX
            const formData = new FormData($('#edit-profile-form')[0]);

            $.ajax({
                url: 'api/perfil/update.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Perfil actualizado',
                        text: 'Tus cambios se han guardado correctamente.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        // Se redirige al perfil del usuario actual
                        window.location.href = 'index.php?p=perfil&nombre_usuario=' + $('#nombre_usuario').val();
                    });
                },
                error: function() {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudieron guardar los cambios.'
                    });
                }
            });
        }

        // Evento de clic para guardar perfil
        $('#save-profile').click(function() {
            guardarPerfil();
        });
    });
</script>