<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_institucion = "SELECT id_institucion, nombre_institucion FROM institucion;";
        $resultado = mysqli_query($conexion, $sql_consulta_institucion);

        if ($resultado) {
            $instituciones = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de instituciones
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_institucion'] = $registro['id_institucion'];
                    $fila['nombre_institucion'] = $registro['nombre_institucion'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_institucion']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_institucion']." data-institucion=\"".$registro['nombre_institucion']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editInstitucionModal'><span class='material-icons'>edit</span></a>";

                    $instituciones[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Instituciones obtenidas correctamente',
                'data' => $instituciones
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener las instituciones. Intente de nuevo'
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