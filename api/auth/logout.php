<?php
include '../../database/connection.php';

try {

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (session_destroy()) {
        $response = array(
            'success' => true,
            'message' => 'La sesión ha sido cerrada.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error al cerrar la sesión.'
        );
    }
  
} catch (PDOException $e) {

    $response = array(
        'success' => false,
        'message' => 'Error en el servidor. Intente de nuevo más tarde.'
    );

}

echo json_encode($response);