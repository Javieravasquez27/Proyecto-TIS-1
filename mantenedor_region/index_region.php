<?php
    require('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div class="container-fluid contenedorcompleto">
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
        <div class="container-fluid">
            <form action="ingresar_region.php" method="POST">
                <label for="">Región:</label>
                <input type="text" name="region_e">

                <input type="submit" value="Guardar">
            </form>
        </div>
        </nav>
        <br>
    <table class="table table-dark table-bordered ">
        <tr>
            <th>Región</th>
            <th>Opciones</th>
        </tr>
    

        <?php
            $consulta ="SELECT *FROM region";
            $resultado = mysqli_query($conexion, $consulta);
    
            while($row = mysqli_fetch_assoc($resultado)){
                $region = $row["nombre_region"];
                $id=$row["id_region"];
            
                echo "<tr>";
                    echo "<td>".$region."</td>";
            
                    echo "<td>";
                        echo "<a href='borrar_region.php?id_e=".$id."'>Borrar</a>";
                        echo "<a href='form_edicion_region.php?id_e=".$id."'> Editar</a>";
                    echo "</td>";
                    
                echo "</tr>";
            }
        
        ?>
    </table>
    </div>
</body>
</html>