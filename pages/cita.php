<?php
    include 'database/conexion.php';
    
    $fecha_cita = $_GET['fecha_cita'];
    $hora_cita = $_GET['hora_cita'];
    $rut_cliente = $_GET['rut_cliente'];
    $rut_profesional = $_GET['rut_profesional'];
    $lugar_servicio = $_GET['lugar_servicio'];
    $servicio = $_GET['servicio'];
    
    // Consulta para obtener los detalles del profesional
    $query_profesional = "SELECT nombres, apellido_p, apellido_m FROM usuario WHERE rut = '$rut_profesional'";
    $resultado_profesional = mysqli_query($conexion, $query_profesional);
    $profesional = mysqli_fetch_assoc($resultado_profesional);
    
    // Consulta para obtener los detalles del cliente
    $query_cliente = "SELECT nombres, apellido_p, apellido_m FROM usuario WHERE rut = '$rut_cliente'";
    $resultado_cliente = mysqli_query($conexion, $query_cliente);
    $cliente = mysqli_fetch_assoc($resultado_cliente);
    
    // Obtener la fecha y hora actual
    $fecha_actual = date('Y-m-d');
    $hora_actual = date('H:i:s');
    
    // Verificar si la fecha de la cita ya ha pasado
    $cita_pasada = ($fecha_cita < $fecha_actual) || ($fecha_cita == $fecha_actual && $hora_cita < $hora_actual);
?>

<style>
    .voucher {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    .voucher-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .voucher-section {
        margin-bottom: 15px;
    }
    .voucher-section strong {
        display: block;
        margin-bottom: 5px;
    }
</style>

<div class="voucher">
    <div class="voucher-header">
        <h2>Detalles de la Cita</h2>
    </div>
    <div class="voucher-section">
        <strong>Profesional:</strong>
        <p><?php echo $profesional['nombres'] . ' ' . $profesional['apellido_p'] . ' ' . $profesional['apellido_m']; ?></p>
        <p><strong>RUT Profesional:</strong> <?php echo $rut_profesional; ?></p>
    </div>
    <div class="voucher-section">
        <strong>Cliente:</strong>
        <p><?php echo $cliente['nombres'] . ' ' . $cliente['apellido_p'] . ' ' . $cliente['apellido_m']; ?></p>
    </div>
    <div class="voucher-section">
        <strong>Servicio:</strong>
        <p><?php echo $servicio; ?></p>
    </div>
    <div class="voucher-section">
        <strong>Fecha:</strong>
        <p><?php echo $fecha_cita; ?></p>
    </div>
    <div class="voucher-section">
        <strong>Hora:</strong>
        <p><?php echo $hora_cita; ?></p>
    </div>
    <div class="voucher-section">
        <strong>Lugar:</strong>
        <p><?php echo $lugar_servicio; ?></p>
    </div>
    <div class="text-center">
        <?php if ($cita_pasada): ?>
            <button class="btn btn-secondary" onclick="window.location.href='index.php?p=opinar&rut_profesional=<?php echo $rut_profesional;?>'">Opinar</button>
        <?php endif; ?>
    </div>
</div>