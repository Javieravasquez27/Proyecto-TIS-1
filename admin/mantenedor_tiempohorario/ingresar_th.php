<?php
    require('..\conexion.php');
    $nombre_r = $_POST["horario"];
    $consulta = "INSERT INTO tipo_horario (horario) 
    values('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_th.php') ;
?>