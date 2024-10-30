<?php
    require('..\conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Redes Sociales - KindomJob's</title>
    <link rel="stylesheet" href="../estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <div class="container-fluid contenedorcompleto py-4">
    <nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" data-bs-theme="dark" style="background-color: rgb(113, 59, 228);">
            <div class="container-fluid mt-2 mb-2">
                <a class="navbar-brand" href="../index.php"><b>Mantenedores KindomJob's</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_ciudad/index_ciudad.php"><b>Ciudad</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_comuna/index_comuna.php"><b>Comuna</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_institucion/index_institucion.php"><b>Institución</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_permiso/index_permiso.php"><b>Permisos</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_profesion/index_profesion.php"><b>Profesión</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_redes_sociales/index_rs.php"><b>Redes Sociales</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_roles/index_rol.php"><b>Roles</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_roles_permisos/index_rol_permiso.php"><b>Roles Permisos</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_region/index_region.php"><b>Región</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_servicio/index_servicio.php"><b>Servicios</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_tiempohorario/index_th.php"><b>Tipo Horario</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                </div>
                <div class="col-6 col-xl-5 col-sm rounded-pill" style="background-color: rgba(115, 52, 216, 0.322);">
                    <div class="d-grid gap-2 py-2">
                            <button type="button" class="btn  btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Agregar Nueva Red Social
                            </button>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>
        </div>    
        <br>
        <table class="table table-striped table-bordered">
            <tr>
                <th>Red Social</th>
                <th>Opciones</th>
            </tr>
            <?php
                $consulta = "SELECT * FROM redes_sociales";
                $resultado = mysqli_query($conexion,$consulta);
                while($row=mysqli_fetch_assoc($resultado)){
                    $nombre_consultado = $row["nombre_rs"];
                    $id = $row["id_rs"];
                    echo "<tr>";
                        echo "<td>".$nombre_consultado."</td>";
                        echo"<td><a href='borrar_rs.php?id_e=$id' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a> <a href='form_edicion_rs.php?id_e=$id' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a></td>";
                    echo"</tr>";
                }
            ?>
        </table>
    </div>
    </div>
        <form action="ingresar_rs.php" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar Nueva Red Social</h1>
                </div>
                <div class="modal-body">
                    <h6>Nombre De La Nueva Red Social:</h6>
                        <div class="input-group mb-3">
                            <input type="text" name="nombre_e" class="form-control" placeholder="Ingrese el nombre de la nueva rs" aria-label="Recipient's username" aria-describedby="button-addon2" required>
                            <button class="btn btn-outline-success" type="sumbit" id="button-addon2">Guardar</button>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                </div>
                </div>
            </div>
        </form> 
    </div>
</body>

</html>