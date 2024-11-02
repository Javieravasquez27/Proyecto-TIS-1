<?php
    require('..\conexion.php');
    $id_r = $_GET["id_e"];
    $consulta = "DELETE FROM red_social WHERE id_rs = $id_r";
    $resultado = mysqli_query($connection,$consulta);
    header('location: index_rs.php') ;
?>