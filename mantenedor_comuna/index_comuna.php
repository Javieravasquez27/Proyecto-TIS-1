<?php
    require('..\conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Comunas - KindomJob's</title>
    <link rel="stylesheet" href="../estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid contenedorcompleto py-4">
        <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-pill">
            <div class="container-fluid mt-2 mb-2">
                <a class="navbar-brand" href="..\index.php"><b>Mantenedores KindomJob's</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_redes_sociales/index_rs.php">Redes Sociales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_tiempohorario/index_th.php">Tipo Horario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Comuna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_institucion/index_institucion.php">Institución</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_ciudad/index_ciudad.php">Ciudad</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_region/index_region.php">Región</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_profesion/index_profesion.php">Profesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_servicio/index_servicio.php">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_permiso/index_permiso.php">Permisos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_roles/index_rol.php">Roles</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
            <div class="container-fluid">
                <form action="ingresa_comuna.php" method="POST">
                    <label for="">ID de Ciudad:</label>
                    <input type="number" name="id_ciudad_e">

                    <label for="">Nombre de Comuna:</label>
                    <input type="text" name="nombre_comuna_e">

                    <button type="sumbit" class="btn btn-outline-success">Guardar</button>
                </form>
            </div>
        </nav>
        <br>

        <table class="table table-dark table-bordered ">
            <tr>

                <th>Nombre Comuna</th>
                <th>ID Ciudad</th>
                <th>Opciones</th>
            </tr>

            <?php
        $consulta ="SELECT *FROM comuna";
        $resultado = mysqli_query($conexion, $consulta);

        while($row = mysqli_fetch_assoc($resultado)){
            
            $nombre_comuna_consultado = $row["nombre_comuna"];
            $id_ciudad_consultado = $row["id_ciudad"];
            echo "<tr>";
                
                echo "<td>".$nombre_comuna_consultado."</td>";
                echo "<td>".$id_ciudad_consultado."</td>";
                echo "<td>";
                    echo "<a href='borrar_comuna.php?id_e=".$id_ciudad_consultado."' class='btn btn-danger' style='color: white; text-decoration: none;'>Borrar</a>";
                    echo " ";
                    echo "<a href='form_edicion_comuna.php?id_e=".$id_ciudad_consultado."' class='btn btn-primary' style='color: white; text-decoration: none;'> Editar</a>";
                echo "</td>";
                
            echo "</tr>";
        }

        ?>
        </table>
    </div>
</body>

</html>