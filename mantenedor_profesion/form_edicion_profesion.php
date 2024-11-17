<?php
    require('conexion.php');

    $id_profesion_recibido = $_GET["id_profesion_e"];
    $consulta = "SELECT * FROM profesion WHERE id_profesion = '$id_profesion_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while ($row = mysqli_fetch_assoc($resultado))
    {
        $id_profesion = $row["id_profesion"];
        $nombre_profesion = $row["nombre_profesion"];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar profesión - KindomJob's</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid contenedorcompleto">
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
        <div class="container-fluid">
            <form action="editar_profesion.php" method="POST">
                <label for="">Nombre de profesión</label>
                <input type="text" name="nombre_profesion_e" value="<?php echo $nombre_profesion ?>">

                <input type="hidden" name="id_profesion_e" value="<?php echo $id_profesion_recibido ?>">
                <input type="submit" value="Guardar">
             </form>
        </div>
        </nav>
</body>
</html>
