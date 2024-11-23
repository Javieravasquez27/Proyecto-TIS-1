<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_estado_usuario = $_POST['id_estado_usuario'] ?? null;
        $nombre_estado_usuario = $_POST['nombre_estado_usuario'] ?? null;
    
        if ($id_estado_usuario && $nombre_estado_usuario) {
            $sql = "UPDATE estado_usuario 
                    SET nombre_estado_usuario = ?
                    WHERE id_estado_usuario = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $nombre_estado_usuario, $id_estado_usuario);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Estado de usuario actualizado correctamente';
            } else {
                $response['message'] = 'Error al actualizar el estado de usuario. Intente de nuevo';
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