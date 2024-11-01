<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
        require('../../database/conexion.php');
        session_start();
            if (isset($_POST['username']))
            {
                $username = stripslashes($_REQUEST['username']);
                $username = mysqli_real_escape_string($con, $username);

                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($con, $password);

                $query = "SELECT * FROM users WHERE username = '$username' AND password = '".md5($password)."'";
                $result = mysqli_query($con, $query) or die(mysqli_error());

                $rows = mysqli_num_rows($result);

                if ($rows == 1)
                {
                    $_SESSION['username'] = $username;
                    header("Location: index.php");
                }
                else
                {
                    echo "<div class='form'><h3>Usuario o Contraseña incorrectos</h3><br> Haz clic aquí para <a href='login.php'>iniciar sesión</a></div>";
                }
            }
            else
            {
    ?>
    <div class="form">
        <h1>Iniciar Sesión</h1>
        <form action="" method="post" name="login">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" name="submit" value="Entrar">
        </form>
        <p>¿No estás registrado aún? <a href="../registro">Regístrate aquí</a></p>
    </div>
    <?php   } ?>
</body>

</html>