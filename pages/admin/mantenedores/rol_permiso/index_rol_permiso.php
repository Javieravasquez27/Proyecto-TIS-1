<?php 
    define('PERMISO_REQUERIDO', 'Gestionar los mantenedores de la plataforma');
    include("middleware/auth.php");
    require('database\conexion.php');
?>

<title>Gestión de permisos para roles - KindomJob's</title>

<body>
    <div class="container-fluid py-2 contenedorcompleto">
        <?php
            include 'includes/admin/navbar_mantenedores.php';
        ?>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                </div>
                <div class="col-6 col-xl-5 col-sm rounded-pill" style="background-color: rgba(115, 52, 216, 0.322);">
                    <div class="d-grid gap-2 py-2">
                            <button type="button" class="btn  btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Asignar Nuevo Permiso
                            </button>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>
        </div>    
        <br>
        <table class="table table-striped table-bordered">
            <tr>
                <th>Rol</th>
                <th>Permisos</th>
                <th>Opciones</th>
            </tr>
            <?php
            $consulta = "SELECT id_rol,nombre_rol,nombre_permiso FROM permiso join permiso_rol using (id_permiso) join rol using (id_rol) ORDER BY nombre_rol";
            $resultado = mysqli_query($conexion,$consulta);
            while($row=mysqli_fetch_assoc($resultado)){
                $nombre_consultado = $row["nombre_rol"];
                $nombre_permiso = $row["nombre_permiso"];
                $id = $row["id_rol"]; 
                echo "<tr>";
                    echo "<td>".$nombre_consultado."</td>";
                    echo "<td>".$nombre_permiso."</td>";
                    echo"<td><a href='borrar_rol_permiso.php?id_e=$id' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a> <a href='form_edicion_rol_permiso.php?id_e=$id' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a></td>";
                echo"</tr>";
            }
        ?>
        </table>
    </div>
        </div>
        <form action="ingresar_rol_permiso.php" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Asignar Nuevo Permiso</h1>
                </div>
                <div class="modal-body">
                    <h6>Nombre Del Rol:</h6>
                        <select class="form-select"  aria-label="Default select example" name="id_e" required>
                            <option value="">Nombre Roles</option>
                            <?php
                                $nombre_rol="SELECT * FROM rol";
                                $resultado_rol=mysqli_query($conexion,$nombre_rol);
                                while($row_rol= mysqli_fetch_assoc($resultado_rol)){
                                    $nombre = $row_rol["nombre_rol"];
                                    $id = $row_rol["id_rol"];
                                    echo "<option value=".$id.">".$nombre."</option>";
                                }
                            ?>
                        </select>
                        <br>
                        <h6>Marque Los Permisos Que Desea Admitir:</h6>
                        <div class="form-group mb-3">
                            <?php
                                $nombre_rol="SELECT * FROM permiso";
                                $resultado_rol=mysqli_query($conexion,$nombre_rol);
                                while($row_rol= mysqli_fetch_assoc($resultado_rol)){
                                    $nombre = $row_rol["nombre_permiso"];
                                    $id = $row_rol["id_permiso"];
                                    echo "<div class='form-check form-switch'><input class='form-check-input' type='checkbox' role='switch' name='permisos[]' value=".$id."><label class='form-check-label' for='flexSwitchCheckDefault'>".$nombre."</label></div>";
                                }
                            ?>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    <button class="btn btn-outline-success" type="sumbit" id="button-addon2">Guardar</button>
                </div>
                </div>
            </div>
        </form> 
    </div>
</body>
</html>