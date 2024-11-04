<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "kindomjobs");
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];

    // Consulta para obtener las horas disponibles en la fecha seleccionada
    $query = "SELECT hora FROM disponibilidad WHERE fecha = ? AND disponible = TRUE";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Generar HTML con las horas disponibles
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            if (isset($_SESSION['rut'])) {
                echo "<button type='sumbit' class='btn btn-time' name='hora' data-bs-toggle='modal' data-bs-target='#exampleModal' value='". date("H:i", strtotime($fila['hora'])) ."'>" . date("H:i", strtotime($fila['hora'])) . "</button>";
            }else{
                echo "<button type='sumbit' class='btn btn-time' name='hora' data-bs-toggle='modal' data-bs-target='#exampleModal' value='". date("H:i", strtotime($fila['hora'])) ."' disabled>" . date("H:i", strtotime($fila['hora'])) . "</button>";
            }
        }
    } else {
        echo "<li>No hay horas disponibles para esta fecha.</li>";
    }

    $stmt->close();
}

$conexion->close();
?>
