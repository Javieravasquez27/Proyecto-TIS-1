<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_region'])) {

            $nombre_region = stripslashes($_REQUEST['nombre_region']);
            $nombre_region = mysqli_real_escape_string($conexion, $nombre_region);

            $sql_ingreso_region = "INSERT INTO region (nombre_region) VALUES ('$nombre_region');";
            $resultado_region = mysqli_query($conexion, $sql_ingreso_region);

            $response = array(
                'success' => true,
                'message' => 'Región ingresada exitosamente'
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