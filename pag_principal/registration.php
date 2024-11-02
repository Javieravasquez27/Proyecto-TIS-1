<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Admin</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>
      // Función para mostrar los campos adicionales para profesionales
      function toggleProfessionalFields() {
          var professionalSelected = document.querySelector('input[name="rol"]:checked').value === 'profesional';
          var professionalFields = document.getElementById('professionalFields');
          professionalFields.style.display = professionalSelected ? 'block' : 'none'; // Muestra u oculta los campos adicionales
          
          if (!professionalSelected) {
              // Limpia los campos si se ocultan
              professionalFields.querySelectorAll('input').forEach(input => input.value = '');
          }
      }
    </script>
    <style>
        .direccion-container {
            border: 1px solid #ccc; /* Borde del rectángulo */
            padding: 15px; /* Espacio interno */
            border-radius: 5px; /* Bordes redondeados */
            background-color: #f9f9f9; /* Color de fondo */
            margin-bottom: 15px; /* Espacio inferior */
        }
        .direccion-label {
            margin-bottom: 10px; /* Espacio entre la etiqueta y el contenedor */
            font-weight: bold; /* Resaltar la etiqueta */
        }
        .fecha-label {
            margin-bottom: 10px; /* Espacio entre la etiqueta y el contenedor */
            font-weight: bold; /* Resaltar la etiqueta */
        }
    </style>
</head>
<body>
    <div class="container-fluid border contenedorcompleto" style="background-color: rgb(234, 228, 246);">
      <div class="container text-center mt-5">
        <img src="Logo_KindomJobs.png" alt="" width="15%">
        <h1 class="mt-5">Crear cuenta</h1>

        <!-- Formulario de Registro -->
        <div class="row justify-content-sm-center mt-5">
          <div class="col-lg-8 col-sm-10">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="row mb-3">
                <div class="col">
                  <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
                </div>
                <div class="col">
                  <input type="text" name="apellido_p" class="form-control" placeholder="Apellido Paterno" required>
                </div>
                <div class="col">
                  <input type="text" name="apellido_m" class="form-control" placeholder="Apellido Materno" required>
                </div>
                <div class="col">
                  <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre de Usuario" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <input type="text" name="rut" class="form-control" placeholder="RUT" required>
                </div>
                <div class="col">
                  <input type="email" name="correo" class="form-control" placeholder="Correo Electrónico" required>
                </div>
                <div class="col">
                  <input type="tel" name="telefono" class="form-control" placeholder="Teléfono" required>
                </div>
                <div class="col">
                  <input type="password" name="contraseña" class="form-control" placeholder="Contraseña" required>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label class="direccion-label">Dirección</label>
                    <div class="direccion-container">
                      <div class="row">
                        <div class="col">
                          <select name="region" class="form-select" required>
                            <option value="">Región</option>
                            <option value="Region1">Región 1</option>
                            <option value="Region2">Región 2</option>
                          </select>
                        </div>
                        <div class="col">
                          <select name="ciudad" class="form-select" required>
                            <option value="">Ciudad</option>
                            <option value="Ciudad1">Ciudad 1</option>
                            <option value="Ciudad2">Ciudad 2</option>
                          </select>
                        </div>
                        <div class="col">
                          <select name="comuna" class="form-select" required>
                            <option value="">Comuna</option>
                            <option value="Comuna1">Comuna 1</option>
                            <option value="Comuna2">Comuna 2</option>
                          </select>
                        </div>
                        <div class="col">
                          <input type="text" name="calle" class="form-control" placeholder="Calle" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3">
                    <label class="fecha-label">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" required>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label class="direccion-label">Tipo de cuenta</label>
                  <div>
                    <input type="radio" id="rol_cliente" name="rol" value="cliente" required onchange="toggleProfessionalFields()">
                    <label for="rol_cliente">Cliente</label>
                    <input type="radio" id="rol_profesional" name="rol" value="profesional" required onchange="toggleProfessionalFields()">
                    <label for="rol_profesional">Profesional</label>
                  </div>
                </div>
              </div>

              <!-- Campos adicionales para profesionales -->
              <div id="professionalFields" style="display: none;">
                <div class="mb-3">
                  <input type="text" name="profesion" class="form-control" placeholder="Tipo de Profesión" required>
                </div>
                <div class="mb-3">
                  <input type="text" name="institucion" class="form-control" placeholder="Institución" required>
                </div>
                <div class="mb-3">
                  <input type="file" name="foto_perfil" class="form-control" required>
                </div>
                <div class="mb-3">
                  <input type="text" name="experiencia" class="form-control" placeholder="Experiencia" required>
                </div>
                <div class="mb-3">
                  <input type="text" name="titulo_profesional" class="form-control" placeholder="Título Profesional" required>
                </div>
              </div>
              <!-- Fin Campos adicionales -->

              <div class="row mb-3">
    <div class="col text-center">
        <button type="submit" class="btn btn-primary mx-auto d-block" style="width: 200px;">Registrarse</button>
    </div>
