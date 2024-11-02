<?php
include '../../database/connection.php';

try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }   

    if (isset($_POST['rut']) && isset($_POST['password'])) {

        $rut = stripslashes($_REQUEST['rut']);
        $rut = mysqli_real_escape_string($connection, $rut);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($connection, $password);

        $sql_usuario = "SELECT * FROM usuario WHERE rut='$rut' and contrasena='" . md5($password) . "'";

        $resultado_usuario = mysqli_query($connection, $sql_usuario);

        $usuario = mysqli_num_rows($resultado_usuario);

        if ($usuario == 1) {

            $datos_usuario = mysqli_fetch_assoc($resultado_usuario);
            $rol_usuario = $datos_usuario['id_rol'];

            if ($datos_usuario['id_rol'])

            $sql_rol = "SELECT * FROM rol WHERE nombre_rol = 'cliente'";
            $resultado_rol = mysqli_query($connection, $sql_rol);
            $rol = mysqli_fetch_assoc($resultado_rol);
            $id_rol = $rol['id_rol'];

            $_SESSION['rut'] = $rut;

            $response = array(
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'redirect' => $id_rol === $rol_usuario ? 'index.php?p=home' : 'index.php?p=admin/home'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Nombre de usuario o contraseña incorrectos. Intente de nuevo.'
            );
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
        'message' => 'Error en el servidor. Intente de nuevo más tarde.'
    );

}

echo json_encode($response);
