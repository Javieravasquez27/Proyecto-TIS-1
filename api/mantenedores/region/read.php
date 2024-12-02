<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_region = "SELECT id_region, nombre_region FROM region;";
        $resultado = mysqli_query($conexion, $sql_consulta_region);

        if ($resultado) {
            $regiones = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de regiones
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_region'] = $registro['id_region'];
                    $fila['nombre_region'] = $registro['nombre_region'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_region']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_region']." data-region=\"".$registro['nombre_region']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editRegionModal'><span class='material-icons'>edit</span></a>";

                    $regiones[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Regiones obtenidas correctamente',
                'data' => $regiones
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener las regiones. Intente de nuevo'
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