<?php
    require('..\conexion.php');

    $nombre_comuna_r=$_POST["nombre_e"];
    $id_ciudad_r=$_POST["id_e"];
    

    $consulta = "INSERT INTO comuna (nombre_comuna,id_ciudad) VALUES('$nombre_comuna_r','$id_ciudad_r')";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_comuna.php');

?>