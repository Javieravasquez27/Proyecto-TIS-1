<?php
    require('..\conexion.php');

    $id_profesion_r = $_GET["id_profesion_e"];
    
    $consulta = "DELETE FROM profesion WHERE id_profesion = '$id_profesion_r';";
    $resultado = mysqli_query($conexion, $consulta);

    header('Location: index_profesion.php');
?>