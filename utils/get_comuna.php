<?php
    require('../database/conexion.php');

    // Consulta para obtener las comunas
    $sql = "SELECT id_comuna, nombre_comuna FROM comuna ORDER BY nombre_comuna";
    $resultado = $conexion->query($sql);

    $comunas = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $comunas[] = $row; // Se agrega cada fila de la tabla comuna al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($comunas);

    $conexion->close();
?>