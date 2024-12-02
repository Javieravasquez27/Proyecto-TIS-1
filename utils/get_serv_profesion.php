<?php
    require('../database/conexion.php');
    session_start();

    // Consulta para obtener los servicios y profesiones
    $rut_profesional = $_SESSION['rut'];
    $sql = "SELECT s.id_servicio, s.nombre_servicio AS nombre_servicio
            FROM servicio s JOIN servicio_profesion sp ON s.id_servicio = sp.id_servicio
                            JOIN profesion p ON sp.id_profesion = p.id_profesion
                            JOIN profesional prof ON p.id_profesion = prof.id_profesion
            WHERE prof.rut = '$rut_profesional';";
    $resultado = $conexion->query($sql);

    $serv_profesion = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $serv_profesion[] = $row; // Se agrega cada fila de la tabla servicios y profesiones al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($serv_profesion);

    $conexion->close();
?>