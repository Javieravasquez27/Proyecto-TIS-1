<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_rol = $_POST['id_rol'] ?? null;
        $nombre_rol = $_POST['nombre_rol'] ?? null;
    
        if ($id_rol && $nombre_rol) {
            $sql = "UPDATE rol 
                    SET nombre_rol = ?
                    WHERE id_rol = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("si", $nombre_rol, $id_rol);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Rol actualizado correctamente';
            } else {
                $response['message'] = 'Error al actualizar el rol. Intente de nuevo';
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