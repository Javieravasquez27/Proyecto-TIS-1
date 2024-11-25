<title>Registrarse - KindomJob's</title>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function cargarComunas() {
            fetch("utils/get_comuna.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("comuna");
                    select.innerHTML = '';
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione una comuna";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);
                    data.forEach(comuna => {
                        const option = document.createElement("option");
                        option.value = comuna.id_comuna;
                        option.textContent = comuna.nombre_comuna;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar comunas:", error));
        }

        function cargarProfesiones() {
            fetch("utils/get_profesion.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("profesion");
                    select.innerHTML = '';
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione una profesión";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);
                    data.forEach(profesion => {
                        const option = document.createElement("option");
                        option.value = profesion.id_profesion;
                        option.textContent = profesion.nombre_profesion;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar profesiones:", error));
        }

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

        function cargarRoles() {
            fetch("utils/get_rol_register.php")
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById("rol");
                    container.innerHTML = '';
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

                        // Agregar evento para mostrar campos adicionales si es "Profesional"
                        radioInput.addEventListener("change", function() {
                            mostrarCamposProfesional(radioInput.value);
                        });
                    });
                })
                .catch(error => console.error("Error al cargar roles:", error));
        }

        function mostrarCamposProfesional(rolSeleccionado) {
            const camposProfesional = document.getElementById("campos_profesional");
            const profesion = document.getElementById("profesion");
            const institucion = document.getElementById("institucion");
            const foto_perfil = document.getElementById("foto_perfil");
            const titulo_profesional = document.getElementById("titulo_profesional");
            const experiencia = document.getElementById("experiencia");

            if (rolSeleccionado === "3") {
                camposProfesional.style.display = "block";
                profesion.setAttribute("required", "required");
                institucion.setAttribute("required", "required");
                foto_perfil.setAttribute("required", "required");
                titulo_profesional.setAttribute("required", "required");
                experiencia.setAttribute("required", "required");
            } else {
                camposProfesional.style.display = "none";
                profesion.removeAttribute("required");
                institucion.removeAttribute("required");
                foto_perfil.removeAttribute("required");
                titulo_profesional.removeAttribute("required");
                experiencia.removeAttribute("required");
            }
        }

        cargarComunas();
        cargarProfesiones();
        cargarInstituciones();
        cargarRoles();
    });
</script>

<div class="container" style="margin-top: 10px; margin-bottom: 47px;">
    <div class="row justify-content-sm-center mt-5">
        <div class="col-lg-8 col-sm-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center"><img src="public/images/logo.png" width="100" alt="Logo"><br>Registrate Aquí</h1>
                </div>
                <div class="card-body" style="margin-bottom: -15px;">
                    <form name="registration" id="registration-form" action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rol" class="form-label">Usted se está registrando como...</label>
                                <div id="rol" class="form-check" required>
                                    <!-- Los botones radio se llenarán aquí con AJAX -->
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rut" class="form-label">RUT</label>
                                <input type="text" class="form-control" id="rut" name="rut" placeholder="RUT sin guión y con digito verificador (ej: 13799304K o 13799304k)" required>
                            </div>
                            <div class="col">
                                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="nombre_usuario" placeholder="Sin espacios ni carácteres especiales (ej: JuanPerez)" name="nombre_usuario" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ejemplo: Juan Carlos" required>
                            </div>
                            <div class="col">
                                <label for="apellido_p" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellido_p" name="apellido_p" placeholder="Ejemplo: Pérez" required>
                            </div>
                            <div class="col">
                                <label for="apellido_m" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellido_m" name="apellido_m" placeholder="Ejemplo: García" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ejemplo: juan@email.com" required>
                            </div>
                            <div class="col">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ejemplo: 912345678" required>
                            </div>
                            <div class="col">
                                <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ejemplo: Avenida Las Golondrinas 2456" required>
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
                                <input type="password" class="form-control" id="password" name="password" placeholder="Debe contener al menos 8 carácteres" required>
                            </div>
                            <div class="col">
                                <label for="confirmar_password" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" placeholder="Reingrese la contraseña" required>
                            </div>
                        </div>
                        <!-- Campos adicionales para "Profesional" -->
                        <div id="campos_profesional" style="display: none;">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="profesion" class="form-label">Profesión</label>
                                    <select id="profesion" name="profesion" class="form-select">
                                        <!-- Las opciones se llenarán aquí con AJAX -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="institucion" class="form-label">Institución</label>
                                    <select id="institucion" name="institucion" class="form-select">
                                        <!-- Las opciones se llenarán aquí con AJAX -->
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                                    <input type="file" class="form-control" name="foto_perfil" id="foto_perfil">
                                </div>
                                <div class="col">
                                    <label for="titulo_profesional" class="form-label">Título Profesional</label>
                                    <input type="file" class="form-control" name="titulo_profesional" id="titulo_profesional">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="experiencia" class="form-label">Experiencia</label>
                                    <input type="text" class="form-control" id="experiencia" name="experiencia" placeholder="Breve resumen de su experiencia (ej: Soy Ingeniero Civil Informático, me dedicó al análisis de datos y...)">
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                    </form>
                    <p class="text-center mt-3">¿Ya tienes una cuenta? <a href='index.php?p=auth/login'>Inicia sesión aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        
        <script src="public/js/app.js" ></script>