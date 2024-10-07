<?php
    require('conexion.php');
    $id_r = $_GET["id_e"];
    $consulta = "DELETE FROM permiso WHERE id_permiso = $id_r";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_permiso.php');
?>