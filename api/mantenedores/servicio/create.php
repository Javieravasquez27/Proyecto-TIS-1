<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_servicio'])) {

            $nombre_servicio = stripslashes($_REQUEST['nombre_servicio']);
            $nombre_servicio = mysqli_real_escape_string($conexion, $nombre_servicio);

            $sql_ingreso_servicio = "INSERT INTO servicio (nombre_servicio) VALUES ('$nombre_servicio');";
            $resultado_servicio = mysqli_query($conexion, $sql_ingreso_servicio);

            $response = array(
                'success' => true,
                'message' => 'Servicio ingresado exitosamente'
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