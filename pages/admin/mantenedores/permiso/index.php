<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de permisos - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_permiso = $(this).data('id'); // ID específico del botón presionado
        const nombre_permiso = $(this).data('permiso');
        const descripcion_permiso = $(this).data('descripcion');

        // Se guarda el ID en un campo oculto del formulario
        $('#editPermisoForm').data('id', id_permiso);

        // Se rellena el campo del nombre del permiso
        $('#nombre_permiso_edit').val(nombre_permiso);

        // Se rellena el campo de la descripción del permiso
        $('#descripcion_permiso_edit').val(descripcion_permiso);
    });

    function guardarEdicion() {
        const id_permiso = $('#editPermisoForm').data('id'); // ID del permiso desde el formulario
        const nombre_permiso = $('#nombre_permiso_edit').val();
        const descripcion_permiso = $('#descripcion_permiso_edit').val();

        // Se validan datos antes de enviar
        if (!nombre_permiso || !descripcion_permiso) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/permiso/update.php",
            type: "POST",
            data: {
                id_permiso: id_permiso,
                nombre_permiso: nombre_permiso,
                descripcion_permiso: descripcion_permiso
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editPermisoModal').modal('hide');
                        $('#permisoTabla').DataTable().ajax.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo completar la solicitud. Intente nuevamente.'
                });
            }
        });
    }
</script>

<h1 class="text-center my-5">Gestión de permisos</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addPermisoModal">
                        Ingresar nuevo permiso
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="permisoTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Permiso</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addPermisoModal" tabindex="-1" aria-labelledby="addPermisoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPermisoModalLabel">Ingresar nuevo permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPermisoForm">
                    <div class="mb-3">
                        <label for="nombre_permiso" class="form-label">Permiso</label>
                        <input type="text" class="form-control" id="nombre_permiso" name="nombre_permiso"
                            placeholder="Ejemplo: mantainers_manage" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_permiso" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion_permiso" name="descripcion_permiso"
                            placeholder="Ejemplo: Gestionar los mantenedores de la plataforma" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addPermisoForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editPermisoModal" tabindex="-1" aria-labelledby="editPermisoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermisoModalLabel">Editar permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPermisoForm">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label for="nombre_permiso_edit" class="form-label">Permiso</label>
                            <input type="text" class="form-control" id="nombre_permiso_edit" name="nombre_permiso_edit"
                                placeholder="Ejemplo: mantainers_manage" readonly required>
                        </div>
                    </fieldset>
                    <div class="mb-3">
                        <label for="descripcion_permiso_edit" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion_permiso_edit" name="descripcion_permiso_edit"
                            placeholder="Ejemplo: Gestionar los mantenedores de la plataforma" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editPermisoForm" class="btn btn-primary">Guardar</button>
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
                "url": "api/mantenedores/permiso/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_permiso"
            },
            {
                "data": "nombre_permiso"
            },
            {
                "data": "descripcion_permiso"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_permiso = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar este permiso?",
            text: "¡No podrás revertir esta acción!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "api/mantenedores/permiso/delete.php",
                    type: "POST",
                    data: {
                        id_permiso: id_permiso
                    },
                    success: function (response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: result.message,
                                timer: 1500,
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false
                            }).then(() => {
                                $('#permisoTabla').DataTable().ajax.reload();
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: result.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            }
        });
    });

    const addPermisoForm = document.querySelector("#addPermisoForm");

    addPermisoForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_permiso = document.querySelector("#nombre_permiso").value;
        const descripcion_permiso = document.querySelector("#descripcion_permiso").value;

        $.ajax({
            url: "api/mantenedores/permiso/create.php",
            type: "POST",
            data: {
                nombre_permiso: nombre_permiso,
                descripcion_permiso: descripcion_permiso
            },
            success: function (response) {
                const result = JSON.parse(response);
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: result.message,
                        timer: 1500,
                        showCancelButton: false,
                        showConfirmButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar",
                        allowOutsideClick: false
                    }).then(() => {
                        $('#addPermisoModal').modal('hide');
                        addPermisoForm.reset();
                        $('#permisoTabla').DataTable().ajax.reload();
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: result.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    });

    $('#editPermisoForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>