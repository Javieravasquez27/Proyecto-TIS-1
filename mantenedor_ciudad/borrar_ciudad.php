<?php
    require('conexion.php');

    $id_registro=$_GET["id_e"];

    $consulta = "DELETE FROM ciudad WHERE id_ciudad = '$id_registro';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_ciudad.php');
?>