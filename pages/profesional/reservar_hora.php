<?php
    include 'database/conexion.php';

    // Obtener fecha y hora de la URL
    $fecha = $_GET['fecha'];
    $hora = $_GET['hora'];
    $rut_cliente = 1; // Cambia este valor según el cliente que esté haciendo la reserva

    // Marcar la fecha y hora como reservada
    $sql_actualiza_disponibilidad = "UPDATE disponibilidad SET rut_cliente = '$rut_cliente', disponible = FALSE
            WHERE fecha = '$fecha' AND hora = '$hora' AND disponible = TRUE";
    $resultado = $conexion->query($sql_actualiza_disponibilidad);

    if ($resultado && $conexion->affected_rows > 0) {
        echo "Reserva realizada exitosamente para el $fecha a las $hora.";
    } else {
        echo "Error: No se pudo realizar la reserva. Es posible que la fecha y hora ya estén reservadas.";
    }

    $conexion->close();
?>