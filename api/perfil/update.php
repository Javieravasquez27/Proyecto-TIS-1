<?php
    include("../../database/conexion.php");
    include("../../middleware/auth.php");
    
    $rut = $_SESSION['rut'];
    $id_rol = $_SESSION['id_rol'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $nombres = $_POST['nombres'];
    $apellido_p = $_POST['apellido_p'];
    $apellido_m = $_POST['apellido_m'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $password = !empty($_POST['password']) ? md5($_POST['password']) : null;
    $foto_perfil = $_FILES['foto_perfil']['name'];
    
    // Se procesa la foto de perfil
    if ($foto_perfil) {
        $directorio_foto_perfil = "uploads/foto_perfil/";
        $localizacion_foto_perfil_relativa = "../../" . $directorio_foto_perfil . basename($foto_perfil); // Ruta donde se carga la foto
        $localizacion_foto_perfil = $directorio_foto_perfil . basename($foto_perfil); // Ruta que se guarda en la base de datos
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $localizacion_foto_perfil_relativa);
    }
    
    $sql_actualiza_usuario = "UPDATE usuario SET nombre_usuario = '$nombre_usuario', nombres = '$nombres', apellido_p = '$apellido_p',
                                     apellido_m = '$apellido_m', correo = '$correo',
                                     telefono = '$telefono'";
    
    if ($password) {
        $sql_actualiza_usuario .= ", contrasena = '$password'";
    }
    if ($foto_perfil) {
        $sql_actualiza_usuario .= ", foto_perfil = '$localizacion_foto_perfil'";
    }
    
    $sql_actualiza_usuario .= " WHERE rut = '$rut';";
    mysqli_query($conexion, $sql_actualiza_usuario);

    if ($id_rol == 1 || $id_rol == 2 || $id_rol == 3) {
        $biografia_prof = $_POST['biografia_prof'];
        $experiencia = $_POST['experiencia'];

        $sql_actualiza_profesional = "UPDATE profesional SET biografia_prof = '$biografia_prof', experiencia = '$experiencia'
                                      WHERE rut = '$rut';";
        mysqli_query($conexion, $sql_actualiza_profesional);
    }

    echo "success";    
?>