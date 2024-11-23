<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_profesion = "SELECT id_profesion, nombre_profesion FROM profesion;";
        $resultado = mysqli_query($conexion, $sql_consulta_profesion);

        if ($resultado) {
            $profesiones = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de profesiones
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_profesion'] = $registro['id_profesion'];
                    $fila['nombre_profesion'] = $registro['nombre_profesion'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_profesion']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_profesion']." data-profesion=\"".$registro['nombre_profesion']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editProfesionModal'><span class='material-icons'>edit</span></a>";

                    $profesiones[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Profesiones obtenidas correctamente',
                'data' => $profesiones
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener las profesiones. Intente de nuevo'
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