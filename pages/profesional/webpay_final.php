<?php
    include 'database/conexion.php';?>
<?php
    $status = $_GET['status'];
    
    $rut_prof = $_GET['rut_prof'];
    $nombre_profesional = $_GET['nombre_profesional'];
    $nombre_servicio = $_GET['nombre_servicio'];
    $fecha_cita = $_GET['fecha_cita'];
    $hora_cita = $_GET['hora_cita'];
    $lugar_atencion = $_GET['lugar_atencion'];
    $cant_estrellas_gastadas = isset($_GET['estrellas_usadas']) ? $_GET['estrellas_usadas'] : 0;
    
    
    if ($status == 'success') { 
        $buyOrder = $_GET['buyOrder'];
        $amount = $_GET['amount'];
        $token = $_GET['token'];
        $insertar_cita = "INSERT INTO cita (rut_cliente, rut_profesional, fecha_cita, hora_cita, tokencompra, lugar_atencion, servicio) VALUES ('$_SESSION[rut]', '$rut_prof', '$fecha_cita', '$hora_cita', '$token', '$lugar_atencion', '$nombre_servicio')";
        $resultado = mysqli_query($conexion, $insertar_cita);
        $estrellas_generadas = intdiv($amount, 1000);
        if(intval($cant_estrellas_gastadas)==0){
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Pago Exitoso',
                    text: 'Has ganado $estrellas_generadas estrellas por esta compra.',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                });
            </script>";
        }else{
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Pago Exitoso',
                    text: 'Has gastado int$cant_estrellas_gastadas estrellas.',
                    showConfirmButton: true,
                    confirmButtonText: 'Aceptar',
                });";
        }
        $insertar_estrellas = "update usuario set estrellas = estrellas + $estrellas_generadas where rut = '$_SESSION[rut]'";
        $result = mysqli_query($conexion, $insertar_estrellas);
?>
    <div class='container mt-5'>
        <div class='voucher' id='voucher'>
            <div class='voucher-header text-center'>
                <h2>Detalles del Servicio</h2>
            </div>
            <div class='voucher-section'>
                <div class='row'>
                    <div class='col-md-6'>
                        <strong>Servicio:</strong> <?php echo $nombre_servicio; ?>
                    </div>
                    <div class='col-md-6'>
                        <strong>Profesional:</strong> <?php echo $nombre_profesional; ?>
                    </div>
                </div>
            </div>
            <div class='voucher-section'>
                <div class='row'>
                    <div class='col-md-6'>
                        <strong>RUT Profesional:</strong> <?php echo $rut_prof; ?>
                    </div>
                    <div class='col-md-6'>
                        <strong>Fecha:</strong> <?php echo $fecha_cita; ?>
                    </div>
                </div>
            </div>
            <div class='voucher-section'>
                <div class='row'>
                    <div class='col-md-6'>
                        <strong>Hora:</strong> <?php echo $hora_cita; ?>
                    </div>
                    <div class='col-md-6'>
                        <strong>Monto:</strong> $<?php echo $amount; ?>
                    </div>
                </div>
            </div>
            <div class='voucher-section'>
                <div class='row'>
                    <div class='col-md-6'>
                        <strong>Lugar de Atención:</strong> <?php echo $lugar_atencion; ?>
                    </div>
                    <div class='col-md-6'>
                        <strong>Orden de Compra:</strong> <?php echo $buyOrder; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='mt-3 text-center'>
            <button class='btn btn-primary' onclick="window.location.href='index.php'">Volver al inicio</button>
            <button class='btn btn-secondary' onclick="downloadPDF()">Descargar como PDF</button>
        </div>
    </div>
    <style>
        .voucher {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border: 1px solid #dee2e6;
        }
        .voucher-header {
            font-size: 2em;
            margin-bottom: 20px;
            color: #343a40;
        }
        .voucher-section {
            margin-bottom: 15px;
        }
        .voucher-section strong {
            color: #495057;
        }
        .voucher-section .row {
            margin-bottom: 10px;
        }
        .btn {
            margin: 5px;
        }
    </style>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js'></script>
    <script>
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.setFontSize(18);
            doc.text('Detalles del Servicio', 105, 20, null, null, 'center');
            doc.setFontSize(12);
            doc.text('Servicio: <?php echo $nombre_servicio; ?>', 10, 40);
            doc.text('Profesional: <?php echo $nombre_profesional; ?>', 10, 50);
            doc.text('RUT Profesional: <?php echo $rut_prof; ?>', 10, 60);
            doc.text('Fecha: <?php echo $fecha_cita; ?>', 10, 70);
            doc.text('Hora: <?php echo $hora_cita; ?>', 10, 80);
            doc.text('Monto: $<?php echo $amount; ?>', 10, 90);
            doc.text('Lugar de Atención: <?php echo $lugar_atencion; ?>', 10, 100);
            doc.text('Orden de Compra: <?php echo $buyOrder; ?>', 10, 110);

            // Descarga el PDF
            doc.save('voucher.pdf');
        }
    </script>

<?php
} 
if ($status == 'error') { 
    $buyOrder = $_GET['buyOrder'];
    $amount = $_GET['amount'];
    $token = $_GET['token'];
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error En El Pago',
            text: 'Se te redireccionara a la pagina principal',
            showConfirmButton: true,
            confirmButtonText: 'Aceptar',
            willClose: () => {
                window.location.href = 'index.php';
            }
        });
    </script>
    "; 
}
?>