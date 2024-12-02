<nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" data-bs-theme="dark" style="background-color: rgb(150, 120, 182);">
    <div class="container-fluid mt-2 mb-2">
    <a class="navbar-brand <?php echo (strpos($pagina, 'admin/mantenedores/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/index"><b>Mantenedores</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavMantenedores"
            aria-controls="navbarNavMantenedores" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavMantenedores">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/comuna/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/comuna/index">Comunas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/estado_usuario/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/estado_usuario/index">Estados de Usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/institucion/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/institucion/index">Instituciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/permiso/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/permiso/index">Permisos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/profesion/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/profesion/index">Profesiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/provincia/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/provincia/index">Provincias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/red_social/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/red_social/index">Redes Sociales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/region/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/region/index">Regiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/rol/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/rol/index">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/servicio/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/servicio/index">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/tipo_horario/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/tipo_horario/index">Tipos de Horario</a>
                </li>
            </ul>
        </div>
    </div>
</nav>