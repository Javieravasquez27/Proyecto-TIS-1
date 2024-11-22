<?php
    require('../database/conexion.php');

    // Consulta para obtener las provincias
    $sql = "SELECT id_provincia, nombre_provincia FROM provincia ORDER BY id_provincia";
    $resultado = $conexion->query($sql);

    $provincias = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $provincias[] = $row; // Se agrega cada fila de la tabla provincia al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($provincias);

    $conexion->close();
?>