<?php
    define('PERMISO_REQUERIDO', 'servicio_profesion_manage');
    include("middleware/auth.php");
?>

<title>Gestión de servicios para profesiones - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<h1 class="text-center my-5">Gestión de servicios disponibles para profesiones</h1>

<div class="px-4">
    <main class="">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="servProfTabla" class="table table-hover" style="width: 100%;">
                    <thead class="">
                        <tr>
                            <th scope="col">Servicio</th>
                            <th scope="col">Profesiones</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Modal -->
<div class="modal fade" id="editServProfModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar profesiones para el servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editServProfForm">
                    <div class="mb-3">
                        <label for="nombreServSelect" class="form-label">Servicio</label>
                        <select id="nombreServSelect" name="nombreServSelect" class="form-select" disabled>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <label class="form-check-label">Profesiones</label>
                    <div id="profesionContainer">
                        <!-- Los checkboxes se llenarán aquí con AJAX -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editServProfForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

<!-- DataTable -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        const table = $('#servProfTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/servicio_profesion/read.php",
                "dataType": "json",
                "type": "POST",
                "dataSrc": function (json) {
                    if (json.success) {
                        window.todosServicios = json.profesiones;
                        return json.servicios;
                    }
                    return [];
                }
            },
            "columns": [
                { "data": "servicio" },
                { "data": "profesiones", orderable: false, searchable: false },
                {
                    "data": "id_servicio",
                    "render": function (data) {
                        return `
                            <button id="edit" class="btn btn-sm btn-outline-primary" data-id="${data}" data-bs-toggle="modal" data-bs-target="#editServProfModal">
                                <span class="material-icons">edit</span>
                            </button>`;
                    }, orderable: false, searchable: false
                }
            ]
        });
    });

    $(document).on('click', '#edit', function () {
        const idServicio = $(this).data('id');
        const servicioData = $('#servProfTabla').DataTable().rows().data().toArray().find(r => r.id_servicio == idServicio);

        if (servicioData) {
            $('#nombreServSelect').html(`<option value="${servicioData.id_servicio}" selected>${servicioData.servicio}</option>`);

            const profesionContainer = document.getElementById('profesionContainer');
            profesionContainer.innerHTML = '';

            todosServicios.forEach(profesion => {
                const isChecked = (servicioData.profesiones || []).includes(profesion.nombre_profesion);
                profesionContainer.innerHTML += `
                    <div class="form-check form-switch">
                        <input
                            class="form-check-input"
                            type="checkbox" servicio="switch"
                            id="profesion_${profesion.id_profesion}"
                            value="${profesion.id_profesion}"
                            ${isChecked ? 'checked' : ''}
                        >
                        <label class="form-check-label" for="profesion_${profesion.id_profesion}">
                            ${profesion.nombre_profesion}
                        </label>
                    </div>`;
            });
        }
    });

    $('#editServProfForm').on('submit', function (event) {
        event.preventDefault();

        const idServicio = $('#nombreServSelect').val();
        const profesionesAsignadas = Array.from($('#profesionContainer input:checked')).map(el => el.value);

        $.ajax({
            url: "api/servicio_profesion/update.php",
            type: "POST",
            data: {
                id_servicio: idServicio,
                profesiones: profesionesAsignadas
            },
            success: function (response) {
                const result = JSON.parse(response);
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: result.message,
                        timer: 1500,
                        showCancelButton: false,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editServProfModal').modal('hide');
                        $('#servProfTabla').DataTable().ajax.reload();
                    });
                } else {
                    Swal.fire('Error', result.message, 'error');
                }
            }
        });
    });
</script>