<?php
    include '../../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql_consulta_comuna = "SELECT c.id_comuna, c.nombre_comuna, c.id_provincia, p.nombre_provincia AS provincia
                                FROM comuna c LEFT JOIN provincia p ON c.id_provincia = p.id_provincia;";
        $resultado = mysqli_query($conexion, $sql_consulta_comuna);

        if ($resultado) {
            $comunas = array();

            if ($resultado->num_rows > 0) {
                // Se obtienen los datos de cada fila y se agregan al array de comunas
                while ($registro = $resultado->fetch_array()) {
                    $fila = array();
                    $fila['id_comuna'] = $registro['id_comuna'];
                    $fila['nombre_comuna'] = $registro['nombre_comuna'];
                    $fila['provincia'] = $registro['provincia'];

                    $fila['opciones'] = "<a id='delete' data-id=".$registro['id_comuna']." class='btn btn-sm btn-outline-danger' ><span class='material-icons'>delete</span></a>
                                        <a id='edit' data-id=".$registro['id_comuna']." data-comuna=\"".$registro['nombre_comuna']."\" data-provincia=\"".$registro['id_provincia']."\" class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#editComunaModal'><span class='material-icons'>edit</span></a>";

                    $comunas[] = $fila;
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
                'message' => 'Error al obtener las comunas. Intente de nuevo'
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