<?php 
    define('PERMISO_REQUERIDO', 'admin_panel_access');
    include("middleware/auth.php");
?>

<title>Gestión de Reportes - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<h1 class="text-center my-5">Gestión de Reportes</h1>

<div class="px-4">
    <main class="mb-5">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="reportsTable" class="table table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">RUT Cliente</th>
                            <th scope="col">RUT Profesional</th>
                            <th scope="col">Motivo del Reporte</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- DataTable -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        const table = $('#reportsTable').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/reporte/read.php", // Ruta del archivo PHP que devolverá los datos
                "dataType": "json",
                "type": "POST"
            },
            "columns": [
                { "data": "rut_cliente" },
                { "data": "rut_profesional" },
                { "data": "motivo_reporte" },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `
                            <button class="btn btn-success btn-accept" data-id="${row.id_reporte}">Aceptar</button>
                            <button class="btn btn-danger btn-delete" data-id="${row.id_reporte}">Eliminar</button>
                        `;
                    },
                    "orderable": false,
                    "searchable": false
                }
            ]
        });

        // Acción para eliminar reporte
        $('#reportsTable').on('click', '.btn-delete', function() {
            const idReporte = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas eliminar este reporte?')) {
                $.ajax({
                    url: 'api/reporte/delete.php',
                    type: 'POST',
                    data: { id_reporte: idReporte },
                    success: function(response) {
                        if (response.success) {
                            alert('Reporte eliminado con éxito.');
                            table.ajax.reload(); // Recargar la tabla
                        } else {
                            alert('Error al eliminar el reporte.');
                        }
                    },
                    error: function() {
                        alert('Error en la solicitud.');
                    }
                });
            }
        });

        // Acción para aceptar reporte
        $('#reportsTable').on('click', '.btn-accept', function() {
            const idReporte = $(this).data('id');
            if (confirm('¿Estás seguro de que deseas aceptar este reporte?')) {
                $.ajax({
                    url: 'api/reporte/accept.php',
                    type: 'POST',
                    data: { id_reporte: idReporte },
                    success: function(response) {
                        if (response.success) {
                            alert('Reporte aceptado con éxito.');
                            table.ajax.reload(); // Recargar la tabla
                        } else {
                            alert('Error al aceptar el reporte.');
                        }
                    },
                    error: function() {
                        alert('Error en la solicitud.');
                    }
                });
            }
        });
    });
</script>
