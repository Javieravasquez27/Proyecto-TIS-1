<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_provincia = $_POST['id_provincia'] ?? null;
        $nombre_provincia = $_POST['nombre_provincia'] ?? null;
        $id_region = $_POST['id_region'] ?? null;
    
        if ($id_provincia && $nombre_provincia && $id_region) {
            $sql = "UPDATE provincia 
                    SET nombre_provincia = ?, id_region = ?
                    WHERE id_provincia = ?;";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sii", $nombre_provincia, $id_region, $id_provincia);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Provincia actualizada correctamente';
            } else {
                $response['message'] = 'Error al actualizar la provincia. Intente de nuevo';
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