<?php 
    include_once __DIR__ . '/../config/config.php';

    $conexion = mysqli_connect($host, $db_user, $db_pass, $db);

    if (mysqli_connect_error())
    {
        die("Conexión fallida con la base de datos: " . mysqli_connect_error());
    }
?>