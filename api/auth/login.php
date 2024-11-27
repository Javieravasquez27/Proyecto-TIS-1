<?php
    include '../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['rut']) && isset($_POST['password'])) {
            // Se separa el número del RUT y el dígito verificador
            $rutCompleto = strtoupper($_POST['rut']); // Se asegura que el dígito verificador esté en mayúsculas si es K
            $rutSinDv = substr($rutCompleto, 0, -1); // RUT sin digito verificador (ejemplo: 102083237 acá queda 10208323)
            $digitoVerificador = substr($rutCompleto, -1); // Dígito verificador (ejemplo: 102083237 acá queda 7)

            $rutSinDv = mysqli_real_escape_string($conexion, $rutSinDv);
            $digitoVerificador = mysqli_real_escape_string($conexion, $digitoVerificador);
            $password = mysqli_real_escape_string($conexion, $_POST['password']);

            $sql_usuario = "SELECT * FROM usuario 
                            WHERE rut = '$rutSinDv' AND dv = '$digitoVerificador' 
                            AND contrasena = '" . md5($password) . "'";
            $resultado_usuario = mysqli_query($conexion, $sql_usuario);
            $datos_usuario = mysqli_fetch_assoc($resultado_usuario);

            if ($datos_usuario) {
                if ($datos_usuario['id_estado_usuario'] == 2) {
                    $response = array(
                        'success' => false,
                        'message' => 'Su cuenta está deshabilitada. Por favor, contacte con el administrador.'
                    );
                } else {
                    // Se guardan los datos del usuario en la sesión
                    $_SESSION['rut'] = $datos_usuario['rut'];
                    $_SESSION['dv'] = $datos_usuario['dv'];
                    $_SESSION['nombre_usuario'] = $datos_usuario['nombre_usuario'];
                    $_SESSION['nombres'] = $datos_usuario['nombres'];
                    $_SESSION['apellido_p'] = $datos_usuario['apellido_p'];
                    $_SESSION['apellido_m'] = $datos_usuario['apellido_m'];
                    $_SESSION['correo'] = $datos_usuario['correo'];
                    $_SESSION['telefono'] = $datos_usuario['telefono'];
                    $_SESSION['foto_perfil'] = $datos_usuario['foto_perfil'];
                    $_SESSION['fecha_nac'] = $datos_usuario['fecha_nac'];
                    $_SESSION['id_rol'] = $datos_usuario['id_rol'];
                    $_SESSION['id_estado_usuario'] = $datos_usuario['id_estado_usuario'];

                    $response = array(
                        'success' => true,
                        'message' => 'Has iniciado sesión correctamente.',
                        'redirect' => ($datos_usuario['id_rol'] == 1 || $datos_usuario['id_rol'] == 2) ? 'index.php?p=admin/home' : 'index.php?p=home'
                    );
                }
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'RUT o contraseña incorrectos. Por favor, intente de nuevo.'
                );
            }
        } else {
            $response = array(
                'success' => false,
                'message' => 'Error en los datos recibidos.'
            );
        }

    } catch (PDOException $e) {
        $response = array(
            'success' => false,
            'message' => 'Error en el servidor. Por favor, intente de nuevo más tarde.'
        );
    }

    echo json_encode($response);
?>