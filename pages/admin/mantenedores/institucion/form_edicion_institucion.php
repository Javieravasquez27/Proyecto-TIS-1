<?php
    require('database\conexion.php');
    $id_recibido=$_GET["id_e"];

    $consulta ="SELECT *FROM institucion WHERE id_institucion='$id_recibido'";
    $resultado = mysqli_query($conexion, $consulta);

    while($row = mysqli_fetch_assoc($resultado)){
        
        $nombre_institucion_consultado = $row["nombre_institucion"];
        
        $id=$row["id_institucion"];
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
                                Agregar Nueva Institucion
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
                <th>Nombre de Institución:</th>
                <th>Opciones:</th>
            </tr>

            <?php
        $consulta ="SELECT * FROM institucion";
        $resultado = mysqli_query($conexion, $consulta);

        while($row = mysqli_fetch_assoc($resultado)){
            
            $nombre_institucion = $row["nombre_institucion"];
            $id_nombre_institucion = $row["id_institucion"];
            if ($id == $id_nombre_institucion) {
                ?>
                <tr>
                <td><form action='editar_institucion.php' method='POST'>
                    <div class="input-group mb-3">
                    <input type="hidden" name="id_e" value="<?php echo $id_nombre_institucion ?>"> 
                    <input type="text" name="nombre_e" class="form-control" aria-describedby="button-addon2" value="<?php echo $nombre_institucion ?>" style="width:50%" required>
                    <button class="btn btn-outline-success" type="sumbit" id="button-addon">Guardar</button>
                    </div>
                </form></td>
                 <td>
                    <a href= "borrar_institucion.php?id_e=<?php echo $id_nombre_institucion ?>" class="btn btn-danger" style="color: white; text-decoration: none;"><span class="material-icons">delete</span></a>
                    <a href="form_edicion_institucion.php?id_e=<?php echo $id_nombre_institucion ?>" class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>
                 </td>
                 </tr>
                <?php
            }
            else{
                echo "<tr>";
                
                echo "<td>".$nombre_institucion."</td>";
                echo "<td>";
                    echo "<a href='borrar_institucion.php?id_e=".$id_nombre_institucion."' class='btn btn-danger' style='color: white; text-decoration: none;'><span class='material-icons'>delete</span></a>";
                    echo " ";
                    echo "<a href='form_edicion_institucion.php?id_e=".$id_nombre_institucion."' class='btn btn-primary' style='color: white; text-decoration: none;'><span class='material-icons'>edit</span></a>";
                echo "</td>";
                
                echo "</tr>";
            }
        }

        ?>
        </table>
    </div>
    </div>
        <form action="ingresa_institucion.php" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header " style="background-color: rgb(234, 228, 246)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingresar Nueva Institucion</h1>
                </div>
                <div class="modal-body">
                    <h6>Nombre De la Nueva Institucion:</h6>
                        <div class="input-group mb-3">
                            <input type="text" name="nombre_e" class="form-control" placeholder="Ingrese el nombre De la Nueva Institucion" aria-label="Recipient's username" aria-describedby="button-addon2" required>
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