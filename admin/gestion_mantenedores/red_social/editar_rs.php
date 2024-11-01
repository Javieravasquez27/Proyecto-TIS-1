<?php
    require('..\conexion.php');
    $nombre_e = $_POST["nombre_e"];
    $id_e = $_POST["id_e"];
    $consulta ="UPDATE redes_sociales
                SET nombre_rs = '$nombre_e'
                WHERE id_rs = '$id_e'";

    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_rs.php') ;

?>