<?php
    require('database\conexion.php');
    
    $nombre_r = $_POST["nombre_e"];
    $consulta = "INSERT INTO servicio (nombre_servicio) 
                 VALUES('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    
    header('location: index.php?p=admin/mantenedores/servicio/index_servicio') ;
?>