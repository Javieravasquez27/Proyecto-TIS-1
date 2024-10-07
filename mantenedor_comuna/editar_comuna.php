<?php
    require('conexion.php');

    $id_comuna_r=$_POST["id_comuna_e"];
    $nombre_comuna_r=$_POST["nombre_comuna_e"];
    $id_ciudad_r=$_POST["id_ciudad_e"];
    $id_r=$_POST["id_e"];

    $consulta = "UPDATE comuna 
    SET id_comuna = '$id_comuna_r', nombre_comuna = '$nombre_comuna_r' , id_ciudad = '$id_ciudad_r'
    WHERE id = '$id_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_comuna.php');

?>