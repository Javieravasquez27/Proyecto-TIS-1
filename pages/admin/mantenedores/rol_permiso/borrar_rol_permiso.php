<?php
    require('database\conexion.php');
    
    $id_r = $_GET["id_e"];
    $consulta = "DELETE FROM permiso_rol WHERE id_rol = $id_r";
    $resultado = mysqli_query($conexion,$consulta);
    
    header('location: index.php?p=admin/mantenedores/rol_permiso/index_rol_permiso');
?>