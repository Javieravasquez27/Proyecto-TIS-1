<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_comuna']) && isset($_POST['id_provincia'])) {

            $nombre_comuna = stripslashes($_REQUEST['nombre_comuna']);
            $nombre_comuna = mysqli_real_escape_string($conexion, $nombre_comuna);
            $id_provincia = stripslashes($_REQUEST['id_provincia']);
            $id_provincia = mysqli_real_escape_string($conexion, $id_provincia);

            $sql_ingreso_comuna = "INSERT INTO comuna (nombre_comuna, id_provincia) VALUES ('$nombre_comuna', '$id_provincia');";
            $resultado_comuna = mysqli_query($conexion, $sql_ingreso_comuna);

            $response = array(
                'success' => true,
                'message' => 'Comuna ingresada exitosamente'
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