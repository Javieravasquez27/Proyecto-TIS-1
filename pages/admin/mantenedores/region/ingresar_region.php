<?php
    require('database\conexion.php');

    $region_registro= $_POST["nombre_e"];

    $consulta = "INSERT INTO region (nombre_region) VALUES('$region_registro')";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/region/index_region');
?>