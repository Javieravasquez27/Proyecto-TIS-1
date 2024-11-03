<?php
    require('../database/connection.php');

    // Consulta para obtener las servicios
    $sql = "SELECT id_servicio, nombre_servicio FROM servicio ORDER BY nombre_servicio";
    $resultado = $connection->query($sql);

    $servicios = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $servicios[] = $row; // Se agrega cada fila de la tabla servicio al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($servicios);

    $connection->close();
?>