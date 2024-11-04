<?php
    require('database\conexion.php');

    $nombre_r = $_POST["nombre_permiso"];
    $consulta = "INSERT INTO permiso (nombre_permiso) 
                 VALUES ('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    
    header('location: index.php?p=admin/mantenedores/permiso/index_permiso');
?>