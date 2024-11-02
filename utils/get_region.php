<?php
    require('../database/connection.php');

    // Consulta para obtener las regiones
    $sql = "SELECT id_region, nombre_region FROM region ORDER BY id_region";
    $resultado = $connection->query($sql);

    $roles = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $roles[] = $row; // Se agrega cada fila de la tabla region al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($roles);

    $connection->close();
?>