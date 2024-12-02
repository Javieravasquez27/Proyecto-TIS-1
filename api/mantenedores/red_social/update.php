<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_rs = $_POST['id_rs'] ?? null;
        $nombre_rs = $_POST['nombre_rs'] ?? null;
    
        if ($id_rs && $nombre_rs) {
            $sql = "UPDATE red_social 
                    SET nombre_rs = ?
                    WHERE id_rs = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $nombre_rs, $id_rs);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Red social actualizada correctamente';
            } else {
                $response['message'] = 'Error al actualizar la red social. Intente de nuevo';
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