<?php
    require('..\conexion.php');

    $id_comuna_r=$_POST["id_e"];
    $nombre_comuna_r=$_POST["nombre_comuna_e"];
    $id_ciudad_r=$_POST["id_ciudad_e"];

    $consulta = "UPDATE comuna 
    SET nombre_comuna = '$nombre_comuna_r'
    WHERE id_comuna = '$id_comuna_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_comuna.php');

?>