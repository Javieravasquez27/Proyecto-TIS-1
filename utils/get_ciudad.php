<?php
    require('../database/connection.php');

    // Consulta para obtener las ciudades
    $sql = "SELECT id_ciudad, nombre_ciudad FROM ciudad ORDER BY nombre_ciudad";
    $resultado = $connection->query($sql);

    $roles = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $roles[] = $row; // Se agrega cada fila de la tabla ciudad al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($roles);

    $connection->close();
?>