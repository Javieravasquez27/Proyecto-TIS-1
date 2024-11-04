<?php
    require('database\conexion.php');
    $id_recibido = $_GET["id_e"];
        $consulta = "SELECT * FROM permiso WHERE id_permiso=$id_recibido";
        $resultado = mysqli_query($conexion,$consulta);
        while($row=mysqli_fetch_assoc($resultado)){
            $nombre_consultado = $row["nombre_permiso"];
            $id = $row["id_permiso"];
        }
?>

<title>Editar permiso - KindomJob's</title>

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
                        Ingresar nuevo permiso
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
            <th>Permiso</th>
            <th>Opciones</th>
        </tr>
        <?php
            $consulta = "SELECT * FROM permiso";
            $resultado = mysqli_query($conexion,$consulta);
            while($row=mysqli_fetch_assoc($resultado)){
                $nombre_consultado = $row["nombre_permiso"];
                $id_p = $row["id_permiso"];
                if ($id == $id_p) {
                    ?>
        <tr>
            <td>
                <form action='index.php?p=admin/mantenedores/permiso/editar_permiso' method='POST'>
                    <div class="input-group mb-3">
                        <input type="hidden" name="id_e" value="<?php echo $id_p ?>">
                        <input type="text" name="nombre_e" class="form-control" aria-describedby="button-addon2"
                            value="<?php echo $nombre_consultado ?>" style="width:50%" required>
                        <button class="btn btn-outline-success" type="sumbit" id="button-addon">Guardar</button>
                    </div>
                </form>
            </td>
            <td>
                <a href="index.php?p=admin/mantenedores/permiso/borrar_permiso&id_e=<?php echo $id_p ?>"
                    class="btn btn-danger" style="color: white; text-decoration: none;"><span
                        class="material-icons">delete</span></a>
                <a href="index.php?p=admin/mantenedores/permiso/form_edicion_permiso&id_e=<?php echo $id_p ?>"
                    class='btn btn-primary' style='color: white; text-decoration: none;'><span
                        class='material-icons'>edit</span></a>
            </td>
        </tr>
        <?php
                }else{
                    echo "<tr>";
                        echo "<td>".$nombre_consultado."</td>";
                        echo"<td><a href='index.php?p=admin/mantenedores/permiso/borrar_permiso&id_e=$id_p' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a> <a href='index.php?p=admin/mantenedores/permiso/form_edicion_permiso&id_e=$id' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a></td>";
                    echo"</tr>";
                }
            }
        ?>
    </table>
</div>
</div>
<form action="index.php?p=admin/mantenedores/permiso/ingresar_permiso" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar nuevo permiso</h1>
                </div>
                <div class="modal-body">
                    <h6>Permiso</h6>
                    <div class="input-group mb-3">
                        <input type="text" name="nombre_permiso" class="form-control"
                            placeholder="Ingrese el nombre del nuevo permiso" aria-label="Recipient's username"
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