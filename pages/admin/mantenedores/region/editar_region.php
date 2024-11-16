<?php
    require('database\conexion.php');

    $region_registro= $_POST["nombre_e"];
    $id_registro=$_POST["id_e"];

    $consulta = "UPDATE region 
    SET nombre_region = '$region_registro'
    WHERE id_region = '$id_registro';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/region/index_region');
?>