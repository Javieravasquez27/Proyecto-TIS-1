<?php
    include '../../database/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_tema = intval($_POST['id_tema']);
        $nuevo_estado_ft = $_POST['estado'] === 'cerrar' ? 'cerrado' : 'abierto';

        $sql_actualiza_estado_ft = "UPDATE foro_tema SET estado_tema = '$nuevo_estado_ft' WHERE id_tema = $id_tema";
        if (mysqli_query($conexion, $sql_actualiza_estado_ft)) {
            echo json_encode(['success' => true, 'mensaje' => 'Estado del tema actualizado']);
        } else {
            echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar el estado']);
        }
        exit();
    }
?>