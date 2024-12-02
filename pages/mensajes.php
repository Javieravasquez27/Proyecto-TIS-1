<?php
include 'database/conexion.php';

// Obtener el rut del usuario actual
$rut_usuario = $_SESSION['rut'];

// Consulta para obtener todos los chats del usuario
$query = "SELECT DISTINCT u.rut, u.nombres, u.apellido_p, u.apellido_m, u.foto_perfil
          FROM mensaje m
          JOIN usuario u ON (m.rut_recive = u.rut OR m.rut_envia = u.rut)
          WHERE m.rut_recive = '$rut_usuario' OR m.rut_envia = '$rut_usuario'
          AND u.rut != '$rut_usuario'";

$resultado = mysqli_query($conexion, $query);
?>

<style>
    .chat-list {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .chat-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }
    .chat-item:hover {
        background-color: #f1f1f1;
    }
    .chat-item img {
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin-right: 15px;
    }
    .chat-item .chat-info {
        flex: 1;
    }
    .chat-item .chat-info h5 {
        margin: 0;
        font-size: 1rem;
    }
    .chat-item .chat-info p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }
</style>
<h1 class="text-center mt-5">Chats con profesionales</h1>
<div class="chat-list">
    <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
        <?php   if ($_SESSION['rut']!= $row['rut']): ?>
        <div class="chat-item" onclick="window.location.href='index.php?p=mensaje&rut=<?php echo $row['rut']; ?>'">
            <img src="<?php echo $row['foto_perfil']; ?>" alt="Foto de perfil">
            <div class="chat-info">
                <h5><?php echo $row['nombres'] . ' ' . $row['apellido_p'] . ' ' . $row['apellido_m']; ?></h5>
                <p>Chatear con <?php echo $row['nombres']; ?></p>
            </div>
        </div>
        <?php endif; ?>
    <?php endwhile; ?>
</div>