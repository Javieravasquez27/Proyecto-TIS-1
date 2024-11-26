<?php
    include '../../../database/conexion.php';

    try {
        if (isset($_POST['nombre_permiso']) && $_POST['descripcion_permiso']) {

            $nombre_permiso = stripslashes($_REQUEST['nombre_permiso']);
            $nombre_permiso = mysqli_real_escape_string($conexion, $nombre_permiso);
            $descripcion_permiso = stripslashes($_REQUEST['descripcion_permiso']);
            $descripcion_permiso = mysqli_real_escape_string($conexion, $descripcion_permiso);

            $sql_consulta_nombre_permiso = "SELECT nombre_permiso FROM permiso WHERE nombre_permiso = '$nombre_permiso';";
            $resultado_consulta_nombre_permiso = mysqli_query($conexion, $sql_consulta_nombre_permiso);

            if ($resultado_consulta_nombre_permiso->num_rows > 0) {
                $response = array(
                    'success' => false,
                    'message' => 'Ya existe un permiso con el nombre ingresado'
                );
            } else {
                $sql_ingreso_permiso = "INSERT INTO permiso (nombre_permiso, descripcion_permiso) VALUES ('$nombre_permiso', '$descripcion_permiso');";
                $resultado_permiso = mysqli_query($conexion, $sql_ingreso_permiso);

                $response = array(
                    'success' => true,
                    'message' => 'Permiso ingresado exitosamente'
                );
            }
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