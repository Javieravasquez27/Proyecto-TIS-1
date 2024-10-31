<?php
    require('conexion.php');
    $id_recibido=$_GET["id_e"];

    $consulta ="SELECT * FROM ciudad WHERE id_ciudad='$id_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while($row = mysqli_fetch_assoc($resultado)){
        $ciudad_registro = $row["nombre_ciudad"];
        $id=$row["id_ciudad"];
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid contenedorcompleto">
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
        <div class="container-fluid">
            <form action="editar_ciudad.php" method="POST">
                <label for="">Ciudad:</label> 
                <input type="text" name="ciudad_e" value="<?php echo $ciudad_registro ?>">

                <input type="hidden" name="id_e" value="<?php echo $id_recibido ?>">

                <input type="submit" value="Guardar">
            </form>
        </div>
        </nav>
</body>
</html>