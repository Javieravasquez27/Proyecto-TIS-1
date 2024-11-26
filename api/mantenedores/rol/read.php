<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_rol = "SELECT id_rol, nombre_rol FROM rol;";
        $resultado = mysqli_query($conexion, $sql_consulta_rol);

        if ($resultado) {
            $rols = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de rols
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_rol'] = $registro['id_rol'];
                    $fila['nombre_rol'] = $registro['nombre_rol'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_rol']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_rol']." data-rol=\"".$registro['nombre_rol']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editRolModal'><span class='material-icons'>edit</span></a>";

                    $rols[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Roles obtenidos correctamente',
                'data' => $rols
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener los roles. Intente de nuevo'
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