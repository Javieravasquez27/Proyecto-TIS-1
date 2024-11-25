<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de instituciones - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_institucion = $(this).data('id'); // ID específico del botón presionado
        const nombre_institucion = $(this).data('institucion');

        // Se guarda el ID en un campo oculto del formulario
        $('#editInstitucionForm').data('id', id_institucion);

        // Se rellena el campo del nombre de la institución
        $('#nombre_institucion_edit').val(nombre_institucion);
    });

    function guardarEdicion() {
        const id_institucion = $('#editInstitucionForm').data('id'); // ID de la institución desde el formulario
        const nombre_institucion = $('#nombre_institucion_edit').val();

        // Se validan datos antes de enviar
        if (!nombre_institucion) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/institucion/update.php",
            type: "POST",
            data: {
                id_institucion: id_institucion,
                nombre_institucion: nombre_institucion
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editInstitucionModal').modal('hide');
                        $('#institucionTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de instituciones</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addInstitucionModal">
                        Ingresar nueva institución
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="institucionTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Institución</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addInstitucionModal" tabindex="-1" aria-labelledby="addInstitucionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInstitucionModalLabel">Ingresar nueva institución</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addInstitucionForm">
                    <div class="mb-3">
                        <label for="nombre_institucion" class="form-label">Institución</label>
                        <input type="text" class="form-control" id="nombre_institucion" name="nombre_institucion"
                            placeholder="Ingrese el nombre de la nueva institución" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addInstitucionForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editInstitucionModal" tabindex="-1" aria-labelledby="editInstitucionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInstitucionModalLabel">Editar institución</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editInstitucionForm">
                    <div class="mb-3">
                        <label for="nombre_institucion_edit" class="form-label">Institución</label>
                        <input type="text" class="form-control" id="nombre_institucion_edit" name="nombre_institucion_edit"
                            placeholder="Ingrese el nuevo nombre para la institución" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editInstitucionForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#institucionTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/institucion/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_institucion"
            },
            {
                "data": "nombre_institucion"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_institucion = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar esta institución?",
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
                    url: "api/mantenedores/institucion/delete.php",
                    type: "POST",
                    data: {
                        id_institucion: id_institucion
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
                                $('#institucionTabla').DataTable().ajax.reload();
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

    const addInstitucionForm = document.querySelector("#addInstitucionForm");

    addInstitucionForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_institucion = document.querySelector("#nombre_institucion").value;

        $.ajax({
            url: "api/mantenedores/institucion/create.php",
            type: "POST",
            data: {
                nombre_institucion: nombre_institucion
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
                        $('#addInstitucionModal').modal('hide');
                        addInstitucionForm.reset();
                        $('#institucionTabla').DataTable().ajax.reload();
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

    $('#editInstitucionForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>