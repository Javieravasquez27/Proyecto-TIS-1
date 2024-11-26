<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_servicio = "SELECT id_servicio, nombre_servicio FROM servicio;";
        $resultado = mysqli_query($conexion, $sql_consulta_servicio);

        if ($resultado) {
            $servicios = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de servicios
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_servicio'] = $registro['id_servicio'];
                    $fila['nombre_servicio'] = $registro['nombre_servicio'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_servicio']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_servicio']." data-servicio=\"".$registro['nombre_servicio']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editServicioModal'><span class='material-icons'>edit</span></a>";

                    $servicios[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Servicios obtenidos correctamente',
                'data' => $servicios
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener los servicios. Intente de nuevo'
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