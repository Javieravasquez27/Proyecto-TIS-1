<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql = "SELECT c.id_comuna, c.nombre_comuna, c.id_provincia, p.nombre_provincia AS provincia
                FROM comuna c LEFT JOIN provincia p ON c.id_provincia = p.id_provincia";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $comunas = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de comunas
                while ($record = $resultado->fetch_array()) {
                    $row = array();
                    $row['id_comuna'] = $record['id_comuna'];
                    $row['nombre_comuna'] = $record['nombre_comuna'];
                    $row['provincia'] = $record['provincia'];

                    $row['opciones'] = "<a id='delete' data-id=".$record['id_comuna']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$record['id_comuna']." data-comuna=\"".$record['nombre_comuna']."\" data-provincia=\"".$record['id_provincia']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editComunaModal'><span class='material-icons'>edit</span></a>";

                    $comunas[] = $row;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Comunas obtenidas correctamente',
                'data' => $comunas
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener las comunas. Intente de nuevo.'
            );
        }
    } catch (PDOException $e) {
        $response = array(
            'success' => false,
            'message' => 'Error en el servidor. Intente de nuevo más tarde.'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>