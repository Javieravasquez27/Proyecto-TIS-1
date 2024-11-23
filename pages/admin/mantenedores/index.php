<?php 
    define('PERMISO_REQUERIDO', 'Gestionar los mantenedores de la plataforma');
    include("middleware/auth.php");
?>

<title>Mantenedores - KindomJob's</title>

<?php
    include 'includes/admin/navbar_mantenedores.php';
?>

<body>
    <div class="container-fluid py-2 contenedorcompleto">
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
                    <td>Ciudades</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Comunas</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Estados de Usuario</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Instituciones</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Permisos</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Profesiones</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Redes Sociales</td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Regiones</td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>Roles</td>
                </tr>
                <tr>
                    <th scope="row">9</th>
                    <td>Roles y Permisos</td>
                </tr>
                <tr>
                    <th scope="row">10</th>
                    <td>Servicios</td>
                </tr>
                <tr>
                    <th scope="row">11</th>
                    <td>Tipos de Horario</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>