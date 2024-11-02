<?php
    require('..\conexion.php');

    $id_r=$_GET["id_e"];

    $consulta = "DELETE FROM institucion WHERE id_institucion='$id_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_institucion.php');

?>