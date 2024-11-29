<?php
    define('PERMISO_REQUERIDO', 'permission_manage');
    include("middleware/auth.php");
?>

<title>Gestión de permisos para roles - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<h1 class="text-center my-5">Gestión de permisos para roles de usuario</h1>

<main class="">
    <div class="card">
        <div class="card-body table-responsive">
            <table id="permisoTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">Rol</th>
                        <th scope="col">Permisos</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="editRolPermisoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar permisos del rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRolPermisoForm">
                    <div class="mb-3">
                        <label for="nombreRolSelect" class="form-label">Rol</label>
                        <select id="nombreRolSelect" name="nombreRolSelect" class="form-select" disabled>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <label class="form-check-label">Permisos</label>
                    <div id="permisoContainer">
                        <!-- Los checkboxes se llenarán aquí con AJAX -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editRolPermisoForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#permisoTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/permiso_rol/read.php",
                "dataType": "json",
                "type": "POST",
                "dataSrc": function (json) {
                    if (json.success) {
                        window.todosPermisos = json.permisos;
                        return json.roles;
                    }
                    return [];
                }
            },
            "columns": [
                { "data": "rol" },
                { "data": "permisos", orderable: false, searchable: false },
                {
                    "data": "id_rol",
                    "render": function (data) {
                        return `
                            <button id="edit" class="btn btn-sm btn-outline-primary" data-id="${data}" data-bs-toggle="modal" data-bs-target="#editRolPermisoModal">
                                <span class="material-icons">edit</span>
                            </button>`;
                    }, orderable: false, searchable: false
                }
            ]
        });
    });

    $(document).on('click', '#edit', function () {
        const idRol = $(this).data('id');
        const rolData = $('#permisoTabla').DataTable().rows().data().toArray().find(r => r.id_rol == idRol);

        if (rolData) {
            $('#nombreRolSelect').html(`<option value="${rolData.id_rol}" selected>${rolData.rol}</option>`);

            const permisoContainer = document.getElementById('permisoContainer');
            permisoContainer.innerHTML = '';

            todosPermisos.forEach(permiso => {
                const isChecked = (rolData.permisos || []).includes(permiso.nombre_permiso);
                permisoContainer.innerHTML += `
                    <div class="form-check form-switch">
                        <input
                            class="form-check-input"
                            type="checkbox" role="switch"
                            id="permiso_${permiso.id_permiso}"
                            value="${permiso.id_permiso}"
                            ${isChecked ? 'checked' : ''}
                        >
                        <label class="form-check-label" for="permiso_${permiso.id_permiso}">
                            ${permiso.nombre_permiso}
                        </label>
                    </div>`;
            });
        }
    });

    $('#editRolPermisoForm').on('submit', function (event) {
        event.preventDefault();

        const idRol = $('#nombreRolSelect').val();
        const permisosAsignados = Array.from($('#permisoContainer input:checked')).map(el => el.value);

        $.ajax({
            url: "api/permiso_rol/update.php",
            type: "POST",
            data: {
                id_rol: idRol,
                permisos: permisosAsignados
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
                        $('#editRolPermisoModal').modal('hide');
                        $('#permisoTabla').DataTable().ajax.reload();
                    });
                } else {
                    Swal.fire('Error', result.message, 'error');
                }
            }
        });
    });
</script>