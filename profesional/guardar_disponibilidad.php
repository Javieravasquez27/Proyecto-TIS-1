<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "kindomjobs");
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
session_start();
$query = "SELECT nombre_usuario FROM usuario WHERE rut = '$_SESSION[rut]'";
$resultado = mysqli_query($conexion, $query);
$user = mysqli_fetch_assoc($resultado);

// Mapear los días de la semana válidos
$dias_validos = [
    'domingo' => 0,
    'lunes' => 1,
    'martes' => 2,
    'miércoles' => 3,
    'jueves' => 4,
    'viernes' => 5,
    'sábado' => 6,
];

// Obtener datos del formulario
for ($i = 0; $i < count($_POST['dia']); $i++) {
    $dia = strtolower($_POST['dia'][$i]); // Esto debe ser un día de la semana en español
    $hora_inicio = $_POST['hora_inicio'][$i];
    $hora_fin = $_POST['hora_fin'][$i];// Cambia este valor según el profesional

    // Validar el día
    if (!array_key_exists($dia, $dias_validos)) {
        die("Día no válido. Debe ser uno de los siguientes: " . implode(", ", array_keys($dias_validos)));
    }

    // Calcular el día actual
    $hoy = (int)(new DateTime())->format('w'); // Obtiene el día actual de la semana (0-6)
    $proximo_dia = $dias_validos[$dia];

    // Bucle para las próximas 3 semanas
    for ($semana = 0; $semana < 3; $semana++) {
        // Reiniciar el rango de horas al inicio de cada semana
        $inicio_hora = strtotime($hora_inicio);
        $fin_hora = strtotime($hora_fin);

        // Calcular la fecha del próximo día de la semana deseado
        $fecha = new DateTime();
        $fecha->modify("+$semana week");
        $diferencia_dias = ($proximo_dia - $hoy + 7) % 7;

        if ($diferencia_dias === 0) {
            $diferencia_dias = 7; // Avanzar a la siguiente semana si es el mismo día
        }

        $fecha->modify("+$diferencia_dias days");

        // Insertar cada hora en el rango de horas
        while ($inicio_hora < $fin_hora) {
            $hora_actual = date("H:i:s", $inicio_hora);
            $fecha_formateada = $fecha->format("Y-m-d");

            // Insertar la hora en la base de datos
            $sql = "INSERT INTO disponibilidad (nombre_usuario, fecha, hora, disponible) 
                    VALUES ('" . $user['nombre_usuario'] . "', '$fecha_formateada', '$hora_actual', TRUE)";
            if (!$conexion->query($sql)) {
                echo "Error al insertar en la base de datos: " . $conexion->error;
            }

            // Incrementar la hora en 1 hora
            $inicio_hora = strtotime('+1 hour', $inicio_hora);
        }
    }
}
echo "Disponibilidad guardada correctamente.";
header('location: perfil.php');
$conexion->close();
?>
