<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_rs'])) {

            $nombre_rs = stripslashes($_REQUEST['nombre_rs']);
            $nombre_rs = mysqli_real_escape_string($conexion, $nombre_rs);

            $sql_ingreso_rs = "INSERT INTO red_social (nombre_rs) VALUES ('$nombre_rs');";
            $resultado_rs = mysqli_query($conexion, $sql_ingreso_rs);

            $response = array(
                'success' => true,
                'message' => 'Red social ingresada exitosamente'
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