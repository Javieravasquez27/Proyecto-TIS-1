<?php 
    include '../../database/conexion.php';
    require_once '../../libs/PHPMailer/src/PHPMailer.php';
    require_once '../../libs/PHPMailer/src/SMTP.php';
    require_once '../../libs/PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    try {
        if (isset($_POST['rut']) && isset($_POST['nombre_usuario']) && isset($_POST['nombres']) && isset($_POST['apellido_p']) && isset($_POST['apellido_m'])
            && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['password']) && isset($_POST['fecha_nac']) && isset($_POST['direccion'])
            && isset($_POST['latitud']) && isset($_POST['longitud']) && isset($_POST['comuna']) && isset($_POST['rol'])) {

            // Se separa el número del RUT y el dígito verificador
            $rutCompleto = strtoupper($_POST['rut']); // Se asegura que el dígito verificador esté en mayúsculas si es K
            $rut = substr($rutCompleto, 0, -1); // RUT sin digito verificador (ejemplo: 102083237 acá queda 10208323)
            $digitoVerificador = substr($rutCompleto, -1); // Dígito verificador (ejemplo: 102083237 acá queda 7)

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
            $latitud = mysqli_real_escape_string($conexion, $_POST['latitud']);
            $longitud = mysqli_real_escape_string($conexion, $_POST['longitud']);
            $comuna = mysqli_real_escape_string($conexion, $_POST['comuna']);
            $rol = mysqli_real_escape_string($conexion, $_POST['rol']);

            // Se valida que RUT, nombre de usuario y correo no se encuentren ya registrados
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
            } else {
                // Se procesa la foto de perfil si el rol es Profesional (id_rol = 3)
                $foto_perfil = null;
                if ($rol == 3 && isset($_FILES['foto_perfil'])) {
                    $directorio_foto_perfil = "uploads/foto_perfil/";
                    $localizacion_foto_perfil_relativa = "../../" . $directorio_foto_perfil . basename($_FILES["foto_perfil"]["name"]); // Ruta donde se carga la foto
                    $localizacion_foto_perfil = $directorio_foto_perfil . basename($_FILES["foto_perfil"]["name"]); // Ruta que se guarda en la base de datos
                    $subida_correcta_fp = 1;
                    $extension_fp = strtolower(pathinfo($localizacion_foto_perfil, PATHINFO_EXTENSION));

                    // Se verifica si el archivo es una imagen
                    $verificar_fp = getimagesize($_FILES["foto_perfil"]["tmp_name"]);
                    if ($verificar_fp !== false) {
                        $subida_correcta_fp = 1;
                    } else {
                        $subida_correcta_fp = 0;
                    }

                    // Se intenta cargar el archivo
                    if ($subida_correcta_fp == 1 && move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $localizacion_foto_perfil_relativa)) {
                        $foto_perfil = mysqli_real_escape_string($conexion, $localizacion_foto_perfil);
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => 'Error al cargar la foto de perfil'
                        );
                        echo json_encode($response);
                        exit();
                    }
                }

                if (empty($latitud) || empty($longitud)) {
                    echo json_encode(['success' => false, 'message' => 'Latitud o longitud no proporcionadas.']);
                    exit;
                }

                if ($foto_perfil !== null)
                {
                    $sql_ingreso_usuario = "INSERT INTO usuario (rut, dv, nombre_usuario, nombres, apellido_p, apellido_m, correo, telefono, contrasena, fecha_nac, direccion, latitud, longitud, foto_perfil, id_comuna, id_rol, id_estado_usuario) 
                                        VALUES ('$rut', '$digitoVerificador', '$nombre_usuario', '$nombres', '$apellido_p', '$apellido_m', '$correo', '$telefono', '" . md5($password) . "', '$fecha_nac', '$direccion', '$latitud', '$longitud', '$foto_perfil', '$comuna', '$rol', " . ($rol == 3 ? 2 : 1) . ")";
                    $resultado_usuario = mysqli_query($conexion, $sql_ingreso_usuario);
                }
                else
                {
                    $sql_ingreso_usuario = "INSERT INTO usuario (rut, dv, nombre_usuario, nombres, apellido_p, apellido_m, correo, telefono, contrasena, fecha_nac, direccion, latitud, longitud, id_comuna, id_rol, id_estado_usuario) 
                                        VALUES ('$rut', '$digitoVerificador', '$nombre_usuario', '$nombres', '$apellido_p', '$apellido_m', '$correo', '$telefono', '" . md5($password) . "', '$fecha_nac', '$direccion', '$latitud', '$longitud', '$comuna', '$rol', " . ($rol == 3 ? 2 : 1) . ")";
                    $resultado_usuario = mysqli_query($conexion, $sql_ingreso_usuario);
                }

                if ($rol == 3) {
                    // Se insertan datos adicionales de profesional
                    $id_profesion = mysqli_real_escape_string($conexion, $_POST['profesion']);
                    $id_institucion = mysqli_real_escape_string($conexion, $_POST['institucion']);
                    $experiencia = mysqli_real_escape_string($conexion, $_POST['experiencia']);
                    $titulo_profesional = null;

                    if (isset($_FILES['titulo_profesional'])) {
                        $directorio_titulo_profesional = "../../uploads/titulo_profesional/";
                        $localizacion_titulo_profesional = $directorio_titulo_profesional . basename($_FILES["titulo_profesional"]["name"]);
                        if (move_uploaded_file($_FILES["titulo_profesional"]["tmp_name"], $localizacion_titulo_profesional)) {
                            $titulo_profesional = mysqli_real_escape_string($conexion, $localizacion_titulo_profesional);
                        }
                    }

                    $sql_ingreso_profesional = "INSERT INTO profesional (rut, id_profesion, id_institucion, experiencia, titulo_profesional) 
                                                VALUES ('$rut', '$id_profesion', '$id_institucion', '$experiencia', '$titulo_profesional')";
                    mysqli_query($conexion, $sql_ingreso_profesional);
                }

                $response = array(
                    'success' => true,
                    'message' => $rol == 3 ? 'Hemos recibido su solicitud de registro como profesional y será revisada.' : 'Registro exitoso'
                );
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
                    $mail->addAddress($correo);
                    $mail->Subject = '¡Bienvenido a KindomJob\'s!';
                    $mail->Body = "Hola $nombre_usuario,\n\n"
                                . "¡Felicidades por ser parte de la comunidad KindomJob's!\n"
                                . "Estamos encantados de tenerte como miembro de nuestra plataforma.\n\n"
                                . "Atentamente,\n"
                                . "El equipo de KindomJob's";
                    $mail->send();
                } catch (Exception $e) {
                    $response['message'] .= ' Sin embargo, no se pudo enviar el correo de confirmación.';
                }
            }
        } else {
            $response = array(
                'success' => false,
                'message' => 'Error en los datos recibidos'
            );
        }

    } catch (PDOException $e) {
        $response = array(
            'success' => false,
            'message' => 'Error en el servidor. Intente de nuevo más tarde'
        );
    }

    echo json_encode($response);
?>