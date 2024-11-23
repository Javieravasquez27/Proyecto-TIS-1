<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['horario'])) {

            $horario = stripslashes($_REQUEST['horario']);
            $horario = mysqli_real_escape_string($conexion, $horario);

            $sql_ingreso_th = "INSERT INTO tipo_horario (horario) VALUES ('$horario');";
            $resultado_th = mysqli_query($conexion, $sql_ingreso_th);

            $response = array(
                'success' => true,
                'message' => 'Tipo de horario ingresado exitosamente'
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