<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_profesion'])) {

            $nombre_profesion = stripslashes($_REQUEST['nombre_profesion']);
            $nombre_profesion = mysqli_real_escape_string($conexion, $nombre_profesion);

            $sql_ingreso_profesion = "INSERT INTO profesion (nombre_profesion) VALUES ('$nombre_profesion');";
            $resultado_profesion = mysqli_query($conexion, $sql_ingreso_profesion);

            $response = array(
                'success' => true,
                'message' => 'Profesión ingresada exitosamente'
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