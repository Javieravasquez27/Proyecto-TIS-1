<?php 
    include '../../database/conexion.php';

    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }   

        if (isset($_POST['rut']) && isset($_POST['password'])) {

            $rut = stripslashes($_REQUEST['rut']);
            $rut = mysqli_real_escape_string($conexion, $rut);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conexion, $password);

            $sql_usuario = "SELECT * FROM usuario WHERE rut='$rut' and contrasena='" . md5($password) . "'";
            $resultado_usuario = mysqli_query($conexion, $sql_usuario);
            $datos_usuario = mysqli_fetch_assoc($resultado_usuario);

            if ($datos_usuario) {
                if ($datos_usuario['id_estado_usuario'] == 2) {
                    $response = array(
                        'success' => false,
                        'message' => 'Su cuenta está deshabilitada. Por favor, contacte con el administrador.'
                    );
                } else {
                    $rol_usuario = $datos_usuario['id_rol'];
                    $nombre_usuario = $datos_usuario['nombre_usuario'];

                    $sql_rol = "SELECT * FROM rol WHERE nombre_rol = 'cliente'";
                    $resultado_rol = mysqli_query($conexion, $sql_rol);
                    $rol = mysqli_fetch_assoc($resultado_rol);
                    $id_rol = $rol['id_rol'];

                    $_SESSION['rut'] = $rut;
                    $_SESSION['nombre_usuario'] = $nombre_usuario;

                    $response = array(
                        'success' => true,
                        'message' => 'Has iniciado sesión correctamente.',
                        'redirect' => $id_rol === $rol_usuario ? 'index.php?p=home' : 'index.php?p=admin/home'
                    );
                }
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Nombre de usuario o contraseña incorrectos. Por favor, intente de nuevo.'
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