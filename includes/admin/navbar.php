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
                <span class="h3 align-bottom text-black" style="font-size: 30px;" >KindomJob's</span>
            </a>
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            if (isset($_SESSION["rut"])) {
            ?>
                <span class="h5 align-bottom text-white mt-4"><b>Administrador</b></span>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($pagina == 'admin/home') ? 'active' : null ?>" aria-current="page" href="index.php?p=admin/home">Inicio</a>
                    </li>
                    <?php if ($_SESSION['id_rol'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/index">Mantenedores</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'admin/users') !== false) ? 'active' : null ?>" href="index.php?p=admin/users/index">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'admin/profesionales') !== false) ? 'active' : null ?>" href="index.php?p=admin/profesionales/index">Profesionales</a>
                    </li>
                    <?php if ($_SESSION['id_rol'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/permiso_rol') !== false) ? 'active' : null ?>" href="index.php?p=admin/permiso_rol/index">Permisos para Roles</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['id_rol'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/servicio_profesion') !== false) ? 'active' : null ?>" href="index.php?p=admin/servicio_profesion/index">Servicios para Profesiones</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav mr-auto mb-5 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b><?php echo $_SESSION['nombre_usuario']; ?></b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item <?php echo ($pagina == 'profile') ? 'active' : null ?>" aria-current="page" href="index.php?p=profile">Perfil</a></li>
                            <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2): ?>
                                <li><a class="dropdown-item <?php echo ($pagina == 'admin/home') ? 'active' : null ?>" aria-current="page" href="index.php?p=admin/home">Panel Admin</a></li>
                            <?php endif; ?>
                            <?php 
                                $query =  "select * from mensaje where rut_envia = '$_SESSION[rut]' or rut_recive = '$_SESSION[rut]'";
                                $result = mysqli_query($conexion, $query);
                                $row = mysqli_num_rows($result);
                                if ($row > 0) {
                            ?>
                            <li><a class="dropdown-item"  href="index.php?p=mensajes">Mensajes</a></li>
                            <?php } ?>
                            <?php
                                $query = "select * from cita where rut_cliente = '$_SESSION[rut]'";
                                $result = mysqli_query($conexion, $query);
                                $row = mysqli_num_rows($result);
                                if ($row > 0) { 
                            ?>
                            <li><a class="dropdown-item"  href="index.php?p=citas">Citas Agendadas</a></li>
                            <?php } ?>
                            <?php
                                $query = "select * from favoritos where rut_usuario = '$_SESSION[rut]'";
                                $result = mysqli_query($conexion, $query);
                                $row = mysqli_num_rows($result);
                                if ($row > 0) { ?>
                            <li><a class="dropdown-item"  href="index.php?p=favoritos">Favoritos</a></li>
                            <?php } ?>
                            <li><a class="dropdown-item" id="logout" href="#">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </u1>
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
                <ul class=" navbar-nav mr-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?p=auth/login"><button type="button" class="btn btn-light">Iniciar Sesión</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?p=auth/register"><button type="button" class="btn btn-light">Registrarse</button></a>
                    </li>
                </ul>
            <?php
            }
            ?>
        </div>
    </div>
</nav>