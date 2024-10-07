<?php
    require('..\conexion.php');
    $nombre_e = $_POST["nombre_permiso"];
    $id_e = $_POST["id_permiso"];
    $consulta ="UPDATE permiso
                SET nombre_permiso = '$nombre_e'
                WHERE id_permiso = '$id_e'";

    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_permiso.php');

?>