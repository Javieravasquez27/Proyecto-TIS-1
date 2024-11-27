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

        // Se verifica si el usuario ya votó
        $sql_consulta_foro_voto_respuesta = "SELECT tipo_voto FROM foro_voto_respuesta WHERE id_respuesta = $id_respuesta AND rut_usuario = '$rut_usuario';";
        $resultado_consulta_foro_voto_respuesta = mysqli_query($conexion, $sql_consulta_foro_voto_respuesta);

        if (mysqli_num_rows($resultado_consulta_foro_voto_respuesta) > 0) {
            $fila = mysqli_fetch_assoc($resultado_consulta_foro_voto_respuesta);

            if ($fila['tipo_voto'] === $tipo_voto) {
                // Se anula el voto si ya existe
                $sql_borrado_foro_voto_respuesta = "DELETE FROM foro_voto_respuesta WHERE id_respuesta = $id_respuesta AND rut_usuario = '$rut_usuario';";
                mysqli_query($conexion, $sql_borrado_foro_voto_respuesta);
            } else {
                // Se cambia el voto
                $sql_actualiza_foro_voto_respuesta = "UPDATE foro_voto_respuesta SET tipo_voto = '$tipo_voto' WHERE id_respuesta = $id_respuesta AND rut_usuario = '$rut_usuario';";
                mysqli_query($conexion, $sql_actualiza_foro_voto_respuesta);
            }
        } else {
            // Se inserta nuevo voto
            $sql_ingreso_foro_voto_respuesta = "INSERT INTO foro_voto_respuesta (id_respuesta, rut_usuario, tipo_voto) VALUES ($id_respuesta, '$rut_usuario', '$tipo_voto');";
            mysqli_query($conexion, $sql_ingreso_foro_voto_respuesta);
        }

        // Se actualiza conteo de votos
        $sql_actualiza_foro_voto_respuesta = "UPDATE foro_respuesta
                                              SET votos_positivos = (SELECT COUNT(*) FROM foro_voto_respuesta WHERE id_respuesta = $id_respuesta AND tipo_voto = 'positivo'),
                                                  votos_negativos = (SELECT COUNT(*) FROM foro_voto_respuesta WHERE id_respuesta = $id_respuesta AND tipo_voto = 'negativo')
                                              WHERE id_respuesta = $id_respuesta;";
        mysqli_query($conexion, $sql_actualiza_foro_voto_respuesta);

        // Se obtienen nuevos valores de votos
        $sql_nuevos_votos = "SELECT votos_positivos, votos_negativos FROM foro_respuesta WHERE id_respuesta = $id_respuesta";
        $resultado_votos = mysqli_query($conexion, $sql_nuevos_votos);
        $votos = mysqli_fetch_assoc($resultado_votos);

        echo json_encode(['success' => true, 'votos' => $votos]);
    }
?>