<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require('conexion.php');
        session_start();
        if(isset($_POST['username'])){
            $username = stripslashes($_POST['username']);
            $username = mysqli_real_escape_string($conexion,$username);

            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($conexion,$password);

            $query = "SELECT * FROM users WHERE username='$username' and password='".md5($password)."'";
            $result = mysqli_query($conexion,$query) or die(mysql_error());
            $rows = mysqli_num_rows($result);
            if($rows==1){
                $_SESSION['username'] = $username;
                header('Location: index.php');
            }else{
                echo "<div class='form'><h3>Usuario/contraseña incorrecto</h3><br/>Haz Click Aqui para <a href='cambiarcontraseña.php'>Cambiar Contrseña</a></div>";
            }
        }
        else{
            }
    ?>
    <div class="form">
        <h1>Inicia Sesion</h1>
        <form action="" method="POST" name="login">
            <input type="text" name="username" placeholder="Usuario" required/>
            <input type="password" name="password" placeholder="contraseña" required/>
            <input type="submit" name="submit" value="Entrar">
        </form>
    </div>
</body>
</html>