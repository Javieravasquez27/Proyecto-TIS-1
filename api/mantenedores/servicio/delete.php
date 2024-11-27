<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['id_servicio'])) {

            $id_servicio = $_REQUEST['id_servicio'];

            $sql = "DELETE FROM servicio WHERE id_servicio = '$id_servicio'";

            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                $response = array(
                    'success' => true,
                    'message' => 'Servicio eliminado exitosamente',

                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error al eliminar el servicio. Intente de nuevo'
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