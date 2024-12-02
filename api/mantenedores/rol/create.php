<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_rol'])) {

            $nombre_rol = stripslashes($_REQUEST['nombre_rol']);
            $nombre_rol = mysqli_real_escape_string($conexion, $nombre_rol);

            $sql_ingreso_rol = "INSERT INTO rol (nombre_rol) VALUES ('$nombre_rol');";
            $resultado_rol = mysqli_query($conexion, $sql_ingreso_rol);

            $response = array(
                'success' => true,
                'message' => 'Rol ingresado exitosamente'
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