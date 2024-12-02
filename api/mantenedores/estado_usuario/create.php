<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_estado_usuario'])) {

            $nombre_estado_usuario = stripslashes($_REQUEST['nombre_estado_usuario']);
            $nombre_estado_usuario = mysqli_real_escape_string($conexion, $nombre_estado_usuario);

            $sql_ingreso_estado_usuario = "INSERT INTO estado_usuario (nombre_estado_usuario) VALUES ('$nombre_estado_usuario');";
            $resultado_estado_usuario = mysqli_query($conexion, $sql_ingreso_estado_usuario);

            $response = array(
                'success' => true,
                'message' => 'Estado de usuario ingresado exitosamente'
            );
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