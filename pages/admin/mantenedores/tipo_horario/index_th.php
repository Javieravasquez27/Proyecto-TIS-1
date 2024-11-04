<?php 
    define('PERMISO_REQUERIDO', 'Gestionar los mantenedores de la plataforma');
    include("middleware/auth.php");
    require('database\conexion.php');
?>

<title>Gestión de tipos de horario - KindomJob's</title>

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
                        Ingresar nuevo tipo de horario
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
            <th>Tipo de Horario</th>
            <th>Opciones</th>
        </tr>

        <?php
            $consulta ="SELECT * FROM tipo_horario";
            $resultado = mysqli_query($conexion, $consulta);

            while($row = mysqli_fetch_assoc($resultado))
            {

                $nombre_th_consultado = $row["horario"];
                $id_nombre_th = $row["id_th"];

                echo "<tr>";

                    echo "<td>".$nombre_th_consultado."</td>";
                    echo "<td>";
                        echo "<a href='index.php?p=admin/mantenedores/tipo_horario/borrar_th&id_e=".$id_nombre_th."' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a>";
                        echo " ";
                        echo "<a href='index.php?p=admin/mantenedores/tipo_horario/form_edicion_th&id_e=".$id_nombre_th."' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>";
                    echo "</td>";

                echo "</tr>";
            }
        ?>
    </table>
</div>
</div>
<form action="index.php?p=admin/mantenedores/tipo_horario/ingresa_th" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar nuevo tipo de horario</h1>
                </div>
                <div class="modal-body">
                    <h6>Tipo de horario</h6>
                    <div class="input-group mb-3">
                        <input type="time" name="nombre_e" class="form-control"
                            placeholder="Ingrese el nuevo tipo de horario" aria-label="Recipient's username"
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