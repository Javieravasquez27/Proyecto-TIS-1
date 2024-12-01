<?php
session_start();
include('conexion.php'); // Archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rut_usuario = $_SESSION['rut']; // ID del usuario actual (debe estar en la sesión)
    $rut_profesional = $_POST['profesional_id'];

    // Prepara la consulta SQL
    $sql = "INSERT INTO favoritos (rut_usuario, rut_profesional) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);

    // Ejecuta la consulta y verifica el resultado
    if ($stmt->execute([20981734, $rut_profesional])) {
        echo json_encode(['message' => 'Profesional guardado como favorito.']);
    } else {
        echo json_encode(['message' => 'Error al guardar favorito.']);
    }
}
?>
