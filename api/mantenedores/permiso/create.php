<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_permiso'])) {

            $nombre_permiso = stripslashes($_REQUEST['nombre_permiso']);
            $nombre_permiso = mysqli_real_escape_string($conexion, $nombre_permiso);

            $sql_ingreso_permiso = "INSERT INTO permiso (nombre_permiso) VALUES ('$nombre_permiso');";
            $resultado_permiso = mysqli_query($conexion, $sql_ingreso_permiso);

            $response = array(
                'success' => true,
                'message' => 'Permiso ingresado exitosamente'
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