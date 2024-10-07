<?php
    require('conexion.php');

    $region_registro= $_POST["region_e"];

    $consulta = "INSERT INTO region (nombre_region) VALUES('$region_registro')";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_region.php');

?>