<?php
    require('database\conexion.php');

    $nombre_r = $_POST["nombre_rol"];
    $consulta = "INSERT INTO rol (nombre_rol) 
                 VALUES('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    
    header('location: index.php?p=admin/mantenedores/rol/index_rol');
?>