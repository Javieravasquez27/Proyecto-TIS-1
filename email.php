<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar autoload de Composer
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.ejemplo.com'; // Servidor SMTP (por ejemplo, Gmail, SendGrid)
    $mail->SMTPAuth = true;
    $mail->Username = 'tu_usuario@ejemplo.com'; // Usuario SMTP
    $mail->Password = 'tu_contraseña'; // Contraseña SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // Puerto SMTP

    // Remitente y destinatario
    $mail->setFrom('notificaciones@tuplataforma.com', 'Tu Plataforma');
    $mail->addAddress('destinatario@ejemplo.com', 'Nombre Cliente'); // Dirección del cliente

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Confirmación de cita y pago recibido';
    
    // Asumiendo que las variables $nombreCliente, $profesional, $fecha, $hora son obtenidas del sistema
    $nombreCliente = 'Juan Pérez';  // Esto debe venir de la base de datos
    $profesional = 'Dr. Pedro Pérez';  // Nombre del profesional
    $fecha = '2024-12-15';  // Fecha de la cita
    $hora = '10:00 AM';  // Hora de la cita
    
    $mail->Body    = "
        <p>Hola $nombreCliente,</p>
        <p>Gracias por agendar tu cita con $profesional. A continuación, te confirmamos los detalles de tu cita:</p>
        <ul>
            <li><b>Fecha:</b> $fecha</li>
            <li><b>Hora:</b> $hora</li>
            <li><b>Profesional:</b> $profesional</li>
        </ul>
        <p>¡Esperamos verte pronto!</p>
        <p>Gracias por confiar en nuestra plataforma.</p>
    ";

    // Enviar correo
    $mail->send();
    echo 'Correo de confirmación enviado.';
} catch (Exception $e) {
    echo "Hubo un error al enviar el correo. Error: {$mail->ErrorInfo}";
}
?>
