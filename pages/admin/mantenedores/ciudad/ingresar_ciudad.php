<?php
    require('database\conexion.php');

    $ciudad_registro= $_POST["ciudad_e"];
    $id_r = $_POST["id_e"];

    $consulta = "INSERT INTO ciudad (nombre_ciudad, id_region) VALUES('$ciudad_registro', '$id_r')";
    $resultado = mysqli_query($conexion, $consulta);
    
    header('Location: index.php?p=admin/mantenedores/ciudad/index_ciudad');
?>