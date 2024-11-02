<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: rgb(234, 228, 246);
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container img {
            width: 50%;
            margin-bottom: 1rem;
        }
        .login-container h1 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .alert {
            display: none;
        }
    </style>
</head>
<body>
    <?php
        require('conexion.php');
        session_start();
        if (isset($_POST['username'])) {
            $username = stripslashes($_POST['username']);
            $username = mysqli_real_escape_string($conexion, $username);
            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($conexion, $password);

            $query = "SELECT * FROM users WHERE username='$username' and password='" . md5($password) . "'";
            $result = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
            } else {
                echo "<div class='alert alert-danger'>Usuario o contraseña incorrecto</div>";
            }
            // Verificar si el usuario está en la tabla de usuarios baneados
        $ban_query = "SELECT * FROM banea_usuario WHERE username='$username'";
        $ban_result = mysqli_query($conexion, $ban_query);
        
        if (mysqli_num_rows($ban_result) > 0) {
            echo "<div class='form'><h3>Su cuenta ha sido suspendida por motivos de reglamento.</h3><br/>No puede ingresar a la plataforma.</div>";
        } else {
            // Continuar con el proceso de login si el usuario no está baneado
            $query = "SELECT * FROM users WHERE username='$username' AND password='" . md5($password) . "'";
            $result = mysqli_query($conexion, $query) or die(mysql_error());
            $rows = mysqli_num_rows($result);

        }
    ?>

    <div class="login-container">
        <img src="Logo_KindomJobs.png" alt="Logo">
        <h1>Inicia Sesión</h1>
        <form action="" method="POST" name="login">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Usuario" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
        <p class="mt-3">
            ¿Olvidaste tu contraseña? <a href="cambiarcontraseña.php">Cambia tu contraseña aquí</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>