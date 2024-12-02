<?php
include 'database/conexion.php';

// Obtener el rut del usuario actual
$rut_usuario = $_SESSION['rut'];

// Consulta para obtener todos los profesionales favoritos del usuario
$query = "SELECT u.rut, u.nombres, u.apellido_p, u.apellido_m, u.foto_perfil
          FROM favoritos f
          JOIN usuario u ON f.rut_profesional = u.rut
          WHERE f.rut_usuario = '$rut_usuario'";

$resultado = mysqli_query($conexion, $query);
?>

<style>
    .favorite-list {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .favorite-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }
    .favorite-item:hover {
        background-color: #f1f1f1;
    }
    .favorite-item img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin-right: 15px;
    }
    .favorite-item .favorite-info {
        flex: 1;
    }
    .favorite-item .favorite-info h5 {
        margin: 0;
        font-size: 1rem;
    }
    .favorite-item .favorite-info p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }
</style>
<h1 class="text-center mt-5">Lista de favoritos</h1>
<div class="favorite-list">
    <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
        <div class="favorite-item" onclick="window.location.href='index.php?p=profesional/profile_cita&rut=<?php echo $row['rut']; ?>'">
            <img src="<?php echo $row['foto_perfil']; ?>" alt="Foto de perfil">
            <div class="favorite-info">
                <h5><?php echo $row['nombres'] . ' ' . $row['apellido_p'] . ' ' . $row['apellido_m']; ?></h5>
                <p>Ver perfil</p>
            </div>
        </div>
    <?php endwhile; ?>
</div>