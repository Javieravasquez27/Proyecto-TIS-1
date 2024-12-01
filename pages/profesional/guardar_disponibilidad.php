<?php
    include("../../database/conexion.php");

    session_start();

    try {
        $sql_consulta_usuario = "SELECT rut FROM usuario WHERE rut = '$_SESSION[rut]'";
        $resultado = mysqli_query($conexion, $sql_consulta_usuario);
        $usuario = mysqli_fetch_assoc($resultado);

        $dias_validos = [
            'domingo' => 0,
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6,
        ];

        foreach ($_POST['dia'] as $dia) {
            $dia = strtolower($dia);
            if (!array_key_exists($dia, $dias_validos)) {
                throw new Exception("Día no válido: $dia.");
            }

            if (!isset($_POST['horario'][$dia])) {
                continue;
            }

            $horas = $_POST['horario'][$dia]; // Array of selected hours for the day

            $hoy = (int)(new DateTime())->format('w');
            $proximo_dia = $dias_validos[$dia];

            for ($semana = 0; $semana < 3; $semana++) {
                $fecha = new DateTime();
                $fecha->modify("+$semana week");
                $diferencia_dias = ($proximo_dia - $hoy + 7) % 7;
                $diferencia_dias = $diferencia_dias === 0 ? 7 : $diferencia_dias;
                $fecha->modify("+$diferencia_dias days");

                foreach ($horas as $hora) {
                    $fecha_formateada = $fecha->format("Y-m-d");

                    $sql = "INSERT INTO disponibilidad (rut_profesional, fecha, hora, disponible) 
                            VALUES ('" . $usuario['rut'] . "', '$fecha_formateada', '$hora', TRUE)";
                    if (!$conexion->query($sql)) {
                        throw new Exception("Error al insertar en la base de datos: " . $conexion->error);
                    }
                }
            }
        }

        echo json_encode(['message' => 'Disponibilidad guardada correctamente.']);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(['error' => $e->getMessage()]);
    } finally {
        $conexion->close();
    }

    header('Content-Type: application/json'); // Asegurar el retorno de JSON
?>