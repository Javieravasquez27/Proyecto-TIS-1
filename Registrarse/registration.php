<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Admin</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=delete" />
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.1.7/b-3.1.2/sl-2.1.0/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script>
      // Función para mostrar los campos adicionales para profesionales
      function toggleProfessionalFields() {
          var roleSelect = document.querySelector('select[name="rol"]');
          var professionalFields = document.getElementById('professionalFields');
          if (roleSelect.value === 'profesional') {
              professionalFields.style.display = 'block'; // Muestra los campos adicionales
          } else {
              professionalFields.style.display = 'none'; // Oculta los campos adicionales
              // Limpia los campos si se ocultan
              professionalFields.querySelectorAll('input').forEach(input => input.value = '');
          }
      }
    </script>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.1.7/b-3.1.2/sl-2.1.0/datatables.min.js"></script>

    <div class="container-fluid border contenedorcompleto" style="background-color: rgb(234, 228, 246);">
      <div class="container text-center mt-5">
        <img src="Logo_KindomJobs.png" alt="" width="20%">
        <h1 class="mt-5">Bienvenido ¡Regístrate!</h1>

        <!-- Formulario de Registro -->
        <div class="row justify-content-sm-center mt-5">
          <div class="col-lg-8 col-sm-10">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
              </div>
              <div class="mb-3">
                <input type="text" name="apellido_p" class="form-control" placeholder="Apellido Paterno" required>
              </div>
              <div class="mb-3">
                <input type="text" name="apellido_m" class="form-control" placeholder="Apellido Materno" required>
              </div>
              <div class="mb-3">
                <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre de Usuario" required>
              </div>
              <div class="mb-3">
                <input type="text" name="rut" class="form-control" placeholder="RUT" required>
              </div>
              <div class="mb-3">
                <input type="email" name="correo" class="form-control" placeholder="Correo Electrónico" required>
              </div>
              <div class="mb-3">
                <input type="tel" name="telefono" class="form-control" placeholder="Teléfono" required>
              </div>
              <div class="mb-3">
                <input type="password" name="contraseña" class="form-control" placeholder="Contraseña" required>
              </div>
              <div class="mb-3">
                <input type="password" name="confirmar_contraseña" class="form-control" placeholder="Reescribe tu Contraseña" required>
              </div>
              <div class="mb-3">
                <input type="date" name="fecha_nacimiento" class="form-control" required>
              </div>
              <div class="mb-3">
                <input type="text" name="direccion" class="form-control" placeholder="Dirección" required>
              </div>
              <div class="mb-3">
                <select name="rol" class="form-select" required onchange="toggleProfessionalFields()">
                  <option value="">Selecciona tu rol</option>
                  <option value="cliente">Cliente</option>
                  <option value="profesional">Profesional</option>
                </select>
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

              <button type="submit" class="btn btn-primary w-100">Registrarse</button>
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
              $contraseña = mysqli_real_escape_string($conexion, stripslashes($_POST['contraseña']));
              $confirmar_contraseña = mysqli_real_escape_string($conexion, stripslashes($_POST['confirmar_contraseña']));
              $fecha_nacimiento = mysqli_real_escape_string($conexion, stripslashes($_POST['fecha_nacimiento']));
              $direccion = mysqli_real_escape_string($conexion, stripslashes($_POST['direccion']));
              $rol = mysqli_real_escape_string($conexion, stripslashes($_POST['rol']));
              $profesion = isset($_POST['profesion']) ? mysqli_real_escape_string($conexion, stripslashes($_POST['profesion'])) : null;
              $institucion = mysqli_real_escape_string($conexion, stripslashes($_POST['institucion']));
              $experiencia = mysqli_real_escape_string($conexion, stripslashes($_POST['experiencia']));
              $titulo_profesional = mysqli_real_escape_string($conexion, stripslashes($_POST['titulo_profesional']));

              // Verifica que las contraseñas coincidan
              if ($contraseña !== $confirmar_contraseña) {
                  echo "<div class='alert alert-danger mt-3'>Las contraseñas no coinciden.</div>";
              } else {
                  $contraseña_hash = md5($contraseña); // Encriptación básica (mejor usar `password_hash` en producción)
                  
                  // Manejo de la subida de foto de perfil
                  if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
                      $foto_perfil = $_FILES['foto_perfil']['name'];
                      move_uploaded_file($_FILES['foto_perfil']['tmp_name'], "uploads/$foto_perfil"); // Asegúrate de tener el directorio 'uploads'
                  } else {
                      $foto_perfil = null; // Asigna un valor por defecto si no hay foto
                  }

                  $query = "INSERT INTO users (nombres, apellido_p, apellido_m, nombre_usuario, rut, correo, telefono, contraseña, fecha_nacimiento, direccion, rol, profesion, institucion, foto_perfil, experiencia, titulo_profesional) VALUES ('$nombres', '$apellido_p', '$apellido_m', '$nombre_usuario', '$rut', '$correo', '$telefono', '$contraseña_hash', '$fecha_nacimiento', '$direccion', '$rol', '$profesion', '$institucion', '$foto_perfil', '$experiencia', '$titulo_profesional')";
                  
                  if (mysqli_query($conexion, $query)) {
                      echo "<div class='alert alert-success mt-3'>Registro exitoso como $rol. <a href='login.php'>Iniciar sesión</a></div>";
                  } else {
                      echo "<div class='alert alert-danger mt-3'>Error en el registro: " . mysqli_error($conexion) . "</div>";
                  }
                  mysqli_close($conexion);
              }
          }
        ?>
      </div>
    </div>
  </body>
</html>