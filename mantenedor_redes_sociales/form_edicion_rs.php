<?php
    require('conexion.php');
    $id_recibido = $_GET["id_e"];
        $consulta = "SELECT * FROM redes_sociales WHERE id_Rs=$id_recibido";
        $resultado = mysqli_query($conexion,$consulta);
        while($row=mysqli_fetch_assoc($resultado)){
            $nombre_consultado = $row["nombre_rs"];
            $id = $row["id_rs"];
        }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid contenedorcompleto">
        <nav class="navbar bg-success-subtle shadow-lg rounded-pill">
        <div class="container-fluid">
            <form action="editar_rs.php" method="POST">
                <label for="">Nombre Red Social</label>
                <input type="text" name="nombre_rs_e" value="<?php echo $nombre_consultado ?>">

                <input type="hidden" name="id_rs_e" value="<?php echo $id_recibido ?>">
                <input type="submit" value="guardar">
            </form>
        </div>
        </nav>
</body>
</html>