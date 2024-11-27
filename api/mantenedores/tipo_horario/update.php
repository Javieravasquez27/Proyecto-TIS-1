<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_th = $_POST['id_th'] ?? null;
        $horario = $_POST['horario'] ?? null;
    
        if ($id_th && $horario) {
            $sql = "UPDATE tipo_horario 
                    SET horario = ?
                    WHERE id_th = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $horario, $id_th);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Tipo de horario actualizado correctamente';
            } else {
                $response['message'] = 'Error al actualizar el tipo de horario. Intente de nuevo';
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