<?php
    include '../../database/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_respuesta = intval($_POST['id_respuesta']);
        $id_tema = intval($_POST['id_tema']);

        // Primero, desmarcar cualquier otra "mejor respuesta" para este tema
        $sql_desmarcar = "UPDATE foro_respuesta SET mejor_respuesta = 0 WHERE id_tema = $id_tema";
        mysqli_query($conexion, $sql_desmarcar);

        // Luego, marcar la nueva mejor respuesta
        $sql_marcar = "UPDATE foro_respuesta SET mejor_respuesta = 1 WHERE id_respuesta = $id_respuesta";
        if (mysqli_query($conexion, $sql_marcar)) {
            echo json_encode(['success' => true, 'mensaje' => 'Respuesta marcada como la mejor']);
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'Error al marcar la respuesta como mejor']);
        }
        exit();
    }
?>