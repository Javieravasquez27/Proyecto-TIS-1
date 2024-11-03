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
        exit();
    } else {
        $rut = $_SESSION["rut"];
        $nombre_usuario = $_SESSION["nombre_usuario"];
        $user = get_user_by_rut($rut);

        if (!$user) {
            session_destroy();
            header("Location: index.php?p=auth/login");
            exit();
        }
/*
        // Definir las páginas permitidas por rol
        $rolePermissions = [
            1 => ['admin/dashboard.php', 'admin/users.php'], // Superadmin
            2 => ['admin/dashboard.php'],                    // Administrador
            3 => ['profesional/profile.php', 'profesional/appointments.php'], // Profesional
            4 => ['client/dashboard.php', 'client/appointments.php']          // Cliente
        ];

        // Página solicitada (extraer de la URL)
        $requestedPage = basename($_SERVER['PHP_SELF']);

        // Verificar si el usuario tiene permiso para acceder a la página
        $userRoleId = $user['id_rol'];
        if (!in_array($requestedPage, $rolePermissions[$userRoleId])) {
            // Redirigir al usuario a una página de error o a su página de inicio
            header("Location: index.php");
            exit();
        }
            */
    }
    
?>
