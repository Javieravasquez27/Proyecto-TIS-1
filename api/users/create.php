<?php
include '../../database/conexion.php';

try {

    if (isset($_POST['rut']) && isset($_POST['nombre_usuario']) && isset($_POST['nombres']) && isset($_POST['apellido_p']) && isset($_POST['apellido_m'])
        && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['password']) && isset($_POST['fecha_nac']) && isset($_POST['direccion'])
        && isset($_POST['comuna'])) {

        $rut = stripslashes($_REQUEST['rut']);
        $rut = mysqli_real_escape_string($conexion, $rut);
        $nombre_usuario = stripslashes($_REQUEST['nombre_usuario']);
        $nombre_usuario = mysqli_real_escape_string($conexion, $nombre_usuario);
        $nombres = stripslashes($_REQUEST['nombres']);
        $nombres = mysqli_real_escape_string($conexion, $nombres);
        $apellido_p = stripslashes($_REQUEST['apellido_p']);
        $apellido_p = mysqli_real_escape_string($conexion, $apellido_p);
        $apellido_m = stripslashes($_REQUEST['apellido_m']);
        $apellido_m = mysqli_real_escape_string($conexion, $apellido_m);
        $correo = stripslashes($_REQUEST['correo']);
        $correo = mysqli_real_escape_string($conexion, $correo);
        $telefono = stripslashes($_REQUEST['telefono']);
        $telefono = mysqli_real_escape_string($conexion, $telefono);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conexion, $password);
        $fecha_nac = stripslashes($_REQUEST['fecha_nac']);
        $fecha_nac = mysqli_real_escape_string($conexion, $fecha_nac);
        $direccion = stripslashes($_REQUEST['direccion']);
        $direccion = mysqli_real_escape_string($conexion, $direccion);
        $comuna = stripslashes($_REQUEST['comuna']);
        $comuna = mysqli_real_escape_string($conexion, $comuna);

        $sql_ingreso_usuario = "INSERT INTO usuario (rut, nombre_usuario, nombres, apellido_p, apellido_m, correo, telefono, contrasena, fecha_nac, direccion, id_comuna, id_rol) VALUES ('$rut', '$nombre_usuario', '$nombres', '$apellido_p', '$apellido_m', '$correo', '$telefono', '" . md5($password) . "', '$fecha_nac', '$direccion', '$comuna', 2)";
        $resultado_usuario = mysqli_query($conexion, $sql_ingreso_usuario);

        if ($resultado_usuario)
        {
            $sql_ingreso_administrador = "INSERT INTO administrador (rut) VALUES ('$rut')";
            $resultado_administrador = mysqli_query($conexion, $sql_ingreso_administrador);
        }

        $response = array(
            'success' => true,
            'message' => 'Registro exitoso'
        );
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