<?php 
    ob_start();
    session_start();
    
    include 'database/conexion.php';
    
    $pagina = isset($_GET['p']) ? strtolower($_GET['p']) : 'home'; // Se obtiene la página actual
    $esPaginaAdmin = strpos($pagina, "admin") === 0; // Se identifica a las páginas de admin con la forma 'index.php?p=admin/...'
    
    $sinNavbarFooter = in_array($pagina, ['auth/login', 'auth/register', 'auth/recuperar_password']); // Arreglo con las páginas sin navbar ni footer
    
    $ruta = 'pages/' . $pagina . '.php'; // Ruta de la página a cargar
    
    if (!file_exists($ruta)) {
        $ruta = 'pages/error/pagina_no_existe.php'; // Página de error si se intenta cargar una página no existente
    }
    
    // Se incluye el header correspondiente al rol
    if ($esPaginaAdmin) {
        // Se incluye header de admin
        require_once 'includes/admin/header.php';
    } else {
        // Se incluye header común
        require_once 'includes/header.php';
    }
    
    require_once $ruta; // Se incluye la página seleccionada
    
    // Se carga el footer solo si la página no está dentro del arreglo de páginas sin navbar ni footer
    if (!$sinNavbarFooter) {
        // Se incluye el footer correspondiente al rol
        if ($esPaginaAdmin) {
            // Se incluye footer de admin
            require_once 'includes/admin/footer.php';
        } else {
            // Se incluye footer común
            require_once 'includes/footer.php';
        }
    }
    
    ob_end_flush();
?>