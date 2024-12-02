<?php
include 'vendor/autoload.php';
include 'database/conexion.php';
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

try {
    // Configuración de Webpay para el entorno de pruebas
    WebpayPlus::configureForTesting();

    $tokenWs = $_GET['token_ws'];
    $transaction = new Transaction();
    $result = $transaction->commit($tokenWs);

    if ($result->isApproved()) {
        // Pago exitoso
        $buyOrder = $result->getBuyOrder();
        $amount = $result->getAmount();
        $authorizationCode = $result->getAuthorizationCode();

        // Recuperar la información del pago desde la sesión
        $rut_prof = $_SESSION['rut_prof'];
        $nombre_profesional = $_SESSION['nombre_profesional'];
        $nombre_servicio = $_SESSION['nombre_servicio'];
        $fecha_cita = $_SESSION['fecha_cita'];
        $hora_cita = $_SESSION['hora_cita'];
        $lugar_atencion = $_SESSION['lugar_atencion'];

        $sql = "UPDATE disponibilidad 
                SET disponible = 0, rut_cliente = '$_SESSION[rut]'
                WHERE rut_profesional = '$rut_prof' AND fecha = '$fecha_cita' AND hora = '$hora_cita';";
        if (mysqli_query($conexion, $sql)) {
            // Redirige al usuario a la URL final con todos los datos necesarios
            header("Location: index.php?p=profesional/webpay_final&status=success&buyOrder=$buyOrder&amount=$amount&token=$tokenWs&rut_prof=$rut_prof&nombre_profesional=$nombre_profesional&nombre_servicio=$nombre_servicio&fecha_cita=$fecha_cita&hora_cita=$hora_cita&lugar_atencion=$lugar_atencion&token=$tokenWs");
        } else {
            echo "Error al guardar la cita: " . mysqli_error($conexion);
        }
    } else {
        echo "Error en el pago: " . $result->getResponseCode();
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>