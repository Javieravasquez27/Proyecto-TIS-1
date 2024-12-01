<?php
    require('../database/conexion.php');

    // Consulta para obtener las servicios
    $sql = "SELECT id_th, horario FROM tipo_horario";
    $resultado = $conexion->query($sql);

    $horarios = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $horarios[] = $row; // Se agrega cada fila de la tabla servicio al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($horarios);

    $conexion->close();
?>