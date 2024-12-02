<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_rs = "SELECT id_rs, nombre_rs FROM red_social;";
        $resultado = mysqli_query($conexion, $sql_consulta_rs);

        if ($resultado) {
            $redes_sociales = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de redes sociales
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_rs'] = $registro['id_rs'];
                    $fila['nombre_rs'] = $registro['nombre_rs'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_rs']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_rs']." data-rs=\"".$registro['nombre_rs']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editRedSocialModal'><span class='material-icons'>edit</span></a>";

                    $redes_sociales[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Redes sociales obtenidas correctamente',
                'data' => $redes_sociales
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener las redes sociales. Intente de nuevo'
            );
        }
    } catch (PDOException $e) {
        $response = array(
            'success' => false,
            'message' => 'Error en el servidor. Intente de nuevo más tarde'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>