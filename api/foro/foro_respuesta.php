<?php
    include '../../database/conexion.php';
    include '../../middleware/auth.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_tema = intval($_POST['id_tema']);
        $contenido_respuesta = trim($_POST['contenido_respuesta']);
        $rut_usuario = $_SESSION['rut'];

        // Validar contenido
        if (empty($contenido_respuesta)) {
            echo json_encode(['success' => false, 'mensaje' => 'La respuesta no puede estar vacía']);
            exit();
        }

        // Insertar respuesta en la base de datos
        $sql_insert = "INSERT INTO foro_respuesta (id_tema, contenido_respuesta, rut_usuario, fecha_respuesta) 
                       VALUES ($id_tema, '$contenido_respuesta', '$rut_usuario', NOW())";
        if (mysqli_query($conexion, $sql_insert)) {
            // Obtener los detalles de la respuesta recién insertada
            $id_respuesta = mysqli_insert_id($conexion);

            $sql_respuesta = "SELECT fr.contenido_respuesta, fr.fecha_respuesta, 
                                     fr.votos_positivos, fr.votos_negativos, u.nombres AS nombre_usuario,
                                     r.nombre_rol, u.foto_perfil
                              FROM foro_respuesta fr
                              JOIN usuario u ON fr.rut_usuario = u.rut
                              JOIN rol r ON u.id_rol = r.id_rol
                              WHERE fr.id_respuesta = $id_respuesta";

            $resultado_respuesta = mysqli_query($conexion, $sql_respuesta);
            if ($fila_respuesta = mysqli_fetch_assoc($resultado_respuesta)) {
                $fila_respuesta['fecha_respuesta'] = date('d-m-Y H:i', strtotime($fila_respuesta['fecha_respuesta']));
                echo json_encode(['success' => true, 'respuesta' => $fila_respuesta]);
            } else {
                echo json_encode(['success' => false, 'mensaje' => 'Error al obtener los datos de la respuesta']);
            }
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'Error al guardar la respuesta']);
        }
        exit();
    }
?>