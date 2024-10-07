<?php
    require('conexion.php');
    $id_recibido=$_GET["id_e"];

    $consulta ="SELECT *FROM comuna WHERE id='$id_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while($row = mysqli_fetch_assoc($resultado)){
        
        $nombre_comuna_consultado = $row["nombre_comuna"];
        $id_ciudad_consultado = $row["id_ciudad"];
        $id=$row["id"];
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid contenedorcompleto">
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
        <div class="container-fluid">
            <form action="editar_comuna.php" method="POST">
        
            <label for="">nombre_comuna</label> 
            <input type="text" name="nombre_comuna_e" value="<?php echo $nombre_comuna_consultado ?>"><br>

            <label for="">id_ciudad</label> 
            <input type="int" name="id_ciudad_e" value="<?php echo $id_ciudad_consultado ?>"><br>

            <input type="hidden" name="id_e" value="<?php echo $id_recibido ?>">

            <input type="submit" value="Guardar">
            </form>
        </div>
        </nav>
</body>
</html>
