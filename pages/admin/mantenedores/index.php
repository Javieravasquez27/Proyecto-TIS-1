<?php 
    define('PERMISO_REQUERIDO', 'Gestionar los mantenedores de la plataforma');
    include("middleware/auth.php");
?>

<title>Mantenedores - KindomJob's</title>

<body>
    <div class="container-fluid py-2 contenedorcompleto">
        <?php
            include 'includes/admin/navbar_mantenedores.php';
        ?>
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
</body>

</html>