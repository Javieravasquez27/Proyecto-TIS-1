<?php
    require('database\conexion.php');

    $id_registro=$_GET["id_e"];

    $consulta = "DELETE FROM region WHERE id_region = '$id_registro';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/region/index_region');
?>