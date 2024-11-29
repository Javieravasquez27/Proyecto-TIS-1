<?php
    $envRuta = __DIR__.'/../.env'; // Ruta de archivo .env

    $env = parse_ini_file($envRuta); // Se carga el archivo .env y se almacenan sus configuraciones en un array asociativo

    $host = $env['DB_HOST']; // Se obtiene DB_HOST
    $db_user = $env['DB_USER']; // Se obtiene DB_USER
    $db_pass = $env['DB_PASSWORD']; // Se obtiene DB_PASSWORD
    $db = $env['DB_NAME']; // Se obtiene DB_NAME
?>