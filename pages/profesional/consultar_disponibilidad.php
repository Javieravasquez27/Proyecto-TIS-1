<?php
    include '../../database/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha = $_POST['fecha'];
            $rut_prof = $_POST['rut'];

            // Se realiza consulta para obtener las horas disponibles en la fecha seleccionada
            $consulta_disponibilidad = "SELECT hora FROM disponibilidad
                                        WHERE fecha = ? AND disponible = 1 AND rut_profesional = '$rut_prof';";
            $stmt = $conexion->prepare($consulta_disponibilidad);
            $stmt->bind_param("s", $fecha);
            $stmt->execute();
            $resultado = $stmt->get_result();

            // Se generan botones con las horas disponibles
            if ($resultado->num_rows > 0)
            {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<button class='btn btn-time' name='hora' value='" . date("H:i", strtotime($fila['hora'])) . "'>" . date("H:i", strtotime($fila['hora'])) . "</button>";
                }
            } else {
                echo "<li>No hay horas disponibles para esta fecha.</li>";
            }

            $stmt->close();
        }

    $conexion->close();
?>