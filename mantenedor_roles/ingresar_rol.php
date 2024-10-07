<?php
    require('conexion.php');
    $nombre_r = $_POST["nombre_rol"];
    $consulta = "INSERT INTO rol (nombre_rol) 
    values('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_rol.php');

?>