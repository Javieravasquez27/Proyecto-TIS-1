<?php
    require('..\conexion.php');
    $id_r = $_GET["id_e"];
    $consulta = "DELETE FROM tipo_horario WHERE id_tipohorario = $id_r";
    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_th.php') ;
?>