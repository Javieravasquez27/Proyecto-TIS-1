<?php
    require('conexion.php');
    $nombre_e = $_POST["nombre_rs_e"];
    $id_e = $_POST["id_rs_e"];
    $consulta ="UPDATE tipo_horario
                SET horario = '$nombre_e'
                WHERE id_tipohorario = '$id_e'";

    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_th.php') ;

?>