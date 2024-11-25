<title>Iniciar Sesión - KindomJob's</title>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center"><img src="public/images/logo.png" alt="Logo"><br>Inicia Sesión</h1>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="login" id="login-form">
                        <div class="form-group mb-3">
                            <label for="rut">RUT</label>
                            <input type="text" id="rut" name="rut" class="form-control" placeholder="Sin puntos ni guión (ejemplo: 123456789)" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required />
                        </div>
                        <div class="d-grid gap-2">
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                    </form>
                    <p class="text-center">¿No estás registrado aún? <a href='index.php?p=auth/register'>Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        
        <script src="public/js/app.js" ></script>