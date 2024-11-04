<?php
    require('database\conexion.php');

    $nombre_institucion_r=$_POST["nombre_e"];
    

    $consulta = "INSERT INTO institucion (nombre_institucion) VALUES('$nombre_institucion_r')";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/institucion/index_institucion');

?>