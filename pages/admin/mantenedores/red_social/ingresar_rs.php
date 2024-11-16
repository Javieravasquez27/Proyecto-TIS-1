<?php
    require('database\conexion.php');
    
    $nombre_r = $_POST["nombre_e"];
    $consulta = "INSERT INTO red_social (nombre_rs) 
    values('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);

    header('location: index.php?p=admin/mantenedores/red_social/index_rs') ;
?>