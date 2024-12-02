<?php
    include '../../database/conexion.php';

    require_once '../../libs/PHPMailer/src/PHPMailer.php';
    require_once '../../libs/PHPMailer/src/SMTP.php';
    require_once '../../libs/PHPMailer/src/Exception.php';

    $rut = $_POST['rut'];


    $rut_consultado = "SELECT rut FROM usuario WHERE rut = $rut";
    $consulta_rut = mysqli_query($conexion,$rut_consultado);
    $row_rut = mysqli_fetch_assoc($consulta_rut);

    $nombre_usuario_consultado = "SELECT nombre_usuario FROM usuario WHERE rut = $rut";
    $consulta_nombre_usuario = mysqli_query($conexion,$nombre_usuario_consultado);
    $row_usuario =  mysqli_fetch_assoc($consulta_nombre_usuario);

    $correo_consultado = "SELECT correo FROM usuario WHERE rut = $rut";
    $consulta_correo = mysqli_query($conexion, $correo_consultado);
    $row_correo = mysqli_fetch_assoc($consulta_correo);

    $password_consultado = "SELECT contrasena FROM usuario WHERE rut = $rut";
    $consulta_contraseña = mysqli_query($conexion, $password_consultado);
    $row_contraseña = mysqli_fetch_assoc($consulta_contraseña);


    $rut_consultado = mysqli_real_escape_string($conexion, $rut);

    if (!empty($row_rut)) {
        
        echo "
            <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            //modal
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Exito!',
                    text: '¡Se ha enviado el correo!',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                    willClose: () => {
                    window.location.href = '../../index.php';
                }
                });
            </script>
        ";
        
    

        // Configuración y envío de correo
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
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
            $mail->addAddress($row_correo);
            $mail->Subject = '¡Recuperacion de tu contraseña de KindomJob\'s!';
            $mail->Body = "Hola $row_usuario,\n\n"
                        . "¡Tu contraseña de KindomJob's es:!\n"
                        . "$row_contraseña"
                        . "Recuerda que puedes cambiar tu contraseña desde el perfil de tu cuenta.\n\n"
                        . "Atentamente,\n"
                        . "El equipo de KindomJob's";
            $mail->send();
        } catch (Exception $e) {
            $response['message'] .= ' Sin embargo, no se pudo enviar el correo de confirmación.';
        }


    }
    else {
        
       

    }






    

?>