
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro</title>
</head>
<body>
    <?php
        require('conexion.php');
            if(isset($_POST['username'])){
                $username = stripslashes($_POST['username']);
                $username = mysqli_real_escape_string($conexion,$username);

                $email = stripslashes($_POST['email']);
                $email = mysqli_real_escape_string($conexion,$email);
                
                $password = stripslashes($_POST['password']);
                $password = mysqli_real_escape_string($conexion,$password);

                $query = "INSERT into users (username,password,email) VALUES ('$username','".md5("$password")."','$email')";
                $result = mysqli_query($conexion,$query);
                
                if($result){
                    echo "<div class='form'><h3>Te Haz Registrado Correctamente</h3><br/>Haz Click Aqui para <a href='login.php'>logearte</a></div>";
                }
            }else{
    ?>

        <div class="form">
            <h1>Registrate Aqui</h1>
                <form name="registration" action="" method="POST">
                <input type="text" name="username" placeholder="usuario" required/>
                <input type="email" name="email" placeholder="email" required/>
                <input type="password" name="password" placeholder="contraseña" required/>
                <input type="submit" name="submit" value="registrarse"/>
            </form>
        </div>

    <?php
        }
    ?>
</body>
</html>