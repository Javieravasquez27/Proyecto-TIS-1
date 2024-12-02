<?php
    include '../../database/conexion.php';
    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['rut'])) {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado.']);
        exit;
    }

    $dias_validos = [
        'lunes' => 1,
        'martes' => 2,
        'miércoles' => 3,
        'jueves' => 4,
        'viernes' => 5,
        'sábado' => 6,
        'domingo' => 0,
    ];

    try {
        foreach ($dias_validos as $dia_nombre => $dia_index) {
            $horarios_dia = $_POST['horario_' . $dia_nombre] ?? []; // Se obtienen los horarios para el día actual

            foreach ($horarios_dia as $hora) {
                $fecha = new DateTime();
                $hoy = (int)$fecha->format('w'); // Día actual de la semana (0 = domingo, 6 = sábado)
                $diferencia_dias = ($dia_index - $hoy + 7) % 7; // Se calcula la diferencia en días
                $fecha->modify("+$diferencia_dias days");

                for ($semana = 0; $semana < 3; $semana++) { // Se repite para las próximas 3 semanas
                    $fecha_formateada = $fecha->format('Y-m-d');

                    $sql_inserta_disponibilidad = "INSERT INTO disponibilidad (rut_profesional, fecha, hora, disponible)
                            VALUES ('" . $conexion->real_escape_string($_SESSION['rut']) . "', '$fecha_formateada', '$hora', TRUE)";

                    if (!$conexion->query($sql_inserta_disponibilidad)) {
                        throw new Exception("Error al guardar disponibilidad: " . $conexion->error);
                    }

                    $fecha->modify('+7 days'); // Se avanza una semana
                }
            }
        }

        echo json_encode(['status' => 'success', 'message' => 'Disponibilidad guardada correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
?>