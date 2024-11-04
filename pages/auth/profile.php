<?php 
    define('PERMISO_REQUERIDO', 'Acceder a las páginas de clientes');
    include("middleware/auth.php");
?>

<title>Perfil de <?php echo $_SESSION['nombre_usuario']; ?> - KindomJob's</title>

<div class="container mt-5">
    <!-- Sección de Perfil -->
    <div class="card mb-4">
        <div class="card-header header-bg text-center" style=" background-color: RGB(204, 204, 255);">
            <h3>Perfil de Usuario</h3>
        </div>
        <div class="card-body text-center">
            <img src="public/images/<?php echo $usuario['foto_perfil']; ?>" class="rounded-circle mb-3" alt="Foto de Perfil" width="120" height="120">
            <h4 class="text-dark"><?php echo $usuario['nombres']; ?></h4>
            <p class="text-muted"><?php echo $usuario['correo']; ?></p>
            <button class="btn btn-custom">Editar Perfil</button>
        </div>
    </div>
    <!-- Sección de Direcciones -->
    <!--
    <div class="card mb-4">
        <div class="card-header header-bg" style=" background-color: RGB(204, 204, 255);">
            <h3 class="text-center">Direcciones de Envío</h3>
        </div>
        <div class="card-body section-bg">
           <?php // while ($direccion = mysqli_fetch_assoc($resultado_direccion)) { ?>
                <div class="row mb-3">
                    <div class="col-md-1 text-center">
                        <span class="icon-bg"><i class="bi bi-geo-alt-fill"></i></span>
                    </div>
                    <div class="col-md-10">
                        <p><strong>Dirección:</strong> <?php // echo $direccion['direccion']; ?></p>
                        <p><strong>Ciudad:</strong> <?php // echo $direccion['ciudad']; ?></p>
                        <p><strong>Teléfono:</strong> <?php // echo $direccion['telefono']; ?></p>
                    </div>
                    <div class="col-md-1 text-center">
                        <button class="btn btn-secondary">Editar</button>
                    </div>
                </div>
                <hr>
            <?php // } ?>
            <div class="text-center">
                <button class="btn btn-custom mt-3">Agregar Nueva Dirección</button>
            </div>
        </div>
    </div>
    -->
    <!-- Sección de Métodos de Pago -->
    <!--
    <div class="card mb-4">
        <div class="card-header header-bg">
            <h3 class="text-center">Métodos de Pago</h3>
        </div>
        <div class="card-body section-bg">
            <?php // while ($pago = mysqli_fetch_assoc($resultado_pago)) { ?>
                <div class="row mb-3">
                    <div class="col-md-1 text-center">
                        <span class="icon-bg"><i class="bi bi-credit-card-fill"></i></span>
                    </div>
                    <div class="col-md-10">
                        <p><strong>Tipo de Tarjeta:</strong> <?php // echo $pago['tipo_tarjeta']; ?></p>
                        <p><strong>Número de Tarjeta:</strong> **** **** **** <?php // echo substr($pago['numero_tarjeta'], -4); ?></p>
                    </div>
                    <div class="col-md-1 text-center">
                        <button class="btn btn-secondary">Editar</button>
                    </div>
                </div>
                <hr>
            <?php // } ?>
            <div class="text-center">
                <button class="btn btn-custom mt-3">Agregar Nuevo Método de Pago</button>
            </div>
        </div>
    </div>
    -->
</div>