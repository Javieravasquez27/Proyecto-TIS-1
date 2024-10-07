<?php
    $conexion = mysqli_connect("localhost","root","","tis1proyecto");
    if($conexion->connect_error){
        die("Conexión Fallida: ".$conn->connect_error);
    }
?>