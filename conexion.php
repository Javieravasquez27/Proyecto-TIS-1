<?php
    $conexion = mysqli_connect('localhost', 'root', '','kindomjobs');

    if ($conexion->connect_error) 
    {
        die("Conexion fallida: ".$conexion->connect_error);
    }
?>