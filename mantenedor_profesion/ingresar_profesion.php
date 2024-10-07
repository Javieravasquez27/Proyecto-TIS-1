<?php
    require('..\conexion.php');

    $nombre_profesion_r = $_POST["nombre_profesion_e"];
    
    $consulta = "INSERT INTO profesion (nombre_profesion) VALUES ('$nombre_profesion_r')";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_profesion.php');
?>