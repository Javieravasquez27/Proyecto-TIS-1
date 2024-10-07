<?php
    require('conexion.php');
    $nombre_r = $_POST["nombre_rs_e"];
    $consulta = "INSERT INTO redes_sociales (nombre_rs) 
    values('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_rs.php') ;
?>