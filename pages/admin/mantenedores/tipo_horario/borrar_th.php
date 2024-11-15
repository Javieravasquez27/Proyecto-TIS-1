<?php
    require('database\conexion.php');

    $id_r=$_GET["id_e"];

    $consulta = "DELETE FROM tipo_horario WHERE id_th='$id_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/tipo_horario/index_th');

?>