<?php
    require('database\conexion.php');

    $id_profesion_r = $_GET["id_e"];
    
    $consulta = "DELETE FROM profesion WHERE id_profesion = '$id_profesion_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index.php?p=admin/mantenedores/profesion/index_institucion');
?>