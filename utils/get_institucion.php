<?php
    require('../database/conexion.php');

    // Consulta para obtener las instituciones
    $sql = "SELECT id_institucion, nombre_institucion FROM institucion ORDER BY nombre_institucion";
    $resultado = $conexion->query($sql);

    $instituciones = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $instituciones[] = $row; // Se agrega cada fila de la tabla institucion al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($instituciones);

    $conexion->close();
?>