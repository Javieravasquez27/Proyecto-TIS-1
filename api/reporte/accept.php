<?php
include('../../database/conexion.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_reporte = mysqli_real_escape_string($conexion, $_POST['id_reporte']);
    if (!empty($id_reporte)) {
        $query = "UPDATE reporte_profesional SET estado = 'aceptado' WHERE id_reporte = '$id_reporte'";
        if (mysqli_query($conexion, $query)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($conexion)]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID de reporte no proporcionado']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}
?>

