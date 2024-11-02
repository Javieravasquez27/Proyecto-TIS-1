<?php
session_start();

include 'database/connection.php';

$pagina = isset($_GET['p']) ? strtolower($_GET['p']) : 'home';

$isAdminPage = strpos($pagina, "admin") === 0;

if ($isAdminPage) {
    require_once 'includes/admin/header.php';
} else {
    require_once 'includes/header.php';
}

require_once 'pages/' . $pagina . '.php';

if ($isAdminPage) {
    require_once 'includes/admin/footer.php';
} else {
    require_once 'includes/footer.php';
}
