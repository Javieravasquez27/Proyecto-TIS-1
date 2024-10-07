<?php
    require('conexion.php');
    $nombre_r = $_POST["nombre_e"];
    $consulta = "INSERT INTO servicio (nombre_servicio) 
    values('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_servicio.php') ;
?>