<?php
    include 'vendor/autoload.php';
    use Transbank\Webpay\WebpayPlus\Transaction;
    
    try {
        // Crear una instancia de la clase Transaction
        $transaction = new Transaction();
    
        // Variables de configuración
        $buy_order = uniqid();
        $sessionid = session_id();
        $amount = $_POST['monto_total']; // Monto de la transacción
        $returnUrl = "http://localhost/xampp/kindomjobs/index.php?p=profesional/webpay_return"; // URL de retorno después del pago
    
        // Guardar los datos en la sesión
        $_SESSION['rut_prof'] = $_POST['rut_prof'];
        $_SESSION['nombre_profesional'] = $_POST['nombre_profesional'];
        $_SESSION['nombre_servicio'] = $_POST['nombre_servicio'];
        $_SESSION['fecha_cita'] = $_POST['fecha_cita'];
        $_SESSION['hora_cita'] = $_POST['hora_cita'];
    
        // Generar la transacción
        $response = $transaction->create($buy_order, $sessionid, $amount, $returnUrl);
    
        // Obtener la URL y el token desde la respuesta
        $url_tbk = $response->getUrl(); 
        $token = $response->getToken();
    
        // Redirigir automáticamente mediante un formulario HTML
        echo '
        <form action="' . $url_tbk . '" method="POST" id="webpay-form">
            <input type="hidden" name="token_ws" value="' . $token . '">
        </form>
        <script>
            document.getElementById("webpay-form").submit(); // Enviar el formulario automáticamente
        </script>';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>