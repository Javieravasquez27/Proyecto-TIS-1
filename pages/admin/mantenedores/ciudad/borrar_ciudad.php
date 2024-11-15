<?php
    require('database\conexion.php');

    $id_registro=$_GET["id_e"];

    $consulta = "DELETE FROM ciudad WHERE id_ciudad = '$id_registro';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/ciudad/index_ciudad');
?>