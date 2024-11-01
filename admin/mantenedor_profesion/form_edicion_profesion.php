<?php
    require('..\conexion.php');

    $id_profesion_recibido = $_GET["id_e"];
    $consulta = "SELECT * FROM profesion WHERE id_profesion = '$id_profesion_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while ($row = mysqli_fetch_assoc($resultado))
    {
        $id_profesion_r = $row["id_profesion"];
        $nombre_profesion_r = $row["nombre_profesion"];
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesiones - KindomJob's</title>
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
                                Agregar Nueva Profesion
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
                <th>Profesión</th>
                <th>Opciones</th>
            </tr>

            <?php
        $consulta = "SELECT * FROM profesion";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_assoc($resultado))
        {
            $id_profesion = $row["id_profesion"];
            $nombre_profesion = $row["nombre_profesion"];
            if ($id_profesion_r == $id_profesion) {
                ?>
                <tr>
                <td><form action='editar_profesion.php' method='POST'>
                    <div class="input-group mb-3">
                    <input type="hidden" name="id_e" value="<?php echo $id_profesion ?>"> 
                    <input type="text" name="nombre_e" class="form-control" aria-describedby="button-addon2" value="<?php echo $nombre_profesion ?>" style="width:50%" required>
                    <button class="btn btn-outline-success" type="sumbit" id="button-addon">Guardar</button>
                    </div>
                </form></td>
                 <td>
                    <a href= "borrar_profesion.php?id_e=<?php echo $id_profesion ?>" class="btn btn-danger" style="color: white; text-decoration: none;"><span class="material-icons">delete</span></a>
                    <a href="form_edicion_profesion.php?id_e=<?php echo $id_profesion ?>" class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>
                 </td>
                 </tr>
                <?php
            }else{
                echo "<tr>";
                echo "<td>".$nombre_profesion."</td>";
                echo "<td>";
                    echo "<a href='borrar_profesion.php?id_e=".$id_profesion."' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a>";
                    echo " ";
                    echo "<a href='form_edicion_profesion.php?id_e=".$id_profesion."' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>";
                echo "</td>";
            echo "</tr>";
            }
        }
        ?>
        </table>
    </div>
    </div>
        <form action="ingresar_profesion.php" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar Nueva Profesion</h1>
                </div>
                <div class="modal-body">
                    <h6>Nombre De la Nueva Profesion:</h6>
                        <div class="input-group mb-3">
                            <input type="text" name="nombre_e" class="form-control" placeholder="Ingrese el nombre De la Nueva Profesion" aria-label="Recipient's username" aria-describedby="button-addon2" required>
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