<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_permiso = $_POST['id_permiso'] ?? null;
        $nombre_permiso = $_POST['nombre_permiso'] ?? null;
        $descripcion_permiso = $_POST['descripcion_permiso'] ?? null;
    
        if ($id_permiso && $nombre_permiso) {
            $sql = "UPDATE permiso 
                    SET nombre_permiso = ?, descripcion_permiso = ?
                    WHERE id_permiso = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssi", $nombre_permiso, $descripcion_permiso, $id_permiso);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Permiso actualizado correctamente';
            } else {
                $response['message'] = 'Error al actualizar el permiso. Intente de nuevo';
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