<?php
    include('auth.php')
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="form">
        <p>Bienvenid@ <b><?php echo $_SESSION['username']; ?> </b></p>
        <p>Acabas de iniciar sesion</p>
        <a href="logout.php">Cerrar sesion</a>
    </div>
</body>
</html>