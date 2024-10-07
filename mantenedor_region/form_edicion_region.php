<?php
    require('..\conexion.php');
    $id_recibido=$_GET["id_e"];

    $consulta ="SELECT * FROM region WHERE id_region='$id_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while($row = mysqli_fetch_assoc($resultado)){
        $region_registro = $row["nombre_region"];
        $id=$row["id_region"];
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Región - KindomJob's</title>
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
                            <a class="nav-link" href="../mantenedor_comuna/index_comuna.php">Comuna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_institucion/index_institucion.php">Institución</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../mantenedor_ciudad/index_ciudad.php">Ciudad</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Región</a>
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
                <form action="editar_region.php" method="POST">
                    <label for="">Región:</label>
                    <input type="text" name="region_e" value="<?php echo $region_registro ?>">

                    <input type="hidden" name="id_e" value="<?php echo $id_recibido ?>">

                    <button type="sumbit" class="btn btn-outline-success">Guardar</button>
                </form>
            </div>
        </nav>
</body>

</html>