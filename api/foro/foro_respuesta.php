<?php
    include '../../database/conexion.php';
    include '../../middleware/auth.php';
    
    // **1. Manejo de POST: Para agregar nueva respuesta**
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_tema = intval($_POST['id_tema']);
        $contenido_respuesta = trim($_POST['contenido_respuesta']);
        $rut_usuario = $_SESSION['rut'];
    
        // Se valida contenido
        if (empty($contenido_respuesta)) {
            echo json_encode(['success' => false, 'mensaje' => 'La respuesta no puede estar vacía']);
            exit();
        }
    
        // Se inserta respuesta en la base de datos
        $sql_insercion_foro_respuesta = "INSERT INTO foro_respuesta (id_tema, contenido_respuesta, rut_usuario, fecha_respuesta) 
                                         VALUES ($id_tema, '$contenido_respuesta', '$rut_usuario', NOW());";
        if (mysqli_query($conexion, $sql_insercion_foro_respuesta)) {
            // Se obtienen los detalles de la respuesta recién insertada
            $id_respuesta = mysqli_insert_id($conexion);
        
            $sql_consulta_foro_respuesta_1 = "SELECT fr.contenido_respuesta, fr.fecha_respuesta, 
                                                     fr.votos_positivos, fr.votos_negativos, u.nombres,
                                                     r.nombre_rol, u.foto_perfil
                                              FROM foro_respuesta fr
                                              JOIN usuario u ON fr.rut_usuario = u.rut
                                              JOIN rol r ON u.id_rol = r.id_rol
                                              WHERE fr.id_respuesta = $id_respuesta;";
    
            $resultado_consulta_foro_respuesta_1 = mysqli_query($conexion, $sql_consulta_foro_respuesta_1);
            if ($fila_foro_respuesta_1 = mysqli_fetch_assoc($resultado_consulta_foro_respuesta_1)) {
                $fila_foro_respuesta_1['fecha_respuesta'] = date('d-m-Y H:i', strtotime($fila_foro_respuesta_1['fecha_respuesta']));
                echo json_encode(['success' => true, 'respuesta' => $fila_foro_respuesta_1]);
            } else {
                echo json_encode(['success' => false, 'mensaje' => 'Error al obtener los datos de la respuesta']);
            }
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'Error al guardar la respuesta']);
        }
        exit();
    }
    
    // **2. Manejo de GET: Para cargar respuestas existentes con paginación**
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id_tema = intval($_GET['id_tema']);
        $offset = intval($_GET['offset'] ?? 0);
        $limit = intval($_GET['limit'] ?? 10);
    
        // Se valida id_tema
        if ($id_tema <= 0) {
            echo json_encode(['success' => false, 'mensaje' => 'ID de tema no válido']);
            exit();
        }
    
        // Se consultan respuestas con paginación
        $sql_consulta_foro_respuesta_2 = "SELECT fr.id_respuesta, fr.contenido_respuesta, fr.fecha_respuesta, 
                                                 fr.mejor_respuesta, fr.votos_positivos, fr.votos_negativos,
                                                 u.nombres, u.foto_perfil, r.nombre_rol
                                          FROM foro_respuesta fr
                                          JOIN usuario u ON fr.rut_usuario = u.rut
                                          JOIN rol r ON u.id_rol = r.id_rol
                                          WHERE fr.id_tema = $id_tema
                                          ORDER BY fr.votos_positivos DESC, fr.fecha_respuesta ASC
                                          LIMIT $offset, $limit;";
        $resultado_consulta_foro_respuesta_2 = mysqli_query($conexion, $sql_consulta_foro_respuesta_2);
    
        if (!$resultado_consulta_foro_respuesta_2) {
            echo json_encode(['success' => false, 'mensaje' => 'Error al obtener respuestas']);
            exit();
        }
    
        $foro_respuesta = [];
        while ($fila_foro_respuesta_2 = mysqli_fetch_assoc($resultado_consulta_foro_respuesta_2)) {
            $fila_foro_respuesta_2['fecha_respuesta'] = date('d-m-Y H:i', strtotime($fila_foro_respuesta_2['fecha_respuesta']));
            $foro_respuesta[] = $fila_foro_respuesta_2;
        }
    
        echo json_encode(['success' => true, 'respuestas' => $foro_respuesta]);
        exit();
    }

    echo json_encode(['success' => false, 'mensaje' => 'Método no soportado']);
?>