<?php
    require('database\conexion.php');

    $nombre_estado_usuario_r=$_POST["nombre_e"];

    $consulta = "INSERT INTO estado_usuario (nombre_estado_usuario) VALUES('$nombre_estado_usuario_r')";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/estado_usuario/index_estado_usuario');

?>