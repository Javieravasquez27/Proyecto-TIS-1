<?php
    include '../database/connection.php';

    header('Content-Type: application/json');

    $response = ["success" => false, "message" => ""];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rut = $_POST['rut'];
        $id_rol = $_POST['id_rol'];

        $sql = "UPDATE usuario SET id_rol = ? WHERE rut = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("is", $id_rol, $rut);

        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Rol cambiado exitosamente.";
        } else {
            $response["message"] = "Error al cambiar el rol: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $response["message"] = "Parámetros faltantes.";
    }

    $connection->close();
    echo json_encode($response);
?>