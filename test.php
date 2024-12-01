<?php
require_once './libs/PHPMailer/src/PHPMailer.php';
require_once './libs/PHPMailer/src/SMTP.php';
require_once './libs/PHPMailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);
    echo "PHPMailer cargado correctamente.";
} catch (Exception $e) {
    echo "Error al cargar PHPMailer: " . $e->getMessage();
}