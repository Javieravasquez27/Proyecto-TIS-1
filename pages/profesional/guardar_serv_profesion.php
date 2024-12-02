<?php
    include('../../database/conexion.php');
    session_start();

    header('Content-Type: application/json');

    $rut_profesional = $_SESSION['rut'];
    $servicio = $_POST['servicio_profesion'];
    $precio_servicio = $_POST['precio_serv_profesion'];

    $sql_consulta_inserta_serv_profesion = "INSERT INTO servicio_profesional (id_servicio, rut_profesional, precio_serv_prof) VALUES ('$servicio', '$rut_profesional', '$precio_servicio');";
    $resultado_inserta_serv_profesion = mysqli_query($conexion, $sql_consulta_inserta_serv_profesion);
    
    if ($resultado_inserta_serv_profesion) {
        echo json_encode(['status' => 'success', 'message' => 'Disponibilidad guardada correctamente.']);
    }
    else
    {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
?>