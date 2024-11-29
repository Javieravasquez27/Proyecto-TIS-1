<?php 
    include '../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $usuarioActualRol = $_SESSION['id_rol'] ?? null;
        $usuarioActualRut = $_SESSION['rut'] ?? null;

        $sql = "SELECT u.rut, u.nombre_usuario, u.nombres, u.apellido_p, u.apellido_m, u.correo, u.telefono, u.fecha_nac,
                       u.direccion, c.nombre_comuna AS comuna, r.nombre_rol AS rol, u.id_comuna, u.id_rol, u.id_estado_usuario, u.foto_perfil
                FROM usuario u LEFT JOIN comuna c ON u.id_comuna = c.id_comuna
                               LEFT JOIN rol r ON u.id_rol = r.id_rol WHERE u.id_rol != 1;";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $usuarios = array();

            if ($resultado->num_rows > 0) {
                while ($record = $resultado->fetch_array()) {
                    $row = array();
                    $row['rut'] = $record['rut'];
                    $row['foto_perfil'] = "<img src='{$record['foto_perfil']}' alt='Foto de Perfil' class='rounded-circle' style='width: 50px; height: 50px; object-fit: cover;'>";
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

                    $estado_usuario = $record['id_estado_usuario'];
                    $rol_usuario = $record['id_rol'];
                    $opciones = "";

                    // Botón "Activar/Desactivar" no para su propia cuenta
                    if (($usuarioActualRol == 1 || $usuarioActualRol == 2) && $record['rut'] != $usuarioActualRut) {
                        $clase_boton = $estado_usuario == 1 ? 'btn-outline-danger' : 'btn-outline-success';
                        $texto_boton = $estado_usuario == 1 ? 'Desactivar' : 'Activar';
                        $opciones .= "<a data-id='{$record['rut']}' data-status='{$estado_usuario}' class='btn btn-sm {$clase_boton} toggle-status'>{$texto_boton}</a> ";
                    }

                    // Botón "Cambiar Rol" solo para Superadministradores
                    if ($usuarioActualRol == 1 && $record['rut'] != $usuarioActualRut) {
                        $opciones .= "<a data-id='{$record['rut']}' data-rol='{$rol_usuario}' class='btn btn-sm btn-outline-primary' data-bs-toggle='modal' data-bs-target='#addUserModal'>Cambiar Rol</a>";
                    }

                    $row['opciones'] = $opciones;
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