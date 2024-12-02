<?php 
    require_once __DIR__ . '/../config/config.php';
    include __DIR__ . '/../utils/functions.php';

    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

    if (!isset($_SESSION["rut"]))
    {
        header("Location: index.php?p=auth/login");
        exit();
    }
    else
    {
        $rut = $_SESSION["rut"];
        $foto_perfil = $_SESSION["foto_perfil"];
        $fila_usuario = get_user_by_rut($rut);
    
        if (!$fila_usuario)
        {
            session_destroy();
            header("Location: index.php?p=auth/login");
            exit();
        }
    
        if (defined('PERMISO_REQUERIDO'))
        {
            if (!user_has_permission($rut, PERMISO_REQUERIDO))
            {
                header("Location: index.php?p=error/acceso_denegado");
                exit();
            }
        }
    }
    
    function user_has_permission($rut, $permiso_requerido)
    {
        global $conexion;
    
        // Obtener el id_rol del usuario
        $sql_consulta_usuario = "SELECT u.id_rol, r.nombre_rol AS nombre_rol
                                 FROM usuario u JOIN rol r ON u.id_rol = r.id_rol
                                 WHERE rut = '$rut';";
        $resultado_consulta_usuario = mysqli_query($conexion, $sql_consulta_usuario);
        $fila_usuario = mysqli_fetch_assoc($resultado_consulta_usuario);
    
        if (!$fila_usuario)
        {
            return false;
        }

        $id_rol = $fila_usuario['id_rol'];
        $sql_consulta_permiso = "
            SELECT 1 FROM permiso_rol pr
            JOIN permiso p ON pr.id_permiso = p.id_permiso
            WHERE pr.id_rol = $id_rol AND p.nombre_permiso = '$permiso_requerido'
        ";
        $resultado_consulta_permiso = mysqli_query($conexion, $sql_consulta_permiso);
    
        return mysqli_num_rows($resultado_consulta_permiso) > 0;
    }
?>