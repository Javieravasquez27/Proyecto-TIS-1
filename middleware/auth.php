<?php

require_once __DIR__ . '/../config/config.php';
include __DIR__ . '/../utils/functions.php';

// Iniciar la sesión (si no está iniciada)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Comprueba si el usuario está logueado
if (!isset($_SESSION["rut"])) {
    header("Location: index.php?p=auth/login");
} else {
    $rut = $_SESSION["rut"];
    $nombre_usuario = $_SESSION["nombre_usuario"];
    $user = get_user_by_rut($rut);

    if (!$user) {
        session_destroy();
        header("Location: index.php?p=auth/login");
    }
}
