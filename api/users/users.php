<?php
    include '../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $sql = "SELECT u.rut, u.nombre_usuario, u.nombres, u.apellido_p, u.apellido_m, u.correo, u.telefono, u.fecha_nac,
                       u.direccion, c.nombre_comuna AS comuna, r.nombre_rol AS rol, u.id_comuna, u.id_rol, u.id_estado_usuario
                FROM usuario u LEFT JOIN comuna c ON u.id_comuna = c.id_comuna
                               LEFT JOIN rol r ON u.id_rol = r.id_rol
                WHERE u.id_rol != 1";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $usuarios = array();

            if ($resultado->num_rows > 0) {
                // Obtener los datos de cada fila y agregarlos al array de usuarios
                while ($record = $resultado->fetch_array()) {
                    $row = array();
                    $row['rut'] = $record['rut'];
                    $row['nombre_usuario'] = $record['nombre_usuario'];
                    $row['nombres'] = $record['nombres'];
                    $row['apellido_p'] = $record['apellido_p'];
                    $row['apellido_m'] = $record['apellido_m'];
                    $row['correo'] = $record['correo'];
                    $row['telefono'] = $record['telefono'];
                    $row['fecha_nac'] = $record['fecha_nac'];
                    $row['direccion'] = $record['direccion'];
                    $row['comuna'] = $record['comuna'];
                    $row['rol'] = $record['rol'];
                    $row['id_rol'] = $record['id_rol'];

                    $estado_usuario = $record['id_estado_usuario'];
                    $rol_usuario = $record['id_rol'];
                    $clase_boton = $estado_usuario == 1 ? 'btn-outline-danger' : 'btn-outline-success';
                    $texto_boton = $estado_usuario == 1 ? 'Desactivar' : 'Activar';

                    $row['options'] = "<a data-id='{$record['rut']}' data-status='{$estado_usuario}' class='btn btn-sm {$clase_boton} toggle-status'>{$texto_boton}</a>
                                       <a data-id='{$record['rut']}' data-status='{$rol_usuario}' data-rol='{$rol_usuario}' class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#addUserModal'>Cambiar Rol</a>";

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