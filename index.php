<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KindomJob's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/index.css">
    <link rel="icon" type="image/png" href="public/images/logo.png">
</head>

<body style="background-color: rgb(240, 223, 255);">
    <nav class="navbar navbar-expand-lg bg-gradient bg-opacity-50" style="background-color: rgb(113, 59, 228);">
        <div class="container-fluid ">
            <a class="navbar-brand" href="#">
                <img src="public/images/logo.png" alt="Logo KindomJobs" height="50" class="imagen d-inline-block">
                <span class="h3 align-middle">KindomJob's</span>
            </a>
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class=" navbar-nav mx-auto ">
                    <li class="nav-item px-1">
                        <a class="nav-link " href="#">Inicio</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link " href="#">Profesiones</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link " href="#">Servicios</a>
                    </li>
                </ul>
                <ul class=" navbar-nav mr-auto ">
                    <li class="nav-item">
                        <a class="nav-link" href="pages/login/"><button type="button" class="btn btn-light">Iniciar
                                Sesión</button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/registro/"><button type="button"
                                class="btn btn-light">Registrarse</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row py-5">
            <div class="col-1"></div>
            <div class="col-7">
                <div class="row py-5">
                    <div class="col py-5 px-1 mt-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Profesión</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select class="form-select form-select" aria-label="Default select example">
                            <option selected>Región</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Ciudad</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Comuna</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Servicio</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="col-3">
                <div class="row py-5">
                    <div class="col py-5 px-1 mt-4">
                        <form class="d-flex" role="search">
                            <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success " type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

<!-- <div class="container">
    <div class=" gap-5 row text-center">
        <div class=" d-grid gap-5 col">
            <div>
                hola
            </div>
            <div>
                hola
            </div>
        </div>
        <div class="col">
            chao
        </div>
        <div class="col">
            jds
        </div>
    </div>
    <div class=" d-grid row text-center">
        <div class="col">
            hola
        </div>
        <div class="col">
            chao
        </div>
        <div class="col">
            jds
        </div>
    </div>
</div> -->

<!-- <div class="col-3 px-0">
    <div class="row py-5">
        <div class="col py-5 px-1 mt-4">
            <form class="d-flex" role="search">
                <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</div> -->