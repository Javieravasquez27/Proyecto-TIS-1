<?php
    require('database\conexion.php');

    $id_r=$_GET["id_e"];

    $consulta = "DELETE FROM comuna WHERE id_comuna=$id_r;";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/comuna/index_comuna');

?>
