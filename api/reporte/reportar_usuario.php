<?php
// Incluir la conexión a la base de datos y otros archivos necesarios
include('../../database/conexion.php');
include('../../middleware/auth.php'); // Verifica que el usuario esté autenticado

// Verificar que los datos necesarios están presentes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rut_profesional = mysqli_real_escape_string($conexion, $_POST['rut_profesional']);
    $motivo = mysqli_real_escape_string($conexion, $_POST['motivo']);
    $rut_cliente = $_SESSION['rut']; // RUT del cliente autenticado

    // Validar que no falten datos
    if (empty($rut_profesional) || empty($motivo)) {
        echo json_encode(['error' => 'Todos los campos son obligatorios.']);
        http_response_code(400);
        exit;
    }

    // Insertar los datos en la tabla `reporte_profesional`
    $query = "INSERT INTO reporte_profesional (rut_cliente, rut_profesional, motivo_reporte) 
              VALUES ('$rut_cliente', '$rut_profesional', '$motivo')";

    if (mysqli_query($conexion, $query)) {
        echo json_encode(['success' => 'Reporte enviado exitosamente.']);
        http_response_code(200);
    } else {
        echo json_encode(['error' => 'Error al guardar el reporte: ' . mysqli_error($conexion)]);
        http_response_code(500);
    }
} else {
    echo json_encode(['error' => 'Método no permitido.']);
    http_response_code(405);
    exit;
}