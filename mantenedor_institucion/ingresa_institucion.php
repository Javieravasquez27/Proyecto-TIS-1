<?php
    require('..\conexion.php');

    $nombre_institucion_r=$_POST["nombre_institucion_e"];
    

    $consulta = "INSERT INTO institucion (nombre_institucion) VALUES('$nombre_institucion_r')";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_institucion.php');

?>