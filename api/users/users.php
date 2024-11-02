<?php
include '../../database/connection.php';

try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $sql = "SELECT u.rut, u.nombre_usuario, u.nombres, u.apellido_p, u.apellido_m, u.correo, u.telefono, u.fecha_nac,
                   u.direccion, c.nombre_comuna AS comuna, r.nombre_rol AS rol, u.id_comuna, u.id_rol
            FROM usuario u LEFT JOIN comuna c ON u.id_comuna = c.id_comuna
                           LEFT JOIN rol r ON u.id_rol = r.id_rol";
    $resultado = mysqli_query($connection, $sql);

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
                $row['options'] = "<a id='delete' data-id=".$record['rut']." class='btn btn-sm btn-outline-danger' >Eliminar</a>";

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
