<?php
    require('conexion.php');

    $ciudad_registro= $_POST["ciudad_e"];
    $id_registro=$_POST["id_e"];

    $consulta = "UPDATE ciudad 
    SET nombre_ciudad = '$ciudad_registro'
    WHERE id_ciudad = '$id_registro';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_ciudad.php');

?>