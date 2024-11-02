<?php
    require('..\conexion.php');
    $nombre_e = $_POST["nombre_e"];
    $id_e = $_POST["id_e"];
    $consulta ="UPDATE red_social
                SET nombre_rs = '$nombre_e'
                WHERE id_rs = '$id_e'";

    $resultado = mysqli_query($connection,$consulta);
    header('location: index_rs.php') ;

?>