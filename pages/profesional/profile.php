<?php
    define('PERMISO_REQUERIDO', 'professional_pages_access');
    include("middleware/auth.php");
    include("database/conexion.php");
    $consulta = "SELECT * FROM usuario
    where rut = '$_SESSION[rut]'";
    $resultado=mysqli_query($conexion,$consulta);
    $user= mysqli_fetch_assoc($resultado);
?>

<title>Perfil Profesional de <?php echo $_SESSION['nombre_usuario']; ?> - KindomJob's</title>

    <style>
        /* Estilos principales */
        .card { 
            max-width: 900px; 
            margin: 20px auto; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }
        
        /* Perfil */
        .profile-section { 
            display: flex; 
            align-items: center; 
            margin-bottom: 15px; 
        }
        .profile-section img { 
            border-radius: 50%; 
            width: 100px; 
            height: 100px; 
            margin-right: 15px; 
            border: 2px solid #ddd;
        }
        .badge { 
            background-color: #e6f4ea; 
            color: #28a745; 
            font-size: 0.8rem; 
            padding: 5px 10px; 
            border-radius: 5px; 
        }
        
        /* Texto */
        .text-muted { 
            font-size: 0.9rem; 
        }
        .price-info { 
            font-weight: bold; 
            font-size: 1.1rem; 
            color: #333; 
        }

        /* Disponibilidad */
        .availability { 
            margin-top: 20px; 
        }
        .day-column { 
            text-align: center; 
            margin: 10px 0; 
        }
        .day-column strong { 
            display: block; 
            font-weight: 600; 
            margin-bottom: 10px; 
            font-size: 0.9rem; 
        }
        .day-column input { 
            width: 100%; 
            margin: 5px 0; 
            font-size: 0.9rem; 
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .profile-section { 
                flex-direction: column; 
                align-items: flex-start; 
                text-align: left; 
            }
            .profile-section img { 
                margin-bottom: 10px; 
            }
            .day-column button { 
                width: 100%; 
            }
        }
        .nav-tabs .nav-link.active {
            font-weight: bold; /* Texto en negrita */
            border: none;
            border-bottom: 3px solid #000; /* Línea inferior en negrita */
            color: #000; /* Color del texto */
        }
        /* Estilo para las pestañas inactivas */
        .nav-tabs .nav-link {
            color: #666; /* Color del texto inactivo */
        }
    </style>

<div class="container mt-5">
    <!-- Sección de Perfil -->
    <div class="card mb-4">
        <div class="card-header header-bg text-center" style=" background-color: RGB(204, 204, 255);">
            <h3>Perfil de Usuario</h3>
        </div>
        <div class="card-body text-center">
            <img src="<?php echo $user['foto_perfil']?>" class="rounded-circle mb-3" alt="Foto de Perfil" width="120" height="120">
            <h4 class="text-dark"><?php echo $user['nombres']; ?></h4>
            <p class="text-muted"><?php echo $user['correo']; ?></p>
            <button class="btn btn-custom">Editar Perfil</button>
        </div>
    </div>

    <!-- Sección de Direcciones -->
    <div class="card mb-4">
        <form action="guardar_disponibilidad.php" method="POST">
        <div class="card-header header-bg" style=" background-color: RGB(204, 204, 255);">
            <h3 class="text-center">Establecer Horarios</h3>
        </div>
        <div class="card-body section-bg">
        <div class="tab-content mt-3">
            <div class="availability">
                <div class="row">
                    <div class="col-2 day-column">
                        <strong>lunes</strong>
                        <!-- Aquí puedes añadir los horarios -->
                        <input type="hidden" name="dia[]" value='lunes'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                        <strong>martes</strong>
                        <input type="hidden" name="dia[]" value='martes'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                        <strong>miércoles</strong>
                        <input type="hidden" name="dia[]" value='miércoles'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                        <strong>jueves</strong>
                        <input type="hidden" name="dia[]" value='jueves'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                    <strong>viernes</strong>
                    <input type="hidden" name="dia[]" value='viernes'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                    <div class="col-2 day-column">
                    <strong>sábado</strong>
                    <input type="hidden" name="dia[]" value='sábado'>
                        <label for=""><b>Hora Inicio</b></label>
                        <input type="time" name="hora_inicio[]" id="hora_inicio" required>
                        <label for=""><b>Hora Fin</b></label>
                        <input type="time" name="hora_fin[]" id="hora_fin" required>
                    </div>
                </div>
                <div class="row">
                <div class="col-4"></div>
                <div class="col-4 text-center"><button type="submit">Guardar Disponibilidad</button></div>
                <div class="col-4"></div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <!-- Sección de Métodos de Pago -->
</div>