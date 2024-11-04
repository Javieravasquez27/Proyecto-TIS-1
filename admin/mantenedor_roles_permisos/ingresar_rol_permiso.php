<?php
    require('..\conexion.php');
    $id_rol = $_POST["id_e"];
    $permisos = $_POST["permisos"];
    foreach($permisos as $permiso){
        $consulta = "INSERT INTO permiso_rol (id_permiso,id_rol) 
        values('$permiso','$id_rol')";
        $resultado = mysqli_query($conexion,$consulta);
    }
    header('location: index_rol_permiso.php');

?>