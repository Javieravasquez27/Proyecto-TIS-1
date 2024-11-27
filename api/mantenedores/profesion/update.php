<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_profesion = $_POST['id_profesion'] ?? null;
        $nombre_profesion = $_POST['nombre_profesion'] ?? null;
    
        if ($id_profesion && $nombre_profesion) {
            $sql = "UPDATE profesion 
                    SET nombre_profesion = ?
                    WHERE id_profesion = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $nombre_profesion, $id_profesion);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Profesión actualizada correctamente';
            } else {
                $response['message'] = 'Error al actualizar la profesión. Intente de nuevo';
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