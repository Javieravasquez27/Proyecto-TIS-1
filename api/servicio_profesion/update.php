<?php  
    include '../../database/conexion.php';
    
    $id_servicio = $_POST['id_servicio'] ?? null;
    $profesiones = $_POST['profesiones'] ?? null;
    
    if (!$id_servicio) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos o incompletos.']);
        exit;
    }
    
    try {
        // Se eliminan profesiones previas
        $consulta_borrado_servicio_profesion = "DELETE FROM servicio_profesion WHERE id_servicio = ?";
        $stmt = $conexion->prepare($consulta_borrado_servicio_profesion);
        $stmt->bind_param("i", $id_servicio);
        $stmt->execute();
    
        // Se insertan las nuevos profesiones
        if (!empty($profesiones)) {
            $consulta_ingreso_servicio_profesion = "INSERT INTO servicio_profesion (id_servicio, id_profesion) VALUES (?, ?)";
            $stmt = $conexion->prepare($consulta_ingreso_servicio_profesion);
            foreach ($profesiones as $id_profesion) {
                $stmt->bind_param("ii", $id_servicio, $id_profesion);
                $stmt->execute();
            }
        }
    
        echo json_encode(['success' => true, 'message' => 'Profesiones actualizadas correctamente para el servicio']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar las profesiones para el servicio']);
    }
?>