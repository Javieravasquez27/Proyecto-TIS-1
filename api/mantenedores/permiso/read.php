<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_permiso = "SELECT id_permiso, nombre_permiso, descripcion_permiso FROM permiso;";
        $resultado = mysqli_query($conexion, $sql_consulta_permiso);

        if ($resultado) {
            $permisos = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de permisos
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_permiso'] = $registro['id_permiso'];
                    $fila['nombre_permiso'] = $registro['nombre_permiso'];
                    $fila['descripcion_permiso'] = $registro['descripcion_permiso'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_permiso']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_permiso']." data-permiso=\"".$registro['nombre_permiso']."\" data-descripcion=\"".$registro['descripcion_permiso']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editPermisoModal'><span class='material-icons'>edit</span></a>";

                    $permisos[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Permisos obtenidos correctamente',
                'data' => $permisos
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener los permisos. Intente de nuevo'
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