<?php
    require('database\conexion.php');

    $nombre_e = $_POST["nombre_e"];
    $id_e = $_POST["id_e"];
    $consulta ="UPDATE servicio
                SET nombre_servicio = '$nombre_e'
                WHERE id_servicio = '$id_e'";
    $resultado = mysqli_query($conexion,$consulta);

    header('location: index.php?p=admin/mantenedores/servicio/index_servicio') ;
?>