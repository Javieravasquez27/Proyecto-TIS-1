<?php
    require('database\conexion.php');
    
    $id_r = $_GET["id_e"];
    $consulta = "DELETE FROM rol WHERE id_rol = $id_r";
    $resultado = mysqli_query($conexion,$consulta);
    
    header('location: index.php?p=admin/mantenedores/rol/index_rol');
?>