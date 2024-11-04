<nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" data-bs-theme="dark" style="background-color: rgb(150, 120, 182);">
    <div class="container-fluid mt-2 mb-2">
    <a class="navbar-brand <?php echo (strpos($pagina, 'admin/mantenedores/index') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/index"><b>Mantenedores</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/ciudad/index_ciudad') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/ciudad/index_ciudad">Ciudades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/comuna/index_comuna') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/comuna/index_comuna">Comunas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/institucion/index_institucion') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/institucion/index_institucion">Instituciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/permiso/index_permiso') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/permiso/index_permiso">Permisos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/profesion/index_profesion') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/profesion/index_profesion">Profesiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/red_social/index_rs') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/red_social/index_rs">Redes Sociales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/rol/index_rol') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/rol/index_rol">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/rol_permiso/index_rol_permiso') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/rol_permiso/index_rol_permiso">Roles y Permisos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/region/index_region') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/region/index_region">Regiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/servicio/index_servicio') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/servicio/index_servicio">Servicios</a>
                </li>
            </ul>
        </div>
    </div>
</nav>