<?php
    require('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Verificaciones - KindomJob's</title>
    <link rel="stylesheet" href="../estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="../funciones.js"></script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <div class="container-fluid contenedorcompleto py-4">
        <br>

        <table class="table table-striped table-bordered text-center">
            <tr>
                <th>Profesionales por verificar:</th>
                <th>Opciones:</th>
            </tr>

            <?php
                $consulta = "SELECT * FROM usuario";
                $resultado = mysqli_query($conexion, $consulta);

                while($row = mysqli_fetch_assoc($resultado)){
                    $nombre_usuario_consultado = $row["nombre_usuario"];
                    $id_rol = $row["id_rol"];
                    
                    echo "<tr>";
                        echo "<td>".$nombre_usuario_consultado."</td>";
                        echo "<td class='d-flex justify-content-center'>";
                            echo "<a href='no_autorizar_institucion.php?id_e=".$id_rol."' class='btn btn-danger d-flex align-items-center mx-1'>";
                            echo "<span class='material-icons me-1'>block</span>No aprobado";
                            echo "</a>";
                            echo "<a href='autorizar_institucion.php?id_e=".$id_rol."' class='btn btn-primary d-flex align-items-center mx-1'>";
                            echo "<span class='material-icons me-1'>check</span>Aprobado";
                            echo "</a>";
                        echo "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>

</html>