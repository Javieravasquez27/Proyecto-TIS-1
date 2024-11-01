<?php
    $conexion = mysqli_connect("localhost", "root", "", "kindomjobs");

    if (mysqli_connect_error())
    {
        die("Conexion Fallida con la bd: " . mysqli_connect_error());
    }
?>