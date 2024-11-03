<?php
function get_user_by_username($nombre_usuario)
{
    global $connection;

    $sql = "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_usuario'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function get_user_by_rut($rut)
{
    global $connection;

    $sql = "SELECT * FROM usuario WHERE rut = '$rut'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function get_user_by_nombres($nombres)
{
    global $connection;

    $sql = "SELECT * FROM usuario WHERE nombres = '$nombres'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function get_user_by_apellido_p($nombres)
{
    global $connection;

    $sql = "SELECT * FROM usuario WHERE apellido_p = '$apellido_p'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function include_page($page) {
    $page = strtolower($page);
    $page_path = 'pages/' . $page . '.php';
    if (file_exists($page_path)) {
        require_once $page_path;
    } else {
        require_once 'pages/home.php';
    }
}

?>