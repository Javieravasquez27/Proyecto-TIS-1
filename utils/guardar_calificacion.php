<?php
    include '../database/conexion.php';
    session_start();
    
    $rut_profesional = $_POST['rut_profesional'];
    $servicio = $_POST['servicio'];
    $rating = $_POST['rating'];
    $opinion = mysqli_real_escape_string($conexion, $_POST['opinion']);
    $rut_usuario = $_SESSION['rut'];
    
    // Insertar la calificación y la opinión en la base de datos
    $query = "INSERT INTO clasificacion (rating_star, rut_usuario, rut_profesional, comentario)
              VALUES ('$rating', '$rut_usuario', '$rut_profesional', '$opinion')";
    mysqli_query($conexion, $query);
    
    // Responder con éxito
    echo json_encode(['success' => true]);
?>