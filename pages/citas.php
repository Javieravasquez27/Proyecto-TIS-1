<?php
include 'database/conexion.php';

// Obtener el rut del usuario actual
$rut_usuario = $_SESSION['rut'];

// Consulta para obtener todas las citas del usuario
$query = "SELECT fecha_cita, hora_cita, rut_cliente, rut_profesional, lugar_atencion, servicio
          FROM cita
          WHERE rut_cliente = '$rut_usuario'";

$resultado = mysqli_query($conexion, $query);
?>

<style>
    .cita-list {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .cita-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }
    .cita-item:hover {
        background-color: #f1f1f1;
    }
    .cita-item .cita-info {
        flex: 1;
    }
    .cita-item .cita-info h5 {
        margin: 0;
        font-size: 1rem;
    }
    .cita-item .cita-info p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }
</style>

<div class="cita-list">
    <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
        <div class="cita-item" onclick="window.location.href='index.php?p=cita&fecha_cita=<?php echo $row['fecha_cita']; ?>&hora_cita=<?php echo $row['hora_cita']; ?>&rut_cliente=<?php echo $row['rut_cliente']; ?>&rut_profesional=<?php echo $row['rut_profesional']; ?>&lugar_servicio=<?php echo $row['lugar_atencion']; ?>&servicio=<?php echo $row['servicio']; ?>'">
            <div class="cita-info">
                <h5><?php echo $row['servicio']; ?></h5>
                <p>Fecha: <?php echo $row['fecha_cita']; ?>, Hora: <?php echo $row['hora_cita']; ?></p>
                <p>Lugar: <?php echo $row['lugar_atencion']; ?></p>
            </div>
        </div>
    <?php endwhile; ?>
</div>