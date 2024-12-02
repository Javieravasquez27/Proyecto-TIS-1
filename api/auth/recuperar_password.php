<?php
include '../../database/conexion.php';

require_once '../../libs/PHPMailer/src/PHPMailer.php';
require_once '../../libs/PHPMailer/src/SMTP.php';
require_once '../../libs/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$rut = $_POST['rut'];
$rutSinDv = substr($rut, 0, -1);

$rut_consultado = mysqli_real_escape_string($conexion, $rutSinDv);

$query = "SELECT nombre_usuario, correo FROM usuario WHERE rut = '$rut_consultado'";
$resultado = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($resultado);

if ($row) {
    $nombre_usuario = $row['nombre_usuario'];
    $correo = $row['correo'];
    $contrasena = 1234;
    $query = "update usuario set contrasena = '".md5($contrasena)."' where rut = '$rut_consultado'";
    $resultado = mysqli_query($conexion, $query);
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kindomjobs@gmail.com';
        $mail->Password = 'vjgj roxa ypvn qtmo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('kindomjobs@gmail.com', 'kindomjobs');
        $mail->addAddress($correo, $nombre_usuario);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "¡Recuperacion de tu contraseña de KindomJob's!";
            $mail->Body = "Hola $nombre_usuario,<br><br>"
                        . "Tu contraseña de KindomJob's es: <b>$contrasena</b> <br>"
                        . "Esta contraseña se cambio para que puedas acceder, recuerda cambiarla en el perfil de tu cuenta<br><br>"
                        . "Atentamente,<br>"
                        . "El equipo de KindomJob's";

        $mail->send();

        echo "
            <link rel='preconnect' href='https://fonts.googleapis.com'>
	        <link rel='preconnect href='https://fonts.gstatic.com' crossorigin>
	        <link href='https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap' rel='stylesheet'>
            <style>
                .swal2-popup {
                    font-family: 'Josefin Sans';
                }
                .swal2-confirm {
                    font-family: 'Josefin Sans';
                }
            </style>
            <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: '¡Se ha enviado el correo!',
                        showConfirmButton: true,
                        confirmButtonText: 'Aceptar',
                        willClose: () => {
                            window.location.href = '../../index.php';
                        }
                    });
                });
            </script>
        ";


    } catch (Exception $e) {
        echo "
            <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo enviar el correo. Error: {$mail->ErrorInfo}',
                        showConfirmButton: true,
                        confirmButtonText: 'Aceptar',
                        willClose: () => {
                            window.location.href = '../../index.php';
                        }
                    });
                });
            </script>
        ";
    }
} else {
    echo "
        <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El RUT ingresado no existe.',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    willClose: () => {
                        window.location.href = '../../index.php';
                    }
                });
            });
        </script>
    ";
}
?>