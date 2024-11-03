<title>Registrarse - KindomJob's</title>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar comunas usando AJAX
        function cargarComunas() {
            fetch("utils/get_comuna.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("comuna");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione una comuna";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las comunas recibidas
                    data.forEach(comuna => {
                        const option = document.createElement("option");
                        option.value = comuna.id_comuna;
                        option.textContent = comuna.nombre_comuna;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar comunas:", error));
        }

        // Llamar a la función para cargar comunas al cargar la página
        cargarComunas();
    });
</script>
<script> 
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar roles usando AJAX
        function cargarRoles() {
            fetch("utils/get_rol_register.php")
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById("rol-container");

                    // Vaciar el contenedor por si tiene opciones previas
                    container.innerHTML = '';

                    // Rellenar el contenedor con los botones de opción
                    data.forEach(rol => {
                        const radioWrapper = document.createElement("div");
                        radioWrapper.classList.add("form-check");

                        const radioInput = document.createElement("input");
                        radioInput.type = "radio";
                        radioInput.id = `rol_${rol.id_rol}`;
                        radioInput.name = "rol";
                        radioInput.value = rol.id_rol;
                        radioInput.classList.add("form-check-input");

                        const radioLabel = document.createElement("label");
                        radioLabel.htmlFor = `rol_${rol.id_rol}`;
                        radioLabel.textContent = rol.nombre_rol;
                        radioLabel.classList.add("form-check-label");

                        radioWrapper.appendChild(radioInput);
                        radioWrapper.appendChild(radioLabel);
                        container.appendChild(radioWrapper);
                    });
                })
                .catch(error => console.error("Error al cargar roles:", error));
        }

        // Llamar a la función para cargar roles al cargar la página
        cargarRoles();
    });
</script>

<div class="container mt-5">
    <div class="row justify-content-sm-center mt-5">
        <div class="col-lg-8 col-sm-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center"><img src="public/images/logo.png" alt="Logo"><br>Registrate Aquí</h1>
                </div>
                <div class="card-body">
                    <form name="registration" id="registration-form" action="" method="post">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rol" class="form-label">Usted se está registrando como...</label>
                                <div id="rol-container" class="form-check" required>
                                    <!-- Los botones radio se llenarán aquí con AJAX -->
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rut" class="form-label">RUT</label>
                                <input type="text" class="form-control" id="rut" name="rut" required>
                            </div>
                            <div class="col">
                                <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>
                            <div class="col">
                                <label for="apellido_p" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellido_p" name="apellido_p" required>
                            </div>
                            <div class="col">
                                <label for="apellido_m" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellido_m" name="apellido_m" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="col">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="col">
                                <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>
                            <div class="col">
                                <label for="comuna" class="form-label">Comuna</label>
                                <select id="comuna" name="comuna" class="form-select" required>
                                    <!-- Las opciones se llenarán aquí con AJAX -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col">
                                <label for="confirmar_password" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
