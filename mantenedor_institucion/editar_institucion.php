<?php
    require('conexion.php');

    
    $nombre_institucion_r=$_POST["nombre_institucion_e"];
    $id_r=$_POST["id_e"];

    $consulta = "UPDATE institucion 
    SET id_institucion = '$id_institucion_r', nombre_institucion = '$nombre_institucion_r' 
    WHERE id = '$id_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_institucion.php');

?>