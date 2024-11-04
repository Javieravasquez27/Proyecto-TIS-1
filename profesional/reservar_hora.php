<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "sistema_reservas");
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtener fecha y hora de la URL
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];
$cliente_id = 1; // Cambia este valor según el cliente que esté haciendo la reserva

// Marcar la fecha y hora como reservada
$sql = "UPDATE disponibilidad SET cliente_id = '$cliente_id', disponible = FALSE WHERE fecha = '$fecha' AND hora = '$hora' AND disponible = TRUE";
$resultado = $conexion->query($sql);

if ($resultado && $conexion->affected_rows > 0) {
    echo "Reserva realizada exitosamente para el $fecha a las $hora.";
} else {
    echo "Error: No se pudo realizar la reserva. Es posible que la fecha y hora ya estén reservadas.";
}

$conexion->close();
?>
