<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['id_comuna'])) {

            $id_comuna = $_REQUEST['id_comuna'];

            $sql = "DELETE FROM comuna WHERE id_comuna = '$id_comuna';";

            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                $response = array(
                    'success' => true,
                    'message' => 'Comuna eliminada exitosamente',

                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error al eliminar la comuna. Intente de nuevo'
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