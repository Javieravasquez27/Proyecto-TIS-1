<?php
    require('../database/conexion.php');

    // Consulta para obtener las ciudades
    $sql = "SELECT id_ciudad, nombre_ciudad FROM ciudad ORDER BY nombre_ciudad";
    $resultado = $conexion->query($sql);

    $ciudades = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $ciudades[] = $row; // Se agrega cada fila de la tabla ciudad al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($ciudades);

    $conexion->close();
?>