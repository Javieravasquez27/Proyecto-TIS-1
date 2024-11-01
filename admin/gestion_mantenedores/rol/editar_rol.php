<?php
    require('..\conexion.php');
    $nombre_e = $_POST["nombre_e"];
    $id_e = $_POST["id_e"];
    $consulta ="UPDATE rol
                SET nombre_rol = '$nombre_e'
                WHERE id_rol = '$id_e'";

    $resultado = mysqli_query($conexion,$consulta);
    header('location: index_rol.php');

?>