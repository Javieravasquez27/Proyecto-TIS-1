<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_region = $_POST['id_region'] ?? null;
        $nombre_region = $_POST['nombre_region'] ?? null;
    
        if ($id_region && $nombre_region) {
            $sql = "UPDATE region 
                    SET nombre_region = ?
                    WHERE id_region = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $nombre_region, $id_region);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Región actualizada correctamente';
            } else {
                $response['message'] = 'Error al actualizar la región. Intente de nuevo';
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