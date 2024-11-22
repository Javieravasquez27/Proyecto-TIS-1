<?php
    include '../../../database/conexion.php';
    
    $response = ['success' => false, 'message' => ''];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_comuna = $_POST['id_comuna'];
        $nombre_comuna = $_POST['nombre_comuna'];
        $id_provincia = $_POST['id_provincia'];
    
        if ($id_comuna && $nombre_comuna && $id_provincia) {
            $sql = "UPDATE comuna 
                    SET nombre_comuna = ?, id_provincia = ?
                    WHERE id_comuna = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sii", $nombre_comuna, $id_provincia, $id_comuna);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Comuna actualizada correctamente.';
            } else {
                $response['message'] = 'Error al actualizar la comuna. Intente de nuevo.';
            }
        
            $stmt->close();
        } else {
            $response['message'] = 'Datos incompletos.';
        }
    } else {
        $response['message'] = 'Método no permitido.';
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>