<?php
    require('conexion.php');
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Admin</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script>
      function toggleProfessionalFields() {
          var professionalSelected = document.querySelector('input[name="rol"]:checked').value === '11';
          var professionalFields = document.getElementById('professionalFields');
          professionalFields.style.display = professionalSelected ? 'block' : 'none';

          if (!professionalSelected) {
              professionalFields.querySelectorAll('input').forEach(input => input.value = '');
          }
      }
    </script>
    <style>
        .direccion-container {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 15px;
        }
        .direccion-label, .fecha-label {
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require('conexion.php');
        $nombres = mysqli_real_escape_string($conexion, stripslashes($_POST['nombres']));
        $apellido_p = mysqli_real_escape_string($conexion, stripslashes($_POST['apellido_p']));
        $apellido_m = mysqli_real_escape_string($conexion, stripslashes($_POST['apellido_m']));
        $nombre_usuario = mysqli_real_escape_string($conexion, stripslashes($_POST['nombre_usuario']));
        $rut = mysqli_real_escape_string($conexion, stripslashes($_POST['rut']));
        $correo = mysqli_real_escape_string($conexion, stripslashes($_POST['correo']));
        $telefono = mysqli_real_escape_string($conexion, stripslashes($_POST['telefono']));
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
        $contraseña_hash = md5($contraseña);

        $sql = "INSERT INTO usuario (nombres, apellido_p, apellido_m, nombre_usuario, rut, correo, telefono, fecha_nac, id_comuna, calle, contraseña, id_rol)
                VALUES ('$nombres', '$apellido_p', '$apellido_m', '$nombre_usuario', '$rut', '$correo', '$telefono', '$fecha_nacimiento',  '$comuna', '$calle', '$contraseña_hash', '$rol')";
        if($id_rol == 11){
          $sql = "INSERT INTO profesional (nombre_usuario,id_institucion,id_profesion,experiencia,titulo_prof)
                  VALUES ('$nombre_usuario','$institucion','$profesion','$experiencia','$titulo_profesional')";
        }
        if (mysqli_query($conexion, $sql)) {
            echo "<div class='alert alert-success'>Registro exitoso. ¡Bienvenido!</div>";
            header ('Location: login.php ');
        } else {
            echo "<div class='alert alert-danger mt-3'>Error al registrar: " . mysqli_error($conexion) . "</div>";
        }
    }
?>
<form action="" method="POST">    
    <div class="container-fluid border contenedorcompleto" style="background-color: rgb(234, 228, 246);">
      <div class="container text-center mt-5">
        <img src="Logo_KindomJobs.png" alt="" width="15%">
        <h1 class="mt-5">Crear cuenta</h1>

        <div class="row justify-content-sm-center mt-5">
          <div class="col-lg-8 col-sm-10">
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
                            <?php
                                $nombre_region="SELECT * FROM region";
                                $resultado_region=mysqli_query($conexion,$nombre_region);
                                while($row_rol= mysqli_fetch_assoc($resultado_region)){
                                    $nombre = $row_rol["nombre_region"];
                                    $id = $row_rol["id_region"];
                                    echo "<option value=".$id.">".$nombre."</option>";
                                }
                            ?>
                          </select>
                        </div>
                        <div class="col">
                          <select name="ciudad" class="form-select" required>
                            <option value="">Ciudad</option>
                            <?php
                                    $nombre_ciudad="SELECT * FROM ciudad";
                                    $resultado_ciudad=mysqli_query($conexion,$nombre_ciudad);
                                    while($row_ciudad= mysqli_fetch_assoc($resultado_ciudad)){
                                        $nombre = $row_ciudad["nombre_ciudad"];
                                        $id = $row_ciudad["id_ciudad"];
                                        echo "<option value=".$id.">".$nombre."</option>";
                                    }
                                ?>
                          </select>
                        </div>
                        <div class="col">
                          <select name="comuna" class="form-select" required>
                            <option value="">Comuna</option>
                            <?php
                                    $nombre_comuna="SELECT * FROM comuna";
                                    $resultado_comuna=mysqli_query($conexion,$nombre_comuna);
                                    while($row_comuna= mysqli_fetch_assoc($resultado_comuna)){
                                        $nombre = $row_comuna["nombre_comuna"];
                                        $id = $row_comuna["id_comuna"];
                                        echo "<option  value=".$id.">".$nombre."</option>";
                                    }
                                ?>
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
                    <?php
                       $query="SELECT * FROM rol";
                       $resultado=mysqli_query($conexion,$query);
                       while($row= mysqli_fetch_assoc($resultado)){
                        $nombre = $row["nombre_rol"];
                        $id = $row["id_rol"];
                        if($nombre != 'Admin'){
                    ?>
                        <input type="radio" id="rol_cliente_<?php echo $id; ?>" name="rol" value="<?php echo $id; ?>" required onchange="toggleProfessionalFields()">
                        <label for="rol_cliente_<?php echo $id; ?>"><?php echo $nombre; ?></label>
                    <?php
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>

              <div id="professionalFields" style="display: none;">
                <div class="mb-3">
                  <input type="text" name="profesion" class="form-control" placeholder="Tipo de Profesión">
                </div>
                <div class="mb-3">
                  <input type="text" name="institucion" class="form-control" placeholder="Institución">
                </div>
                <div class="mb-3">
                  <input type="file" name="foto_perfil" class="form-control">
                </div>
                <div class="mb-3">
                  <input type="text" name="experiencia" class="form-control" placeholder="Experiencia">
                </div>
                <div class="mb-3">
                  <input type="text" name="titulo_profesional" class="form-control" placeholder="Título Profesional">
                </div>
              </div>

              <div class="row mb-3">
              <div class="col text-center">
                <input type="submit" class="btn btn-primary mx-auto d-block" style="width: 200px;" value="Registrarse"/>
              </div>
          </div>
<div class="text-center mt-4">
    <hr>
    <p class="d-inline mt-3">¿Ya tienes una cuenta?</p>
    <a href="login.php" class="btn btn-primary d-inline ms-2">Iniciar sesión</a>
</div>
<div class="mt-4"></div>
          </div>
        </div>
      </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</form>
</body>
</html>
