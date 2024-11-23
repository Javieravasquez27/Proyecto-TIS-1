<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_servicio = $_POST['id_servicio'] ?? null;
        $nombre_servicio = $_POST['nombre_servicio'] ?? null;
    
        if ($id_servicio && $nombre_servicio) {
            $sql = "UPDATE servicio 
                    SET nombre_servicio = ?
                    WHERE id_servicio = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $nombre_servicio, $id_servicio);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Servicio actualizado correctamente';
            } else {
                $response['message'] = 'Error al actualizar el servicio. Intente de nuevo';
            }
        
            $stmt->close();
        } else {
            $response['message'] = 'Datos incompletos';
        }
    } else {
        $response['message'] = 'Método no permitido';
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>