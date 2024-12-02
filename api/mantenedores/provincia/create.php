<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_provincia']) && isset($_POST['id_region'])) {

            $nombre_provincia = stripslashes($_REQUEST['nombre_provincia']);
            $nombre_provincia = mysqli_real_escape_string($conexion, $nombre_provincia);
            $id_region = stripslashes($_REQUEST['id_region']);
            $id_region = mysqli_real_escape_string($conexion, $id_region);

            $sql_ingreso_provincia = "INSERT INTO provincia (nombre_provincia, id_region) VALUES ('$nombre_provincia', '$id_region');";
            $resultado_provincia = mysqli_query($conexion, $sql_ingreso_provincia);

            $response = array(
                'success' => true,
                'message' => 'Provincia ingresada exitosamente'
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