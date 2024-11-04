<?php
    require('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Verificaciones - KindomJob's</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../estilos.css">
    <script
        src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
        crossorigin="anonymous"></script>    
</head>
<body style="font-family: 'Josefin Sans', sans-serif;  background-color: rgb(240, 223, 255 );" >
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" style="background-color: rgb(150, 120, 182);">
        <div class="container-fluid ">
            <a class="navbar-brand " href="index.php">
                <img src="../pag_principal/Logo_KindomJob's.png" alt="Logo_kindomjobs" height="50" class="imagen d-inline-block">
                <span class="h3 align-bottom" style="font-size: 30px;">KindomJob's</span>
            </a>
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class=" navbar-nav mx-auto ">
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href="../pag_principal/index.php"><b>Inicio</b></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href=""><b>Profesiones</b></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href="#"><b>Servicios</b></a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['rut'])) {
                    ?>
                    <ul class=" navbar-nav mr-auto ">
                    <?php if ($user['id_rol']==11) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="../profesional/perfil.php"><button type="button" class="btn btn-light">Perfil</button></a>
                        </li>
                    <?php
                    }else{?>
                        <li class="nav-item">
                            <a class="nav-link" href="../user/perfil.php"><button type="button" class="btn btn-light">Perfil</button></a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/logout.php"><button type="button" class="btn btn-light">Cerrar Session</button></a>
                    </li>
                </ul>
                 <?php
                } else{
                    ?>
                    <ul class=" navbar-nav mr-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/login.php"><button type="button" class="btn btn-light">Inicio Sesión</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Login/registration.php"><button type="button" class="btn btn-light">Registrarse</button></a>
                    </li>
                </ul>
                <?php
                }
                ?>
            </div>
        </div>
    </nav> 
    <div class="container-fluid contenedorcompleto py-4">
        <br>

        <table class="table table-striped table-bordered text-center">
            <tr>
                <th>Profesionales por verificar:</th>
                <th>Opciones:</th>
            </tr>

            <?php
                $consulta = "SELECT * FROM usuario
                    where id_rol =  11";
                $resultado = mysqli_query($conexion, $consulta);

                while($row = mysqli_fetch_assoc($resultado)){
                    $nombre_usuario_consultado = $row["nombre_usuario"];
                    $id_rol = $row["id_rol"];
                    
                    echo "<tr>";
                        echo "<td>".$nombre_usuario_consultado."</td>";
                        echo "<td class='d-flex justify-content-center'>";
                            echo "<a href='no_autorizar_institucion.php?id_e=".$id_rol."' class='btn btn-danger d-flex align-items-center mx-1'>";
                            echo "<span class='material-icons me-1'>block</span>No aprobado";
                            echo "</a>";
                            echo "<a href='autorizar_institucion.php?id_e=".$id_rol."' class='btn btn-primary d-flex align-items-center mx-1'>";
                            echo "<span class='material-icons me-1'>check</span>Aprobado";
                            echo "</a>";
                        echo "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>

</html>