<?php
include('../../database/conexion.php');

header('Content-Type: application/json');

// Consulta para obtener los datos de los reportes
$query = "SELECT rut_cliente, rut_profesional, motivo_reporte FROM reporte_profesional";
$result = mysqli_query($conexion, $query);

$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode(['data' => $data]);
} else {
    echo json_encode(['error' => 'Error al recuperar los datos de la base de datos.']);
}
?>
