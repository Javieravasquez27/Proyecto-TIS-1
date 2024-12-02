<?php
require_once './libs/PHPMailer/src/PHPMailer.php';
require_once './libs/PHPMailer/src/SMTP.php';
require_once './libs/PHPMailer/src/Exception.php';

// Conectar con la base de datos
require_once '../../database/conexion.php'; // Ajusta la ruta según tu proyecto

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

