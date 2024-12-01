<?php 
require_once '../../libs/PHPMailer/src/PHPMailer.php';
require_once '../../libs/PHPMailer/src/SMTP.php';
require_once '../../libs/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include '../../database/conexion.php';

try {
    $resultado_usuario = false; // Inicializa la variable para evitar warnings

    if (isset($_POST['rut']) && isset($_POST['nombre_usuario']) && isset($_POST['nombres']) && isset($_POST['apellido_p']) && isset($_POST['apellido_m'])
        && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['password']) && isset($_POST['fecha_nac']) && isset($_POST['direccion'])
        && isset($_POST['comuna']) && isset($_POST['rol'])) {

        // Procesar los datos recibidos
        $rutCompleto = strtoupper($_POST['rut']); 
        $rut = substr($rutCompleto, 0, -1); 
        $digitoVerificador = substr($rutCompleto, -1);

        $rut = mysqli_real_escape_string($conexion, $rut);
        $digitoVerificador = mysqli_real_escape_string($conexion, $digitoVerificador);
        $nombre_usuario = mysqli_real_escape_string($conexion, $_POST['nombre_usuario']);
        $nombres = mysqli_real_escape_string($conexion, $_POST['nombres']);
        $apellido_p = mysqli_real_escape_string($conexion, $_POST['apellido_p']);
        $apellido_m = mysqli_real_escape_string($conexion, $_POST['apellido_m']);
        $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
        $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
        $password = mysqli_real_escape_string($conexion, $_POST['password']);
        $fecha_nac = mysqli_real_escape_string($conexion, $_POST['fecha_nac']);
        $direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
        $comuna = mysqli_real_escape_string($conexion, $_POST['comuna']);
        $rol = mysqli_real_escape_string($conexion, $_POST['rol']);

        // Valida que los datos no estén registrados
        $sql_consulta_rut = "SELECT rut, dv FROM usuario WHERE rut = '$rut' AND dv = '$digitoVerificador'";
        $resultado_consulta_rut = mysqli_query($conexion, $sql_consulta_rut);

        $sql_consulta_nombre_usuario = "SELECT nombre_usuario FROM usuario WHERE nombre_usuario = '$nombre_usuario';";
        $resultado_consulta_nombre_usuario = mysqli_query($conexion, $sql_consulta_nombre_usuario);

        $sql_consulta_correo = "SELECT correo FROM usuario WHERE correo = '$correo';";
        $resultado_consulta_correo = mysqli_query($conexion, $sql_consulta_correo);

        $errores = [];
        if ($resultado_consulta_rut->num_rows > 0) {
            $errores[] = 'El RUT ingresado ya se encuentra registrado.';
        }
        if ($resultado_consulta_nombre_usuario->num_rows > 0) {
            $errores[] = 'El nombre de usuario ingresado ya se encuentra registrado.';
        }
        if ($resultado_consulta_correo->num_rows > 0) {
            $errores[] = 'El correo ingresado ya se encuentra registrado.';
        }

        if (!empty($errores)) {
            $response = [
                'success' => false,
                'message' => implode(' ', $errores)
            ];
            echo json_encode($response);
            exit();
        }

        // Inserta los datos en la base
        $sql_ingreso_usuario = "INSERT INTO usuario (rut, dv, nombre_usuario, nombres, apellido_p, apellido_m, correo, telefono, contrasena, fecha_nac, direccion, id_comuna, id_rol, id_estado_usuario) 
                                VALUES ('$rut', '$digitoVerificador', '$nombre_usuario', '$nombres', '$apellido_p', '$apellido_m', '$correo', '$telefono', '" . md5($password) . "', '$fecha_nac', '$direccion', '$comuna', '$rol', " . ($rol == 3 ? 2 : 1) . ")";
        $resultado_usuario = mysqli_query($conexion, $sql_ingreso_usuario);

        if ($resultado_usuario) {
            // Configuración y envío del correo
            try {
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 0; // Cambiar a 3 para depuración detallada
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

                $mail->setFrom('kindomjobs@gmail.com', 'KindomJobs');
                $mail->addAddress($correo);
                $mail->Subject = '¡Bienvenido a KindomJob\'s!';
                $mail->Body = "Hola $nombre_usuario,\n\n"
                            . "¡Felicidades por ser parte de la comunidad KindomJob's!\n"
                            . "Estamos encantados de tenerte como miembro de nuestra plataforma.\n\n"
                            . "Atentamente,\n"
                            . "El equipo de KindomJob's";
                $mail->send();

                $response = [
                    'success' => true,
                    'message' => 'Registro exitoso. ¡Correo de bienvenida enviado!'
                ];
            } catch (Exception $e) {
                error_log("Error al enviar correo: " . $mail->ErrorInfo);
                $response = [
                    'success' => true,
                    'message' => 'Registro exitoso, pero ocurrió un error al enviar el correo.'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al registrar el usuario en la base de datos.'
            ];
        }
    }
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Error en el servidor: ' . $e->getMessage()
    ];
}

echo json_encode($response);