</div>
<div class="text-center mt-4">
    <hr>
    <p class="d-inline mt-3">¿Ya tienes una cuenta?</p>
    <a href="login.php" class="btn btn-primary d-inline ms-2">Iniciar sesión</a>
</div>
<div class="mt-4"></div> <!-- Espacio adicional -->

              

            </form>
          </div>
        </div>
        <!-- Fin Formulario de Registro -->

        <?php
          // Código PHP para procesar el registro
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              require('conexion.php'); // Incluye el archivo de conexión
              $nombres = mysqli_real_escape_string($conexion, stripslashes($_POST['nombres']));
              $apellido_p = mysqli_real_escape_string($conexion, stripslashes($_POST['apellido_p']));
              $apellido_m = mysqli_real_escape_string($conexion, stripslashes($_POST['apellido_m']));
              $nombre_usuario = mysqli_real_escape_string($conexion, stripslashes($_POST['nombre_usuario']));
              $rut = mysqli_real_escape_string($conexion, stripslashes($_POST['rut']));
              $correo = mysqli_real_escape_string($conexion, stripslashes($_POST['correo']));
              $telefono = mysqli_real_escape_string($conexion, stripslashes($_POST['telefono']));
              $celular = mysqli_real_escape_string($conexion, stripslashes($_POST['celular']));
              $contraseña = mysqli_real_escape_string($conexion, stripslashes($_POST['contraseña']));
              $fecha_nacimiento = mysqli_real_escape_string($conexion, stripslashes($_POST['fecha_nacimiento']));
              $region = mysqli_real_escape_string($conexion, stripslashes($_POST['region']));
              $ciudad = mysqli_real_escape_string($conexion, stripslashes($_POST['ciudad']));
              $comuna = mysqli_real_escape_string($conexion, stripslashes($_POST['comuna']));
              $calle = mysqli_real_escape_string($conexion, stripslashes($_POST['calle']));
              $rol = mysqli_real_escape_string($conexion, stripslashes($_POST['rol']));
              $profesion = isset($_POST['profesion']) ? mysqli_real_escape_string($conexion, stripslashes($_POST['profesion'])) : null;
              $institucion = mysqli_real_escape_string($conexion, stripslashes($_POST['institucion']));
              $experiencia = mysqli_real_escape_string($conexion, stripslashes($_POST['experiencia']));
              $titulo_profesional = mysqli_real_escape_string($conexion, stripslashes($_POST['titulo_profesional']));
              $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

              // Manejo de la foto de perfil
              if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
                  $foto_perfil = $_FILES['foto_perfil']['name'];
                  move_uploaded_file($_FILES['foto_perfil']['tmp_name'], "uploads/$foto_perfil"); // Asegúrate de tener el directorio 'uploads'
              } else {
                  $foto_perfil = null; // Asigna un valor por defecto si no se sube una foto
              }

              // Inserta los datos en la base de datos
              $sql = "INSERT INTO usuarios (nombres, apellido_p, apellido_m, nombre_usuario, rut, correo, telefono, celular, fecha_nacimiento, region, ciudad, comuna, calle, contraseña, rol, profesion, institucion, experiencia, titulo_profesional, foto_perfil)
                      VALUES ('$nombres', '$apellido_p', '$apellido_m', '$nombre_usuario', '$rut', '$correo', '$telefono', '$celular', '$fecha_nacimiento', '$region', '$ciudad', '$comuna', '$calle', '$contraseña_hash', '$rol', '$profesion', '$institucion', '$experiencia', '$titulo_profesional', '$foto_perfil')";

              if (mysqli_query($conexion, $sql)) {
                  echo "<div class='alert alert-success mt-3'>Registro exitoso. ¡Bienvenido!</div>";
              } else {
                  echo "<div class='alert alert-danger mt-3'>Error al registrar: " . mysqli_error($conexion) . "</div>";
              }
          }
        ?>
      </div>
    </div>
</body>
</html>