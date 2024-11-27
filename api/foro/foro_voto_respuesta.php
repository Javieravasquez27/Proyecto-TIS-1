<?php
    include '../../database/conexion.php';
    include '../../middleware/auth.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_respuesta = intval($_POST['id_respuesta']);
        $tipo_voto = $_POST['tipo_voto'];
        $rut_usuario = $_SESSION['rut'];

        if (!in_array($tipo_voto, ['positivo', 'negativo'])) {
            echo json_encode(['success' => false, 'mensaje' => 'Voto inválido.']);
            exit;
        }

        // Verificar si el usuario ya votó
        $sql_verificar_voto = "SELECT tipo_voto FROM foro_voto_respuesta WHERE id_respuesta = $id_respuesta AND rut_usuario = '$rut_usuario'";
        $resultado = mysqli_query($conexion, $sql_verificar_voto);

        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);

            if ($fila['tipo_voto'] === $tipo_voto) {
                // Anular voto si ya existe
                $sql_anular_voto = "DELETE FROM foro_voto_respuesta WHERE id_respuesta = $id_respuesta AND rut_usuario = '$rut_usuario'";
                mysqli_query($conexion, $sql_anular_voto);
            } else {
                // Cambiar el voto
                $sql_cambiar_voto = "UPDATE foro_voto_respuesta SET tipo_voto = '$tipo_voto' WHERE id_respuesta = $id_respuesta AND rut_usuario = '$rut_usuario'";
                mysqli_query($conexion, $sql_cambiar_voto);
            }
        } else {
            // Insertar nuevo voto
            $sql_insertar_voto = "INSERT INTO foro_voto_respuesta (id_respuesta, rut_usuario, tipo_voto) VALUES ($id_respuesta, '$rut_usuario', '$tipo_voto')";
            mysqli_query($conexion, $sql_insertar_voto);
        }

        // Actualizar conteo de votos
        $sql_actualizar_conteo = "
            UPDATE foro_respuesta
            SET votos_positivos = (SELECT COUNT(*) FROM foro_voto_respuesta WHERE id_respuesta = $id_respuesta AND tipo_voto = 'positivo'),
                votos_negativos = (SELECT COUNT(*) FROM foro_voto_respuesta WHERE id_respuesta = $id_respuesta AND tipo_voto = 'negativo')
            WHERE id_respuesta = $id_respuesta";
        mysqli_query($conexion, $sql_actualizar_conteo);

        // Obtener nuevos valores de votos
        $sql_nuevos_votos = "SELECT votos_positivos, votos_negativos FROM foro_respuesta WHERE id_respuesta = $id_respuesta";
        $resultado_votos = mysqli_query($conexion, $sql_nuevos_votos);
        $votos = mysqli_fetch_assoc($resultado_votos);

        echo json_encode(['success' => true, 'votos' => $votos]);
    }
?>