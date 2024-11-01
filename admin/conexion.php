<?php
    $conexion = mysqli_connect("localhost", "root", "", "kindomjobs");

    if ($conexion->connect_error)
    {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>