<?php 
    include '../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Consulta para obtener servicios y sus profesiones asociadas
        $sql_consulta_profesion_servicio = "
            SELECT s.id_servicio, s.nombre_servicio AS servicio, GROUP_CONCAT(p.nombre_profesion SEPARATOR '<br>') AS profesiones
            FROM servicio s
            LEFT JOIN servicio_profesion sp ON s.id_servicio = sp.id_servicio
            LEFT JOIN profesion p ON sp.id_profesion = p.id_profesion
            GROUP BY s.id_servicio;";

        $resultado = mysqli_query($conexion, $sql_consulta_profesion_servicio);

        // Consulta para obtener todos los profesiones
        $sql_consulta_profesiones = "SELECT id_profesion, nombre_profesion FROM profesion;";
        $resultado_profesiones = mysqli_query($conexion, $sql_consulta_profesiones);

        $todos_profesiones = [];
        while ($profesion = mysqli_fetch_assoc($resultado_profesiones)) {
            $todos_profesiones[] = $profesion;
        }

        if ($resultado) {
            $servicios = [];

            while ($registro = $resultado->fetch_assoc()) {
                $servicios[] = [
                    'id_servicio' => $registro['id_servicio'],
                    'servicio' => $registro['servicio'],
                    'profesiones' => $registro['profesiones']
                ];
            }

            $response = [
                'success' => true,
                'servicios' => $servicios,
                'profesiones' => $todos_profesiones
            ];

        } else {
            $response = [
                'success' => false,
                'message' => 'Error al obtener las profesiones y servicios. Intente de nuevo'
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