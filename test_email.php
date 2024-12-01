<?php
require_once './libs/PHPMailer/src/PHPMailer.php';
require_once './libs/PHPMailer/src/SMTP.php';
require_once './libs/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2; // Habilita la depuración
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'kindomjobs@gmail.com';
    $mail->Password = 'vjgj roxa ypvn qtmo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ),
    );

    $mail->setFrom('kindomjobs@gmail.com', 'Test Mail');
    $mail->addAddress('rodri.ramirez.2806@gmail.com');
    $mail->Subject = 'Prueba de Envío';
    $mail->Body = 'Este es un correo de prueba para verificar PHPMailer.';

    $mail->send();
    echo "Correo enviado exitosamente.";
} catch (Exception $e) {
    echo "Error al enviar correo: " . $mail->ErrorInfo;
}
