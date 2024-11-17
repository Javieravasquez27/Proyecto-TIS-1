<?php
    require('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesiones - KindomJob's</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div class="container-fluid contenedorcompleto">
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
        <div class="container-fluid">
            <form action="ingresar_profesion.php" method="POST">
                <label for="">Nombre de profesión</label>
                <input type="text" name="nombre_profesion_e">

                <input type="submit" value="Guardar">
            </form>
        </div>
        </nav>
    <br>

    <table class="table table-dark table-bordered">
        <tr>
            <th>ID</th>
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

            echo "<tr>";
                echo "<td>".$id_profesion."</td>";
                echo "<td>".$nombre_profesion."</td>";
                echo "<td>";
                    echo "<a href='borrar_profesion.php?id_profesion_e=".$id_profesion."'>Borrar</a>";
                    echo " ";
                    echo "<a href='form_edicion_profesion.php?id_profesion_e=".$id_profesion."'>Editar</a>";
                echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    </div>
</body>
</html>