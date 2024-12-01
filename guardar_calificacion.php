<?php
include('conexion.php');

if (!empty($_POST['rating']) && !empty($_POST['rutUsuario']) && !empty($_POST['rutProfesional'])) {
    $rating = intval($_POST['rating']);
    $rutUsuario = intval($_POST['rutUsuario']);
    $rutProfesional = intval($_POST['rutProfesional']);

    $sql = "INSERT INTO clasificacion (rating_star, rut_usuario, rut_profesional) 
            VALUES ($rating, $rutUsuario, $rutProfesional)";
    if (mysqli_query($conn, $sql)) {
        echo "Calificación guardada";
    } else {
        http_response_code(500); // Indicar error al cliente
        echo "Error: " . mysqli_error($conn);
    }
} else {
    http_response_code(400); // Indicar solicitud inválida
    echo "Datos incompletos";
}
?>
