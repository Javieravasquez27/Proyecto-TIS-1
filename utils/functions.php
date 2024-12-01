<?php
    function get_user_by_username($nombre_usuario)
    {
        global $conexion;

        $sql = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_usuario'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) == 1)
        {
            return mysqli_fetch_assoc($resultado);
        }
        else
        {
            return false;
        }
    }

    function get_user_by_rut($rut)
    {
        global $conexion;

        $sql = "SELECT * FROM usuario WHERE rut = '$rut'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) == 1)
        {
            return mysqli_fetch_assoc($resultado);
        }
        else
        {
            return false;
        }
    }

    function get_user_by_nombres($nombres)
    {
        global $conexion;

        $sql = "SELECT * FROM usuario WHERE nombres = '$nombres'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) == 1)
        {
            return mysqli_fetch_assoc($resultado);
        }
        else
        {
            return false;
        }
    }

    function get_user_by_apellido_p($apellido_p)
    {
        global $conexion;

        $sql = "SELECT * FROM usuario WHERE apellido_p = '$apellido_p'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) == 1)
        {
            return mysqli_fetch_assoc($resultado);
        }
        else
        {
            return false;
        }
    }

    function get_user_by_apellido_m($apellido_m)
    {
        global $conexion;

        $sql = "SELECT * FROM usuario WHERE apellido_m = '$apellido_m'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) == 1)
        {
            return mysqli_fetch_assoc($resultado);
        }
        else
        {
            return false;
        }
    }
    function enviarCorreo($destinatario, $asunto, $mensaje) {
        $headers = "From: no-reply@kindomjobs.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
        return mail($destinatario, $asunto, $mensaje, $headers);
    }
    
?>