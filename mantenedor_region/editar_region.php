<?php
    require('..\conexion.php');

    $region_registro= $_POST["region_e"];
    $id_registro=$_POST["id_e"];

    $consulta = "UPDATE region 
    SET nombre_region = '$region_registro'
    WHERE id_region = '$id_registro';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_region.php');

?>