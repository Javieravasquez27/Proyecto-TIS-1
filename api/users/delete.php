<?php
include '../../database/conexion.php';

try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_POST['rut'])) {

        $rut = $_REQUEST['rut'];

        $sql = "DELETE FROM usuario WHERE rut = '$rut'";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $response = array(
                'success' => true,
                'message' => 'Usuario eliminado exitosamente',

            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al eliminar el usuario. Intente de nuevo.'
            );
        }
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error en los datos recibidos.'
        );
    }
} catch (PDOException $e) {

    $response = array(
        'success' => false,
        'message' => 'Error en el servidor. Intente de nuevo más tarde.'
    );
}

echo json_encode($response);