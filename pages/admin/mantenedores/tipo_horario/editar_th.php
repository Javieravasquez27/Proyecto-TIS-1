<?php
    require('database\conexion.php');
    
    $nombre_tipo_horario_r=$_POST["nombre_e"];
    $id_r=$_POST["id_e"];

    $consulta = "UPDATE tipo_horario 
    SET horario = '$nombre_tipo_horario_r' 
    WHERE id_th = '$id_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/tipo_horario/index_th');

?>