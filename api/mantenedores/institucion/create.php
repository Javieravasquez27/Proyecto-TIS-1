<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_institucion'])) {

            $nombre_institucion = stripslashes($_REQUEST['nombre_institucion']);
            $nombre_institucion = mysqli_real_escape_string($conexion, $nombre_institucion);

            $sql_ingreso_institucion = "INSERT INTO institucion (nombre_institucion) VALUES ('$nombre_institucion');";
            $resultado_institucion = mysqli_query($conexion, $sql_ingreso_institucion);

            $response = array(
                'success' => true,
                'message' => 'Institución ingresada exitosamente'
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