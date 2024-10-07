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
<div class="container-fluid contenedorcompleto">
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
        <div class="container-fluid">
        <form action="ingresa_comuna.php" method="POST">

           <label for="">nombre comuna</label> 
           <input type="text" name="nombre_comuna_e">

           <label for="">id ciudad</label> 
           <input type="number" name="id_ciudad_e">

           <input type="submit" value="Guardar">
        </form>
        </div>
        </nav>
        <br>

        <table class="table table-dark table-bordered ">
        <tr>
            
            <th>nombre_comuna</th>
            <th>id_ciudad</th>
            <th>Opciones</th>
        </tr>
        
        <?php
        $consulta ="SELECT *FROM comuna";
        $resultado = mysqli_query($conexion, $consulta);

        while($row = mysqli_fetch_assoc($resultado)){
            
            $nombre_comuna_consultado = $row["nombre_comuna"];
            $id_ciudad_consultado = $row["id_ciudad"];
            echo "<tr>";
                
                echo "<td>".$nombre_comuna_consultado."</td>";
                echo "<td>".$id_ciudad_consultado."</td>";
                echo "<td>";
                    echo "<a href='borrar_comuna.php?id_e=".$id_ciudad_consultado."'>Borrar</a>";
                    echo "<a href='form_edicion_comuna.php?id_e=".$id_ciudad_consultado."'> Editar</a>";
                echo "</td>";
                
            echo "</tr>";
        }

        ?>
    </table>
    </div>
</body>
</html>