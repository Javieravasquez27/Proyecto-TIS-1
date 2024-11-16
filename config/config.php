<?php
    // .env file path
    $envFilePath = __DIR__.'/../.env';
    // echo $envFilePath;
    // // Load env variables
    $env = parse_ini_file($envFilePath);

    // Set variables
    $host = $env['DB_HOST'];
    $db_user = $env['DB_USER'];
    $db_pass = $env['DB_PASSWORD']; 
    $db = $env['DB_NAME'];

?>
