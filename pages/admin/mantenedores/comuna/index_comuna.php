<?php 
    define('PERMISO_REQUERIDO', 'Gestionar los mantenedores de la plataforma');
    include("middleware/auth.php");
    require('database\conexion.php');
?>

<title>Gestión de comunas - KindomJob's</title>

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
                        Ingresar nueva comuna
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

            <th>Ciudad</th>
            <th>Comuna</th>
            <th>Opciones</th>
        </tr>

        <?php
            $consulta ="SELECT nombre_comuna, nombre_ciudad,id_comuna from comuna join ciudad using (id_ciudad)";
            $resultado = mysqli_query($conexion, $consulta);

            while($row = mysqli_fetch_assoc($resultado))
            {
                $nombre_comuna_consultado = $row["nombre_comuna"];
                $nombre_ciudad_consultado = $row["nombre_ciudad"];
                $id_comuna_consultado = $row["id_comuna"];
                echo "<tr>";

                    echo "<td>".$nombre_ciudad_consultado."</td>";
                    echo "<td>".$nombre_comuna_consultado."</td>";
                    echo "<td>";
                        echo "<a href='index.php?p=admin/mantenedores/comuna/borrar_comuna&id_e=$id_comuna_consultado' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a>";
                        echo " ";
                        echo "<a href='index.php?p=admin/mantenedores/comuna/form_edicion_comuna&id_e=$id_comuna_consultado' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>";
                    echo "</td>";

                echo "</tr>";
            }
        ?>
    </table>
</div>
<div>
    <form action="index.php?p=admin/mantenedores/ciudad/ingresa_comuna" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar nueva comuna</h1>
                    </div>
                    <div class="modal-body">
                        <h6>Ciudad</h6>
                        <select class="form-select" aria-label="Default select example" name="id_e" required>
                            <option value="">Seleccione una ciudad</option>
                            <?php
                                $nombre_region="SELECT * FROM ciudad";
                                $resultado_region=mysqli_query($conexion,$nombre_region);
                                while($row_rol= mysqli_fetch_assoc($resultado_region)){
                                    $nombre = $row_rol["nombre_ciudad"];
                                    $id = $row_rol["id_ciudad"];
                                    echo "<option value=".$id.">".$nombre."</option>";
                                }
                            ?>
                        </select>
                        <br>
                        <h6>Comuna</h6>
                        <div class="input-group mb-3">
                            <input type="text" name="nombre_e" class="form-control"
                                placeholder="Ingrese el nombre de la nueva comuna" aria-label="Recipient's username"
                                aria-describedby="button-addon2" required>
                            <button class="btn btn-outline-success" type="sumbit" id="button-addon2">Guardar</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                    </div>
                </div>
            </div>
    </form>
</div>