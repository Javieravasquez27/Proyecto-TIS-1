<?php
    include '../database/conexion.php';

    header('Content-Type: application/json'); // Asegúrate de que se envíe la respuesta como JSON

    $response = ["success" => false, "message" => ""];

    if (isset($_POST['rut']) && isset($_POST['id_estado_usuario'])) {
        $rut = $_POST['rut'];
        $nuevo_estado_usuario = $_POST['id_estado_usuario'];

        $consulta = "UPDATE usuario SET id_estado_usuario = ? WHERE rut = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param("is", $nuevo_estado_usuario, $rut);

        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Estado actualizado exitosamente.";
        } else {
            $response["message"] = "Error al actualizar el estado: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $response["message"] = "Parámetros faltantes.";
    }

    $conexion->close();
    echo json_encode($response);
?>