<?php
    ob_start();
    session_start();

    include 'database/conexion.php';


    $pagina = isset($_GET['p']) ? strtolower($_GET['p']) : 'home';

    $esPaginaAdmin = strpos($pagina, "admin") === 0;

    if ($esPaginaAdmin)
    {
        require_once 'includes/admin/header.php';
    }
    else
    {
        require_once 'includes/header.php';
    }

    require_once 'pages/' . $pagina . '.php';

    if ($esPaginaAdmin)
    {
        require_once 'includes/admin/footer.php';
    }
    else
    {
        require_once 'includes/footer.php';
    }

    ob_end_flush();
?>