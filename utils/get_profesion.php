<?php
    require('../database/conexion.php');

    // Consulta para obtener las profesiones
    $sql = "SELECT id_profesion, nombre_profesion FROM profesion ORDER BY nombre_profesion";
    $resultado = $conexion->query($sql);

    $profesiones = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $profesiones[] = $row; // Se agrega cada fila de la tabla profesion al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($profesiones);

    $conexion->close();
?>