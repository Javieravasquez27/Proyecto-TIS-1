<?php
    require('database\conexion.php');

    $id_r=$_GET["id_e"];

    $consulta = "DELETE FROM estado_usuario WHERE id_estado_usuario='$id_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/estado_usuario/index_estado_usuario');

?>