<?php
    include '../database/conexion.php';
    session_start();
    
    $rut_profesional = $_POST['rut_profesional'];
    $rut_cliente = $_POST['rut_cliente'];
    
    // Insertar el favorito en la base de datos
    $query = "INSERT INTO favoritos (rut_profesional, rut_usuario) VALUES ('$rut_profesional', '$rut_cliente')";
    mysqli_query($conexion, $query);
    
    // Responder con éxito
    echo json_encode(['success' => true]);
?>