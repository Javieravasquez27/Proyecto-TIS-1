<?php
    require('database\connection.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roles - KindomJob's</title>
    <link rel="stylesheet" href="../estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <div class="container-fluid py-2 contenedorcompleto">
        <nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" data-bs-theme="dark" style="background-color: rgb(113, 59, 228);">
            <div class="container-fluid mt-2 mb-2">
            <a class="navbar-brand <?php echo (strpos($pagina, 'admin/mantenedores/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/index"><b>Mantenedores</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/ciudad/index_ciudad') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/ciudad/index_ciudad">Ciudades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/comuna/index_comuna') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/comuna/index_comuna">Comunas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/institucion/index_institucion') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/institucion/index_institucion">Instituciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/permiso/index_permiso') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/permiso/index_permiso">Permisos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/profesion/index_profesion') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/profesion/index_profesion">Profesiones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/red_social/index_rs') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/red_social/index_rs">Redes Sociales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/rol/index_rol') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/rol/index_rol">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/rol_permiso/index_rol_permiso') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/rol_permiso/index_rol_permiso">Roles y Permisos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/region/index_region') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/region/index_region">Regiones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/servicio/index_servicio') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/servicio/index_servicio">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/tiempo_horario/index_th') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/tiempo_horario/index_th">Tipos de Horario</a>
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
                                Ingresar Nuevo Rol
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
                <th>Rol</th>
                <th>Opciones</th>
            </tr>
            <?php
            $consulta = "SELECT * FROM rol";
            $resultado = mysqli_query($connection,$consulta);
            while($row=mysqli_fetch_assoc($resultado)){
                $nombre_consultado = $row["nombre_rol"];
                $id = $row["id_rol"];
                echo "<tr>";
                    echo "<td>".$nombre_consultado."</td>";
                    echo"<td><a href='borrar_rol.php?id_e=$id' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a> <a href='form_edicion_rol.php?id_e=$id' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a></td>";
                echo"</tr>";
            }
        ?>
        </table>
    </div>
    </div>
        <form action="ingresar_rol.php" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar Nuevo Rol</h1>
                </div>
                <div class="modal-body">
                        <h6>Nombre Del Nuevo Rol:</h6>
                        <div class="input-group mb-3">
                            <input type="text" name="nombre_rol" class="form-control" placeholder="Ingrese el nombre del nuevo rol" aria-label="Recipient's username" aria-describedby="button-addon2" required>
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