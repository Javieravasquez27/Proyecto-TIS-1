<?php
    require('conexion.php');
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mantenedor</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div class="container-fluid contenedorcompleto">
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
        <div class="container-fluid">
                <form action="ingresar_servicio.php" method="POST">
                    <label for="">Nombre servicio</label>
                    <input type="text" name="nombre_e"> 
                    <button type="sumbit" class="btn btn-outline-success">Guardar</button>
                </form>
        </div>
        </nav>
        <br>
        <table class="table table-dark table-bordered ">
            <tr>
                <th>Nombre servicio</th>
                <th>Opciones</th>
            </tr>
            <?php
                $consulta = "SELECT * FROM servicio";
                $resultado = mysqli_query($conexion,$consulta);
                while($row=mysqli_fetch_assoc($resultado)){
                    $nombre_consultado = $row["nombre_servicio"];
                    $id = $row["id_servicio"];
                    echo "<tr>";
                        echo "<td>".$nombre_consultado."</td>";
                        echo"<td><a href='Borrar_servicio.php?id_e=$id'>Borrar</a> <a href='form_edicion_servicio.php?id_e=$id'>Editar</a></td>";
                    echo"</tr>";
                }
            ?>
        </table>

    </div>
   </body>
</html>
