<?php
    require('..\conexion.php');
    $id_r = $_GET["id_e"];
    $consulta = "DELETE FROM redes_sociales WHERE id_rs = $id_r";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_rs.php') ;
?>