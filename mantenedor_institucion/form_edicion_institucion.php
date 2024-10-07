<?php
    require('conexion.php');
    $id_recibido=$_GET["id_e"];

    $consulta ="SELECT *FROM institucion WHERE id='$id_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while($row = mysqli_fetch_assoc($resultado)){
        
        $nombre_institucion_consultado = $row["nombre_institucion"];
        
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
            <form action="editar_institucion.php" method="POST">
                
                <label for="">nombre_institucion</label> 
                <input type="text" name="nombre_institucion_e" value="<?php echo $nombre_institucion_consultado ?>"><br>

                <input type="hidden" name="id_e" value="<?php echo $id_recibido ?>">

                <input type="submit" value="Guardar">
            </form>
        </div>
        </nav>
</body>
</html>
