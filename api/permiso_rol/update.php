<?php  
    include '../../database/conexion.php';
    
    $id_rol = $_POST['id_rol'] ?? null;
    $permisos = $_POST['permisos'] ?? null;
    
    if (!$id_rol) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos o incompletos.']);
        exit;
    }
    
    try {
        // Se eliminan permisos previos
        $consulta_borrado_permiso_rol = "DELETE FROM permiso_rol WHERE id_rol = ?";
        $stmt = $conexion->prepare($consulta_borrado_permiso_rol);
        $stmt->bind_param("i", $id_rol);
        $stmt->execute();
    
        // Se insertan los nuevos permisos
        if (!empty($permisos)) {
            $consulta_ingreso_permiso_rol = "INSERT INTO permiso_rol (id_rol, id_permiso) VALUES (?, ?)";
            $stmt = $conexion->prepare($consulta_ingreso_permiso_rol);
            foreach ($permisos as $id_permiso) {
                $stmt->bind_param("ii", $id_rol, $id_permiso);
                $stmt->execute();
            }
        }
    
        echo json_encode(['success' => true, 'message' => 'Permisos actualizados correctamente']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar los permisos']);
    }
?>