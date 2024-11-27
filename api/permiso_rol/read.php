<?php 
    include '../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Consulta para obtener roles y sus permisos asociados
        $sql_consulta_permiso_rol = "
            SELECT r.id_rol, r.nombre_rol AS rol, GROUP_CONCAT(p.nombre_permiso SEPARATOR '<br>') AS permisos
            FROM rol r
            LEFT JOIN permiso_rol pr ON r.id_rol = pr.id_rol
            LEFT JOIN permiso p ON pr.id_permiso = p.id_permiso
            GROUP BY r.id_rol;";

        $resultado = mysqli_query($conexion, $sql_consulta_permiso_rol);

        // Consulta para obtener todos los permisos
        $sql_consulta_permisos = "SELECT id_permiso, nombre_permiso FROM permiso;";
        $resultado_permisos = mysqli_query($conexion, $sql_consulta_permisos);

        $todos_permisos = [];
        while ($permiso = mysqli_fetch_assoc($resultado_permisos)) {
            $todos_permisos[] = $permiso;
        }

        if ($resultado) {
            $roles = [];

            while ($registro = $resultado->fetch_assoc()) {
                $roles[] = [
                    'id_rol' => $registro['id_rol'],
                    'rol' => $registro['rol'],
                    'permisos' => $registro['permisos']
                ];
            }

            $response = [
                'success' => true,
                'roles' => $roles,
                'permisos' => $todos_permisos
            ];

        } else {
            $response = [
                'success' => false,
                'message' => 'Error al obtener los permisos y roles. Intente de nuevo'
            ];
        }
    } catch (Exception $e) {
        $response = [
            'success' => false,
            'message' => 'Error en el servidor. Intente de nuevo más tarde'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>