<?php
    include '../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql = "SELECT p.rut, u.nombres, u.apellido_p, u.apellido_m, u.correo, u.telefono,
                       pr.nombre_profesion AS profesion, i.nombre_institucion AS institucion,
                       p.experiencia, p.titulo_profesional, p.id_profesion, p.id_institucion, u.id_estado_usuario
                FROM profesional p JOIN profesion pr ON p.id_profesion = pr.id_profesion
                                   JOIN institucion i ON p.id_institucion = i.id_institucion
                                   JOIN usuario u ON p.rut = u.rut";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $usuarios = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de usuarios
                while ($record = $resultado->fetch_array()) {
                    $row = array();
                    $row['rut'] = $record['rut'];
                    $row['nombres'] = $record['nombres'];
                    $row['apellido_p'] = $record['apellido_p'];
                    $row['apellido_m'] = $record['apellido_m'];
                    $row['correo'] = $record['correo'];
                    $row['telefono'] = $record['telefono'];
                    $row['profesion'] = $record['profesion'];
                    $row['institucion'] = $record['institucion'];
                    $row['titulo_profesional'] = $record['titulo_profesional'];
                    $row['id_estado_usuario'] = $record['id_estado_usuario'];

                    $estado_usuario = $record['id_estado_usuario'];
                    $clase_boton = $estado_usuario == 1 ? 'btn-outline-danger' : 'btn-outline-success';
                    $texto_boton = $estado_usuario == 1 ? 'Desautorizar' : 'Autorizar';

                    $row['options'] = "<a data-id='{$record['rut']}' data-status='{$estado_usuario}' class='btn btn-sm {$clase_boton} toggle-status'>{$texto_boton}</a>";

                    $usuarios[] = $row;
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Usuarios obtenidos correctamente',
                'data' => $usuarios
            );

        } else {
            $response = array(
                'success' => false,
                'message' => 'Error al obtener los usuarios. Intente de nuevo.'
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