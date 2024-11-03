<title>Mantenedores - KindomJob's</title>

<body>
    <div class="container-fluid py-2 contenedorcompleto">
        <nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" data-bs-theme="dark" style="background-color: rgb(113, 59, 228);">
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
                        <li class="nav-item">
                            <a class="nav-link <?php echo (strpos($pagina, 'admin/mantenedores/tiempo_horario/index_th') !== false) ? 'active' : null ?>" href="index.php?p=admin/mantenedores/tiempo_horario/index_th">Tipos de Horario</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Mantenedor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Ciudad</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Comuna</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Institución</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Permisos</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Profesión</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Redes Sociales</td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Region</td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>Roles</td>
                </tr>
                <tr>
                    <th scope="row">9</th>
                    <td>Roles Permisos</td>
                </tr>
                <tr>
                    <th scope="row">10</th>
                    <td>Servicios</td>
                </tr>
                <tr>
                    <th scope="row">11</th>
                    <td>Tipo Horario</td>
                </tr>

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>