<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_th = "SELECT id_th, horario FROM tipo_horario;";
        $resultado = mysqli_query($conexion, $sql_consulta_th);

        if ($resultado) {
            $redes_sociales = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de tipos de horario
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_th'] = $registro['id_th'];
                    $fila['horario'] = $registro['horario'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_th']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_th']." data-th=\"".$registro['horario']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editTipoHorarioModal'><span class='material-icons'>edit</span></a>";

                    $redes_sociales[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Tipos de horario obtenidos correctamente',
                'data' => $redes_sociales
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener los tipos de horario. Intente de nuevo'
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