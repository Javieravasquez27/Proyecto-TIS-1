<?php
    require('conexion.php');
    $nombre_r = $_POST["nombre_rs_e"];
    $consulta = "INSERT INTO tipo_horario (horario) 
    values('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_th.php') ;
?>