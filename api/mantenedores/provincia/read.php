<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_provincia = "SELECT p.id_provincia, p.nombre_provincia, r.id_region, r.nombre_region AS region
                FROM provincia p LEFT JOIN region r ON p.id_region = r.id_region;";
        $resultado = mysqli_query($conexion, $sql_consulta_provincia);

        if ($resultado) {
            $provincias = array();

            if ($resultado->num_rows > 0) {
                // Se obtienen los datos de cada fila y se agregan al array de provincias
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_provincia'] = $registro['id_provincia'];
                    $fila['nombre_provincia'] = $registro['nombre_provincia'];
                    $fila['region'] = $registro['region'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_provincia']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_provincia']." data-provincia=\"".$registro['nombre_provincia']."\" data-region=\"".$registro['id_region']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editProvinciaModal'><span class='material-icons'>edit</span></a>";

                    $provincias[] = $fila;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Comunas obtenidas correctamente',
                'data' => $provincias
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener las provincias. Intente de nuevo'
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