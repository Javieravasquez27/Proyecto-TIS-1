<?php
    require('conexion.php');
    $id_r = $_GET["id_e"];
    $consulta = "DELETE FROM servicio WHERE id_servicio = $id_r";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_servicio.php') ;
?>