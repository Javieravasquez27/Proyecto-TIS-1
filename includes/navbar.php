<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentPath = window.location.pathname.split("/").pop(); // Obtiene el nombre del archivo actual
        const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    
        navLinks.forEach(link => {
            if (link.getAttribute("href") === currentPath) {
                link.classList.add("active");
            }
        });
    });
</script>

<body>
    <nav class="navbar sticky-top navbar-expand-lg bg-gradient bg-opacity-50" style="background-color: rgb(150, 120, 182);">
        <div class="container-fluid ">
            <a class="navbar-brand" href="index.php?p=home">
                <img src="public/images/logo.png" alt="Logo KindomJobs" height="50" class="imagen d-inline-block">
                <span class="h3 align-middle" style="color: black;">KindomJob's</span>
            </a>
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
        
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <?php
            if (isset($_SESSION["rut"])) {
            ?>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'profesiones') ? 'active' : null ?>" aria-current="page" href="index.php?p=profesiones">Profesiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'servicios') ? 'active' : null ?>" aria-current="page" href="index.php?p=servicios">Servicios</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-auto mb-5 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b><?php echo $_SESSION['nombre_usuario']; ?></b>
                        </a>
                        <ul class="dropdown-menu" style="margin-left: -80px;">
                            <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 3): ?>
                                <li><a class="dropdown-item <?php echo ($pagina == 'profesional/profile') ? 'active' : null ?>" aria-current="page" href="index.php?p=profesional/profile">Perfil</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] == 4): ?>
                                <li><a class="dropdown-item <?php echo ($pagina == 'cliente/profile') ? 'active' : null ?>" aria-current="page" href="index.php?p=cliente/profile">Perfil</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2): ?>
                                <li><a class="dropdown-item <?php echo ($pagina == 'admin/home') ? 'active' : null ?>" aria-current="page" href="index.php?p=admin/home">Panel Admin</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" id="logout" href="#">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            <?php
            } else {
            ?>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'home') ? 'active' : null ?>" aria-current="page" href="index.php?p=home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'profesiones') ? 'active' : null ?>" aria-current="page" href="index.php?p=profesiones">Profesiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'servicios') ? 'active' : null ?>" aria-current="page" href="index.php?p=servicios">Servicios</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="index.php?p=auth/login" class="btn btn-sm btn-light me-2">Iniciar Sesión</a>
                    <a href="index.php?p=auth/register" class="btn btn-sm btn-light">Registrarse</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</nav>