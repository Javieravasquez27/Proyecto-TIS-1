<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_institucion = $_POST['id_institucion'] ?? null;
        $nombre_institucion = $_POST['nombre_institucion'] ?? null;
    
        if ($id_institucion && $nombre_institucion) {
            $sql = "UPDATE institucion 
                    SET nombre_institucion = ?
                    WHERE id_institucion = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $nombre_institucion, $id_institucion);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Institución actualizada correctamente';
            } else {
                $response['message'] = 'Error al actualizar la institución. Intente de nuevo';
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