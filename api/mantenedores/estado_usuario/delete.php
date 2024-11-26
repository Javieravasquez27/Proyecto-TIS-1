<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['id_estado_usuario'])) {

            $id_estado_usuario = $_REQUEST['id_estado_usuario'];

            $sql = "DELETE FROM estado_usuario WHERE id_estado_usuario = '$id_estado_usuario'";

            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                $response = array(
                    'success' => true,
                    'message' => 'Estado de usuario eliminado exitosamente',

                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error al eliminar el estado de usuario. Intente de nuevo'
                );
            }
        } else {
            $response = array(
                'success' => false,
                'message' => 'Error en los datos recibidos'
            );
        }
    } catch (PDOException $e) {

        $response = array(
            'success' => false,
            'message' => 'Error en el servidor. Intente de nuevo más tarde'
        );
    }

    echo json_encode($response);
?>