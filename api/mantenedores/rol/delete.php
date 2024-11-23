<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['id_rol'])) {

            $id_rol = $_REQUEST['id_rol'];

            $sql = "DELETE FROM rol WHERE id_rol = '$id_rol'";

            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                $response = array(
                    'success' => true,
                    'message' => 'Rol eliminado exitosamente',

                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error al eliminar el rol. Intente de nuevo'
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