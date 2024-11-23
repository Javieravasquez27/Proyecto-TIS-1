<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_estado_usuario = "SELECT id_estado_usuario, nombre_estado_usuario FROM estado_usuario;";
        $resultado = mysqli_query($conexion, $sql_consulta_estado_usuario);

        if ($resultado) {
            $estados_usuario = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de estados de usuario
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_estado_usuario'] = $registro['id_estado_usuario'];
                    $fila['nombre_estado_usuario'] = $registro['nombre_estado_usuario'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_estado_usuario']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_estado_usuario']." data-estado_usuario=\"".$registro['nombre_estado_usuario']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editEstadoUsuarioModal'><span class='material-icons'>edit</span></a>";

                    $estados_usuario[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Estados de usuario obtenidos correctamente',
                'data' => $estados_usuario
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener los estados de usuario. Intente de nuevo'
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