<?php
    require('conexion.php');

    $id_profesion_recibido = $_POST["id_profesion_e"];
    $nombre_profesion_r = $_POST["nombre_profesion_e"];
    
    $consulta = "UPDATE profesion SET nombre_profesion = '$nombre_profesion_r' WHERE id_profesion = '$id_profesion_recibido';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_profesion.php');
?>