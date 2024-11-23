<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['id_provincia'])) {

            $id_provincia = $_REQUEST['id_provincia'];

            $sql = "DELETE FROM provincia WHERE id_provincia = '$id_provincia';";

            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                $response = array(
                    'success' => true,
                    'message' => 'Provincia eliminada exitosamente',

                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error al eliminar la provincia. Intente de nuevo'
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