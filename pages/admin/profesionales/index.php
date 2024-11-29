<?php 
    define('PERMISO_REQUERIDO', 'professional_authorization');
    include("middleware/auth.php");
?>

<title>Gestión de profesionales - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<h1 class="text-center my-5">Gestión de profesionales</h1>

<main class="">
    <div class="card">
        <div class="card-body table-responsive">
            <table id="professionalTable" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">RUT</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellido P.</th>
                        <th scope="col">Apellido M.</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Profesión</th>
                        <th scope="col">Institución</th>
                        <th scope="col">Título Prof.</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</main>

<!-- DataTable -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        const table = $('#professionalTable').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/profesionales/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [
                {
                    "data": "foto_perfil", orderable: false, searchable: false
                },
                {
                    "data": "rut"
                },
                {
                    "data": "nombres"
                },
                {
                    "data": "apellido_p"
                },
                {
                    "data": "apellido_m"
                },
                {
                    "data": "correo"
                },
                {
                    "data": "telefono"
                },
                {
                    "data": "profesion"
                },
                {
                    "data": "institucion"
                },
                {
                    "data": "titulo_profesional", orderable: false, searchable: false
                },
                {
                    "data": "opciones", orderable: false, searchable: false
                }
            ],
            "columnDefs": [
            {
                "targets": 9, // Índice de la columna "titulo_profesional"
                "render": function(data, type, row, meta) {
                    if (data) {
                        // Crea el enlace HTML para el archivo PDF
                        return `<a href="uploads/titulo_profesional/${data}" target="_blank">Descargar</a>`;
                    } else {
                        return "No disponible";
                    }
                }
            }
        ]
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.toggle-status', function() {
            var rut = $(this).data('id');
            var actual_estado_usuario = $(this).data('status');
            var nuevo_estado_usuario = actual_estado_usuario == 1 ? 0 : 1;
            var button = $(this);

            $.ajax({
                url: 'utils/cambio_estado_usuario.php',
                type: 'POST',
                data: { rut: rut, id_estado_usuario: nuevo_estado_usuario },
                success: function(response) {
                    if (response.success) {
                        // Actualizar el botón según el nuevo estado
                        if (nuevo_estado_usuario == 1) {
                            button
                                .removeClass('btn-outline-success')
                                .addClass('btn-outline-danger')
                                .text('Desautorizar')
                                .data('status', 1);
                        } else {
                            button
                                .removeClass('btn-outline-danger')
                                .addClass('btn-outline-success')
                                .text('Autorizar')
                                .data('status', 0);
                        }
                    } else {
                        console.log("Error al cambiar el estado.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error en la solicitud AJAX: " + error);
                }
            });
        });
    });
</script>
