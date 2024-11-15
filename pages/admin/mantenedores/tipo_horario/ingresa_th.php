<?php
    require('database\conexion.php');

    $nombre_th_r=$_POST["nombre_e"];

    $consulta = "INSERT INTO tipo_horario (horario) VALUES('$nombre_th_r')";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/tipo_horario/index_th');

?>