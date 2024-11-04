<?php
    require('database\conexion.php');
    $id_recibido = $_GET["id_e"];

    $consulta = "SELECT * FROM ciudad WHERE id_ciudad='$id_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while($row = mysqli_fetch_assoc($resultado)){
        $ciudad_registro = $row["nombre_ciudad"];
        $id=$row["id_ciudad"];
        $id_region=$row["id_region"];
    }

?>

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
                                Ingresar Nueva Ciudad
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
                <th>Nombre Region</th>
                <th>Ciudad</th>
                <th>Opciones</th>
            </tr>


            <?php
            $consulta ="SELECT nombre_region,nombre_ciudad, id_ciudad FROM ciudad join region using (id_region)";
            $resultado = mysqli_query($conexion, $consulta);
    
            while($row = mysqli_fetch_assoc($resultado)){
                $ciudad = $row["nombre_ciudad"];
                $id_c=$row["id_ciudad"];
                $nombre_region = $row["nombre_region"];
                if ($id_recibido == $id) {
                    ?>
                    <form action='editar_ciudad.php' method='POST'>
                    <tr>
                        <td>
                            <select class="form-select"  aria-label="Default select example" name="id_region_e" required>
                                <option value="<?php echo $id_region ?>"><?php echo $nombre_region ?></option>
                                <?php
                                    $nombre_region="SELECT * FROM region";
                                    $resultado_region=mysqli_query($conexion,$nombre_region);
                                    while($row_rol= mysqli_fetch_assoc($resultado_region)){
                                        $nombre = $row_rol["nombre_region"];
                                        $id = $row_rol["id_region"];
                                        if($id != $id_region){
                                            echo "<option value=".$id.">".$nombre."</option>";
                                        }
                                    }
                                ?>
                        </td>
                    <td>
                        <div class="input-group mb-3">
                        <input type="hidden" name="id_e" value="<?php echo $id_c ?>">
                        <input type="text" name="nombre_e" class="form-control" aria-describedby="button-addon2" value="<?php echo $ciudad_registro ?>" required>
                        <button class="btn btn-outline-success" type="sumbit" id="button-addon">Guardar</button>
                        </div>
                    </td>
                    </form>
                    <td>
                        <a href= "index.php?p=admin/mantenedores/ciudad/borrar_ciudad&id_e=<?php echo $id_c ?>" class="btn btn-danger" style="color: white; text-decoration: none;"><span class="material-icons">delete</span></a>
                        <a href="index.php?p=admin/mantenedores/ciudad/form_edicion_ciudad&id_e=<?php echo $id_c ?>" class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>
                    </td>
                    </tr>
                <?php
                }else{
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
            }
        
        ?>
        </table>
    </div>
    <div>
        <form action="ingresar_ciudad.php" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar Nueva Ciudad</h1>
                </div>
                <div class="modal-body">
                    <h6>Nombre De La Region:</h6>
                        <select class="form-select"  aria-label="Default select example" name="id_e" required>
                            <option value="">Nombre Regiones</option>
                            <?php
                                $nombre_region="SELECT * FROM region";
                                $resultado_region=mysqli_query($conexion,$nombre_region);
                                while($row_rol= mysqli_fetch_assoc($resultado_region)){
                                    $nombre = $row_rol["nombre_region"];
                                    $id = $row_rol["id_region"];
                                    echo "<option value=".$id.">".$nombre."</option>";
                                }
                            ?>
                        </select>
                        <br>
                    <h6>Nombre De La Nueva Ciudad:</h6>
                    <div class="input-group mb-3">
                        <input type="text" name="ciudad_e" class="form-control" placeholder="Ingrese el nombre de la nueva ciudad" aria-label="Recipient's username" aria-describedby="button-addon2" required>
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
</body>

</html>