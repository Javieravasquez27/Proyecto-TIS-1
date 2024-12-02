<nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" data-bs-theme="dark" style="background-color: rgb(150, 120, 182);">
    <div class="container-fluid mt-2 mb-2">
    <a class="navbar-brand <?php echo (strpos($pagina, '#') !== false) ? 'active' : null ?>" href="#"><b>Menú Usuario</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavUsuario"
            aria-controls="navbarNavUsuario" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavUsuario">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'perfil/editar') !== false) ? 'active' : null ?>" href="index.php?p=perfil/editar&rut=<?php echo $_SESSION['rut']; ?>">Editar Perfil</a>
                </li>
                <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2|| $_SESSION['id_rol'] == 3): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($pagina, 'perfil/servicios') !== false) ? 'active' : null ?>" href="index.php?p=perfil/servicios&nombre_usuario=<?php echo $_SESSION['nombre_usuario']; ?>">Gestionar Servicios</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>