<?php
    if (isset($_SESSION["rut"]))
    {
        header("Location: index.php?p=home");
        exit();
    }
?>

<title>Recupera tu contraseña - KindomJob's</title>


<div class="container" style="margin-top: 145px; margin-bottom: 115px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center"><img src="public/images/logo.png" width="100" alt="Logo"><br>Recuperar contraseña</h2>
                </div>
                <div class="card-body" style="margin-bottom: -15px;">
                    <p class="text-center">Te enviaremos un correo electronico para que puedas cambiar tu contraseña</p>
                    <form action="api/auth/recuperar_password.php" method="post" name="login" id="login-form">
                        <div class="form-group mb-3">
                            <label for="rut">RUT</label>
                            <input type="text" id="rut" name="rut" class="form-control" placeholder="RUT sin guión y con digito verificador (ej: 13799304K o 13799304k)" maxlength="9" required />
                        </div>
                        <div class="d-grid gap-2">
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </div>
                    </form>
                    <p class="text-center mt-3">¿No estás registrado aún? <a href='index.php?p=auth/register'>Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center mt-2"><button class="btn btn-primary btn-block"><a class="text-decoration-none text-white" href='index.php?p=home'>Volver al inicio</a></button></p>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        
        