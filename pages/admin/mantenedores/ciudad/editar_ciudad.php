<?php
    require('..\conexion.php');

    $ciudad_registro= $_POST["nombre_e"];
    $id_registro=$_POST["id_e"];
    $id_region = $_POST["id_region_e"];
    $consulta = "UPDATE ciudad 
    SET nombre_ciudad = '$ciudad_registro', id_region = '$id_region'
    WHERE id_ciudad = '$id_registro'";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_ciudad.php');

?>