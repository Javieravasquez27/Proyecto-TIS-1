<?php
    $conexion = mysqli_connect("localhost", "root", "", "register");

    if (mysqli_connect_error())
    {
        die("Conexion Fallida con la bd: " . mysqli_connect_error());
    }
?>