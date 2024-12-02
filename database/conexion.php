<?php 
    include_once __DIR__ . '/../config/config.php'; // Se carga archivo de configuración (donde se almacenan los datos desde .env)

    $conexion = mysqli_connect($host, $db_user, $db_pass, $db);

    if (mysqli_connect_error())
    {
        echo "Conexión fallida con la base de datos: " . mysqli_connect_error();
        die();
    }
?>