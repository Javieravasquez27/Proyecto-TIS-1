<?php 
    define('PERMISO_REQUERIDO', 'Gestionar los mantenedores de la plataforma');
    include("middleware/auth.php");
    require('database\conexion.php');
?>

<title>Gestión de ciudades - KindomJob's</title>

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
                    <button type="button" class="btn  btn-info rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Ingresar nueva ciudad
                    </button>
                </div>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
    <br>

    <table class="table table-striped table-bordered ">
        <tr>
            <th>Región</th>
            <th>Ciudad</th>
            <th>Opciones</th>
        </tr>

        <?php
            $consulta = "SELECT id_ciudad, nombre_region, nombre_ciudad FROM ciudad JOIN region USING (id_region)";
            $resultado = mysqli_query($conexion, $consulta);

            while($row = mysqli_fetch_assoc($resultado))
            {
                $id=$row["id_ciudad"];
                $nombre_region = $row["nombre_region"];
                $ciudad = $row["nombre_ciudad"];
            
                echo "<tr>";
                    echo "<td>".$nombre_region."</td>";
                    echo "<td>".$ciudad."</td>";
                    echo "<td>";
                        echo "<a href='index.php?p=admin/mantenedores/ciudad/borrar_ciudad&id_e=".$id."' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a>";
                        echo " ";
                        echo "<a href='index.php?p=admin/mantenedores/ciudad/form_edicion_ciudad&id_e=".$id."' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>";
                    echo "</td>";

                echo "</tr>";
            }
    
        ?>
    </table>
</div>
<div>
    <form action="index.php?p=admin/mantenedores/ciudad/ingresar_ciudad" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar nueva ciudad</h1>
                    </div>
                    <div class="modal-body">
                        <h6>Región</h6>
                        <select class="form-select" aria-label="Default select example" name="id_e" required>
                            <option value="">Seleccione una región</option>
                            <?php
                                $nombre_region="SELECT * FROM region";
                                $resultado_region=mysqli_query($conexion, $nombre_region);
                                while($row_rol= mysqli_fetch_assoc($resultado_region))
                                {
                                    $nombre = $row_rol["nombre_region"];
                                    $id = $row_rol["id_region"];
                                    echo "<option value=".$id.">".$nombre."</option>";
                                }
                            ?>
                        </select>
                        <br>
                        <h6>Ciudad</h6>
                        <div class="input-group mb-3">
                            <input type="text" name="ciudad_e" class="form-control"
                                placeholder="Ingrese el nombre de la nueva ciudad" aria-label="Recipient's username"
                                aria-describedby="button-addon2" required>
                            <button class="btn btn-outline-success" type="sumbit"
                                id="button-addon2">Guardar</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    </div>
                </div>
            </div>
    </form>
</div>