<?php
    require('../database/conexion.php');

    // Consulta para obtener los roles
    $sql = "SELECT id_rol, nombre_rol FROM rol WHERE id_rol != 1 AND id_rol != 2 ORDER BY nombre_rol";
    $resultado = $conexion->query($sql);

    $roles = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $roles[] = $row; // Se agrega cada fila de la tabla rol al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($roles);

    $conexion->close();
?>