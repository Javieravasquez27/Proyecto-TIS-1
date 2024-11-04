<?php
    require('conexion.php');
    session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KindomJob's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <img src="./Logo_KindomJob's.png" alt="Logo_kindomjobs" height="50" class="imagen d-inline-block">
                <span class="h3 align-bottom" style="font-size: 30px;">KindomJob's</span>
            </a>
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class=" navbar-nav mx-auto ">
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href=""><b>Inicio</b></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href="#"><b>Profesiones</b></a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link text-white" href="#"><b>Servicios</b></a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['rut'])) {
                    ?>
                    <ul class=" navbar-nav mr-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="../user/perfil.php"><button type="button" class="btn btn-light">Perfil</button></a>
                    </li>
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
    <form action="busqueda_profesionales.php" method="POST">
    <div class="container">
            <div class="row py-5">
                <div class="col-1"></div>
                <div class="col-7">
                    <div class="row py-3">
                        <div class="col py-5 px-1 mt-4">
                            <select class="form-select ejemplo" aria-label="Default select example" name="filtro_profesion">
                                <option value="" selected>Profesión</option>
                                <?php
                                    $nombre_prof="SELECT * FROM profesion";
                                    $resultado_prof=mysqli_query($conexion,$nombre_prof);
                                    while($row_prof= mysqli_fetch_assoc($resultado_prof)){
                                        $nombre = $row_prof["nombre_profesion"];
                                        $id = $row_prof["id_profesion"];
                                        echo "<option value=".$id.">".$nombre."</option>";
                                    }
                                ?>
                            </select>                        
                        </div>
                        <div class="col py-5 px-1 mt-4">
                            <select class="form-select form-select ejemplo" aria-label="Default select example" name="filtro_region">
                                <option value="" selected>Región</option>
                                <?php
                                    $nombre_region="SELECT * FROM region";
                                    $resultado_region=mysqli_query($conexion,$nombre_region);
                                    while($row_region= mysqli_fetch_assoc($resultado_region)){
                                        $nombre = $row_region["nombre_region"];
                                        $id = $row_region["id_region"];
                                        echo "<option value=".$id.">".$nombre."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col py-5 px-1 mt-4">
                            <select class="form-select ejemplo" aria-label="Default select example" name="filtro_ciudad">
                                <option value="" selected>Ciudad</option>
                                <?php
                                    $nombre_ciudad="SELECT * FROM ciudad";
                                    $resultado_ciudad=mysqli_query($conexion,$nombre_ciudad);
                                    while($row_ciudad= mysqli_fetch_assoc($resultado_ciudad)){
                                        $nombre = $row_ciudad["nombre_ciudad"];
                                        $id = $row_ciudad["id_ciudad"];
                                        echo "<option value=".$id.">".$nombre."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col py-5 px-1 mt-4">
                            <select class="form-select ejemplo" aria-label="Default select example" name="filtro_comuna">
                                <option value="" selected>Comuna</option>
                                <?php
                                    $nombre_comuna="SELECT * FROM comuna";
                                    $resultado_comuna=mysqli_query($conexion,$nombre_comuna);
                                    while($row_comuna= mysqli_fetch_assoc($resultado_comuna)){
                                        $nombre = $row_comuna["nombre_comuna"];
                                        $id = $row_comuna["id_comuna"];
                                        echo "<option  value=".$id.">".$nombre."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col py-5 px-1 mt-4">
                            <select class="form-select ejemplo" aria-label="Default select example" name="filtro_servicio">
                                <option value="" selected>Servicio</option>
                                <?php
                                    $nombre_servicio="SELECT * FROM servicio";
                                    $resultado_servicio=mysqli_query($conexion,$nombre_servicio);
                                    while($row_servicio= mysqli_fetch_assoc($resultado_servicio)){
                                        $nombre = $row_servicio["nombre_servicio"];
                                        $id = $row_servicio["id_servicio"];
                                        echo "<option value=".$id.">".$nombre."</option>";
                                    }
                                ?>
                            </select>
                        </div>                    
                    </div>
                </div>
                <div class="col-3">
                    <div class="row py-3">
                        <div class="col py-5 px-1 mt-4 input-group">
                            <select id="buscador" class="ejemplo" name="filtro_nombreprof" style="width:50%">
                            <option value="" selected>Profesionales</option>
                            <?php
                                    $nombre_region="SELECT * FROM usuario join profesional using (nombre_usuario)";
                                    $resultado_region=mysqli_query($conexion,$nombre_region);
                                    while($row_region= mysqli_fetch_assoc($resultado_region)){
                                        $nombre = $row_region["nombres"];
                                        $id = $row_region["nombre_usuario"];
                                        echo "<option value=".$id.">".$nombre."</option>";
                                    }
                                ?>
                            </select>
                            <button class="btn btn-outline-success btn-sm" type="submit" style="height: 28px">Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center mb-1" style="font-size: 20px;"><span>Busqueda de profesionales cercanos</span></div>
            </div>
        </div>
        <div class="container cont_mapa mb-5">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 mapa">
                    <iframe src="https://locatestore.com/Xh--K4" style="border:none;width:100%;height:300px" allow="geolocation"></iframe>
                </div>
                <dic class="col-2"></dic>
            </div>
        </div>
        
    </div>
    </form>
    <script>
        $(document).ready(function() {
            $('.ejemplo').select2({
                width: 'resolve'
            });
        }); 
    </script>
</body>
<footer class="py-2" style="background-color: azure;">
    <div class="cont_footer py-3 border-1 border-secondary-subtle border-top" style="background-color: azure;">
            <div class="container " >
                <div class="row ">
                    <div class="col-2 "></div>
                    <div class="col-8 ">
                        <div class="row ">
                            <div class="col-4">     
                                <div class=" text-center" style="width: 200px; height: 100px;">
                                    <a href="#">Política de privacidad</a>
                                    <br>
                                    <a href="#">Términos y condiciones</a>
                                    <br>
                                    <a href="#">Trabaja con nosotros</a>
                                    <br>
                                    <a href="#">¿Quiénes somos?</a>
                                </div>               
                            </div>
                            <div class="col-4">
                                <div class=" text-center" style="width: 200px; height: 100px;">
                                    <a class="" href="#">¿Quiénes somos?</a>
                                </div> 
                            </div>
                            <div class="col-4">
                                <div class="border" style="width: 200px; height: 100px;">
                                    <div class="cont_kindomjobs d-inline-block">
                                        <iframe class="p-1" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2433.5807006063637!2d-73.05903132519512!3d-36.79803487667208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9669b5a69463acaf%3A0x7ca2e8d465b1efdf!2zVUNTQywgQ29uY2VwY2nDs24sIELDrW8gQsOtbw!5e1!3m2!1ses-419!2scl!4v1730579151802!5m2!1ses-419!2scl" width="97" height="97" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                    <div class="d-inline-block align-top">
                                        <span style="font-size: 15px;"><b>KindomJob's <br></b></span>
                                        <span style="font-size: 10px;">Av. alonso de rivera <br></span>
                                        <span style="font-size: 10px;">2850, Concepción</span>
                                    </div>
                                </div> 
                            </div>                   
                        </div>
                    </div>
                    <div class="col-2"></div>
                    
            </div>
        </div>
    </div>
        <div class="container">
            <div class="d-flex flex-column flex-sm-row justify-content-between py-1 border-top border-secondary-subtle">
                <p>© 2024 KindomJob's, Inc. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
                </ul>
            </div>
        </div>
        
</footer>
</html>
