<?php 
    include_once __DIR__ . '/../config/config.php';

    $connection = mysqli_connect($host, $db_user, $db_pass, $db);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        // exit();
        die();
    }
?>