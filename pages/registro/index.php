<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <!-- <link rel="stylesheet" href="../../public/css/index.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="utf-8">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            cargarComunas();
            cargarRoles();
            desplegarCamposProfesional();

            // Validación de contraseña
            document.querySelector("form").addEventListener("submit", function (event) {
                const contraseña = document.querySelector("input[name='contraseña']").value;
                const confirmarContraseña = document.querySelector("input[name='confirmar_password']").value;

                if (contraseña !== confirmarContraseña) {
                    event.preventDefault(); // Detiene el envío del formulario
                    alert("Las contraseñas no coinciden.");
                }
            });
        });

        function cargarComunas() {
            fetch("../../utils/get_comuna.php")
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

        function cargarRoles() {
            fetch("../../utils/get_rol.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("rol");
                    select.innerHTML = '';
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione un tipo de usuario";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    data.forEach(rol => {
                        const option = document.createElement("option");
                        option.value = rol.id_rol;
                        option.textContent = rol.nombre_rol;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar roles:", error));
        }

        function desplegarCamposProfesional() {
            var roleSelect = document.querySelector('select[name="rol"]');
            var camposProfesional = document.getElementById('camposProfesional');

            if (roleSelect.value === '3') {
                camposProfesional.style.display = 'block';
            } else {
                camposProfesional.style.display = 'none';
                camposProfesional.querySelectorAll('input').forEach(input => input.value = '');
            }
        }
    </script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.1.7/b-3.1.2/sl-2.1.0/datatables.min.js"></script>

    <div class="container-fluid border contenedorcompleto" style="background-color: rgb(234, 228, 246);">
        <div class="container text-center mt-5">
            <img src="../../public/images/logo.png" alt="" width="20%">
            <h1 class="mt-5">Bienvenido. ¡Regístrate!</h1>

            <!-- Campos del formulario -->
            <div class="row justify-content-sm-center mt-5">
                <div class="col-lg-8 col-sm-10">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="apellido_p" class="form-control" placeholder="Apellido Paterno"
                                required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="apellido_m" class="form-control" placeholder="Apellido Materno"
                                required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="nombre_usuario" class="form-control"
                                placeholder="Nombre de Usuario" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="rut" class="form-control" placeholder="RUT" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="correo" class="form-control" placeholder="Correo Electrónico"
                                required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="telefono" class="form-control" placeholder="Teléfono" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña"
                                required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="confirmar_password" class="form-control"
                                placeholder="Reescribe tu Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <input type="date" name="fecha_nacimiento" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="direccion" class="form-control" placeholder="Dirección" required>
                        </div>
                        <div class="mb-3">
                            <select name="comuna" id="comuna" class="form-select" required>
                                <!-- Las opciones se llenarán aquí con AJAX -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <select name="rol" id="rol" class="form-select" required
                                onchange="desplegarCamposProfesional()">
                                <!-- Las opciones se llenarán aquí con AJAX -->
                            </select>
                        </div>
                        <!-- Campos adicionales para profesional -->
                        <div id="camposProfesional" style="display: none;">
                            <div class="mb-3">
                                <input type="text" name="profesion" class="form-control" placeholder="Tipo de Profesión"
                                    required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="institucion" class="form-control" placeholder="Institución" required>
                            </div>
                            <!-- Revisar -->
                            <div class="mb-3">
                                <label for="foto_perfil">Foto de Perfil</label>
                                <input type="file" name="foto_perfil" class="form-control"
                                    placeholder="Foto de perfil" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="experiencia" class="form-control" placeholder="Experiencia" required>
                            </div>
                            <!-- Revisar -->
                            <div class="mb-3">
                                <label for="titulo_profesional">Título Profesional</label>
                                <input type="file" name="titulo_profesional" class="form-control"
                                    placeholder="Título Profesional" required>
                            </div>
                        </div>
                        <!-- Fin campos adicionales para profesional -->
                        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                    </form>
                </div>
            </div>
            <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    // Código PHP para procesar el registro
                    require('../../database/conexion.php'); // Incluye el archivo de conexión
                    $nombres = mysqli_real_escape_string($conexion, stripslashes($_POST['nombres']));
                    $apellido_p = mysqli_real_escape_string($conexion, stripslashes($_POST['apellido_p']));
                    $apellido_m = mysqli_real_escape_string($conexion, stripslashes($_POST['apellido_m']));
                    $nombre_usuario = mysqli_real_escape_string($conexion, stripslashes($_POST['nombre_usuario']));
                    $rut = mysqli_real_escape_string($conexion, stripslashes($_POST['rut']));
                    $correo = mysqli_real_escape_string($conexion, stripslashes($_POST['correo']));
                    $telefono = mysqli_real_escape_string($conexion, stripslashes($_POST['telefono']));
                    $password = mysqli_real_escape_string($conexion, stripslashes($_POST['contraseña']));
                    $confirmar_password = mysqli_real_escape_string($conexion, stripslashes($_POST['confirmar_password']));
                    $fecha_nacimiento = mysqli_real_escape_string($conexion, stripslashes($_POST['fecha_nacimiento']));
                    $direccion = mysqli_real_escape_string($conexion, stripslashes($_POST['direccion']));
                    $comuna = mysqli_real_escape_string($conexion, stripslashes($_POST['comuna']));
                    $rol = mysqli_real_escape_string($conexion, stripslashes($_POST['rol']));

                    if ($rol == 3)
                    {
                        $profesion = isset($_POST['profesion']) ? mysqli_real_escape_string($conexion, stripslashes($_POST['profesion'])) : null;
                        $institucion = mysqli_real_escape_string($conexion, stripslashes($_POST['institucion']));
                        $experiencia = mysqli_real_escape_string($conexion, stripslashes($_POST['experiencia']));
                        $titulo_profesional = mysqli_real_escape_string($conexion, stripslashes($_POST['titulo_profesional']));

                        $sql_usuario = "INSERT INTO usuario (nombres, apellido_p, apellido_m, nombre_usuario, rut, correo, telefono, contrasena, fecha_nac, direccion, id_comuna, id_rol) VALUES ('$nombres', '$apellido_p', '$apellido_m', '$nombre_usuario', '$rut', '$correo', '$telefono', '".md5("$password")."', '$fecha_nacimiento', '$direccion', '$comuna', '$rol')";
                        $sql_profesional = "INSERT INTO profesional (rut, id_profesion, id_institucion, experiencia, titulo_profesional, autorizado) VALUES ('$rut', '$profesion', '$experiencia', '$titulo_profesional', 0)";

                        if (mysqli_query($conexion, $sql_usuario) && mysqli_query($conexion, $sql_profesional))
                        {
                            echo "<div class='alert alert-success mt-3'>Registro exitoso. <a href='../login/login.php'>Iniciar sesión</a></div>";
                        }
                        else
                        {
                            echo "<div class='alert alert-danger mt-3'>Error en el registro: " . mysqli_error($conexion) . "</div>";
                        }
                    }
                    else
                    {
                        $sql_usuario = "INSERT INTO usuario (nombres, apellido_p, apellido_m, nombre_usuario, rut, correo, telefono, contrasena, fecha_nac, direccion, id_comuna, id_rol) VALUES ('$nombres', '$apellido_p', '$apellido_m', '$nombre_usuario', '$rut', '$correo', '$telefono', '".md5("$password")."', '$fecha_nacimiento', '$direccion', '$comuna', '$rol')";
                        $sql_cliente = "INSERT INTO cliente (rut) VALUES ('$rut')";

                        if (mysqli_query($conexion, $sql_usuario) && mysqli_query($conexion, $sql_cliente))
                        {
                            echo "<div class='alert alert-success mt-3'>Registro exitoso como cliente. <a href='../login/login.php'>Iniciar sesión</a></div>";
                        }
                        else
                        {
                            echo "<div class='alert alert-danger mt-3'>Error en el registro: " . mysqli_error($conexion) . "</div>";
                        }
                    }
                    
                    mysqli_close($conexion);
                }
            ?>
        </div>
    </div>
</body>

</html>