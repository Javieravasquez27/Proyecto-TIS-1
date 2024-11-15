<?php
    require('database\conexion.php');
    
    $nombre_estado_usuario_r=$_POST["nombre_e"];
    $id_r=$_POST["id_e"];

    $consulta = "UPDATE estado_usuario 
    SET nombre_estado_usuario = '$nombre_estado_usuario_r' 
    WHERE id_estado_usuario = '$id_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/estado_usuario/index_estado_usuario');

?>