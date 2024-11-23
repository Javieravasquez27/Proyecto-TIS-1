<?php 
include '../../database/conexion.php';

try {
    if (isset($_POST['rut']) && isset($_POST['nombre_usuario']) && isset($_POST['nombres']) && isset($_POST['apellido_p']) && isset($_POST['apellido_m'])
        && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['password']) && isset($_POST['fecha_nac']) && isset($_POST['direccion'])
        && isset($_POST['comuna']) && isset($_POST['rol'])) {

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
        $rol = stripslashes($_REQUEST['rol']);
        $rol = mysqli_real_escape_string($conexion, $rol);

        // Procesar la foto de perfil si el rol es Profesional (id_rol = 3)
        $foto_perfil = null;
        if ($rol == 3 && isset($_FILES['foto_perfil'])) {
            $directorio_foto_perfil = "uploads/foto_perfil/";
            $localizacion_foto_perfil = $directorio_foto_perfil . basename($_FILES["foto_perfil"]["name"]);
            $subida_correcta_fp = 1;
            $extension_fp = strtolower(pathinfo($localizacion_foto_perfil, PATHINFO_EXTENSION));

            // Verificar si el archivo es una imagen
            $verificar_fp = getimagesize($_FILES["foto_perfil"]["tmp_name"]);
            if($verificar_fp !== false) {
                $subida_correcta_fp = 1;
            } else {
                $subida_correcta_fp = 0;
            }

            // Intentar cargar el archivo
            if ($subida_correcta_fp == 1 && move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $localizacion_foto_perfil)) {
                $foto_perfil = mysqli_real_escape_string($conexion, $localizacion_foto_perfil);
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error al cargar la foto de perfil.'
                );
                echo json_encode($response);
                exit();
            }
        }

        // Si el rol es profesional, insertar en la tabla profesional
        if ($rol == 3) {
            $sql_ingreso_usuario = "INSERT INTO usuario (rut, nombre_usuario, nombres, apellido_p, apellido_m, correo, telefono, contrasena, fecha_nac, direccion, foto_perfil, id_comuna, id_rol, id_estado_usuario) 
                                    VALUES ('$rut', '$nombre_usuario', '$nombres', '$apellido_p', '$apellido_m', '$correo', '$telefono', '" . md5($password) . "', '$fecha_nac', '$direccion', '$foto_perfil', '$comuna', '$rol', 2)";
            $resultado_usuario = mysqli_query($conexion, $sql_ingreso_usuario);

            if ($resultado_usuario)
            {
                $id_profesion = stripslashes($_REQUEST['profesion']);
                $id_profesion = mysqli_real_escape_string($conexion, $id_profesion);
                $id_institucion = stripslashes($_REQUEST['institucion']);
                $id_institucion = mysqli_real_escape_string($conexion, $id_institucion);
                $experiencia = stripslashes($_REQUEST['experiencia']);
                $experiencia = mysqli_real_escape_string($conexion, $experiencia);
                
                $titulo_profesional = null;
                if (isset($_FILES['titulo_profesional'])) {
                    $directorio_titulo_profesional = "../../uploads/titulo_profesional/";
                    $localizacion_titulo_profesional = $directorio_titulo_profesional . basename($_FILES["titulo_profesional"]["name"]);
                    $subida_correcta_tp = 1;
                    $extension_tp = strtolower(pathinfo($localizacion_titulo_profesional, PATHINFO_EXTENSION));
                
                    // Intentar cargar el archivo
                    if ($subida_correcta_tp == 1 && move_uploaded_file($_FILES["titulo_profesional"]["tmp_name"], $localizacion_titulo_profesional)) {
                        $titulo_profesional = mysqli_real_escape_string($conexion, $localizacion_titulo_profesional);
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => 'Error al cargar título profesional.'
                        );
                        echo json_encode($response);
                        exit();
                    }
                }

                $sql_ingreso_profesional = "INSERT INTO profesional (rut, id_profesion, id_institucion, experiencia, titulo_profesional) 
                                            VALUES ('$rut', '$id_profesion', '$id_institucion', '$experiencia', '$titulo_profesional')";
                $resultado_profesional = mysqli_query($conexion, $sql_ingreso_profesional);
            }
            $message = 'Hemos recibido su solicitud de registro como profesional y será revisada.';
        }

        elseif ($rol == 4)
        {
            $sql_ingreso_usuario = "INSERT INTO usuario (rut, nombre_usuario, nombres, apellido_p, apellido_m, correo, telefono, contrasena, fecha_nac, direccion, foto_perfil, id_comuna, id_rol, id_estado_usuario) 
                                    VALUES ('$rut', '$nombre_usuario', '$nombres', '$apellido_p', '$apellido_m', '$correo', '$telefono', '" . md5($password) . "', '$fecha_nac', '$direccion', '$foto_perfil', '$comuna', '$rol', 1)";
            $resultado_usuario = mysqli_query($conexion, $sql_ingreso_usuario);

            if ($resultado_usuario)
            {
                $sql_ingreso_cliente = "INSERT INTO cliente (rut) VALUES ('$rut')";
                $resultado_cliente = mysqli_query($conexion, $sql_ingreso_cliente);
            }
            $message = 'Registro exitoso';
        }

        $response = array(
            'success' => true,
            'message' => $message
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
?>