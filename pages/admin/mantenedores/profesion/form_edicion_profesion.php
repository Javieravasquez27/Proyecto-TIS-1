<?php
    require('database\conexion.php');

    $id_profesion_recibido = $_GET["id_e"];
    $consulta = "SELECT * FROM profesion WHERE id_profesion = '$id_profesion_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while ($row = mysqli_fetch_assoc($resultado))
    {
        $id_profesion_r = $row["id_profesion"];
        $nombre_profesion_r = $row["nombre_profesion"];
    }
?>

<title>Editar profesión - KindomJob's</title>

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
                        Ingresar nueva profesión
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
            <th>Profesión</th>
            <th>Opciones</th>
        </tr>

        <?php
        $consulta = "SELECT * FROM profesion";
        $resultado = mysqli_query($conexion, $consulta);

        while ($row = mysqli_fetch_assoc($resultado))
        {
            $id_profesion = $row["id_profesion"];
            $nombre_profesion = $row["nombre_profesion"];
            if ($id_profesion_r == $id_profesion) {
                ?>
        <tr>
            <td>
                <form action='index.php?p=admin/mantenedores/profesion/editar_profesion' method='POST'>
                    <div class="input-group mb-3">
                        <input type="hidden" name="id_e" value="<?php echo $id_profesion ?>">
                        <input type="text" name="nombre_e" class="form-control" aria-describedby="button-addon2"
                            value="<?php echo $nombre_profesion ?>" style="width:50%" required>
                        <button class="btn btn-outline-success" type="sumbit" id="button-addon">Guardar</button>
                    </div>
                </form>
            </td>
            <td>
                <a href="index.php?p=admin/mantenedores/profesion/borrar_profesion&id_e=<?php echo $id_profesion ?>"
                    class="btn btn-danger" style="color: white; text-decoration: none;"><span
                        class="material-icons">delete</span></a>
                <a href="index.php?p=admin/mantenedores/profesion/form_edicion_profesion&id_e=<?php echo $id_profesion ?>"
                    class='btn btn-primary' style='color: white; text-decoration: none;'><span
                        class='material-icons'>edit</span></a>
            </td>
        </tr>
        <?php
            }else{
                echo "<tr>";
                echo "<td>".$nombre_profesion."</td>";
                echo "<td>";
                    echo "<a href='index.php?p=admin/mantenedores/profesion/borrar_profesion&id_e=".$id_profesion."' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a>";
                    echo " ";
                    echo "<a href='index.php?p=admin/mantenedores/profesion/form_edicion_profesion&id_e=".$id_profesion."' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>";
                echo "</td>";
            echo "</tr>";
            }
        }
        ?>
    </table>
</div>
</div>
<form action="index.php?p=admin/mantenedores/profesion/ingresar_profesion&id_e=" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar nueva profesión</h1>
                </div>
                <div class="modal-body">
                    <h6>Profesión</h6>
                    <div class="input-group mb-3">
                        <input type="text" name="nombre_e" class="form-control"
                            placeholder="Ingrese el nombre de la nueva profesión" aria-label="Recipient's username"
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