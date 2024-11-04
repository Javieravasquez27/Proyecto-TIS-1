<?php
    require('..\conexion.php');
    $nombre_r = $_POST["nombre_permiso"];
    $consulta = "INSERT INTO permiso (nombre_permiso) 
    values('$nombre_r')";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_permiso.php')  ;

?>