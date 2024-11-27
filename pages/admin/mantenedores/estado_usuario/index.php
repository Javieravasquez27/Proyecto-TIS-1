<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de estados de usuario - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_estado_usuario = $(this).data('id'); // ID específico del botón presionado
        const nombre_estado_usuario = $(this).data('estado_usuario');

        // Se guarda el ID en un campo oculto del formulario
        $('#editEstadoUsuarioForm').data('id', id_estado_usuario);

        // Se rellena el campo del nombre del estado de usuario
        $('#nombre_estado_usuario_edit').val(nombre_estado_usuario);
    });

    function guardarEdicion() {
        const id_estado_usuario = $('#editEstadoUsuarioForm').data('id'); // ID del estado de usuario desde el formulario
        const nombre_estado_usuario = $('#nombre_estado_usuario_edit').val();

        // Se validan datos antes de enviar
        if (!nombre_estado_usuario) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/estado_usuario/update.php",
            type: "POST",
            data: {
                id_estado_usuario: id_estado_usuario,
                nombre_estado_usuario: nombre_estado_usuario
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editEstadoUsuarioModal').modal('hide');
                        $('#estadoUsuarioTabka').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de estados de usuario</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addEstadoUsuarioModal">
                        Ingresar nuevo estado de usuario
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="estadoUsuarioTabka" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Estado de Usuario</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addEstadoUsuarioModal" tabindex="-1" aria-labelledby="addEstadoUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEstadoUsuarioModalLabel">Ingresar nuevo estado de usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEstadoUsuarioForm">
                    <div class="mb-3">
                        <label for="nombre_estado_usuario" class="form-label">Estado de Usuario</label>
                        <input type="text" class="form-control" id="nombre_estado_usuario" name="nombre_estado_usuario"
                            placeholder="Ingrese el nombre del nuevo estado de usuario" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addEstadoUsuarioForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editEstadoUsuarioModal" tabindex="-1" aria-labelledby="editEstadoUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEstadoUsuarioModalLabel">Editar estado de usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEstadoUsuarioForm">
                    <div class="mb-3">
                        <label for="nombre_estado_usuario_edit" class="form-label">Estado de Usuario</label>
                        <input type="text" class="form-control" id="nombre_estado_usuario_edit" name="nombre_estado_usuario_edit"
                            placeholder="Ingrese el nuevo nombre para el estado_usuario" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editEstadoUsuarioForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#estadoUsuarioTabka').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/estado_usuario/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_estado_usuario"
            },
            {
                "data": "nombre_estado_usuario"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_estado_usuario = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar este estado de usuario?",
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
                    url: "api/mantenedores/estado_usuario/delete.php",
                    type: "POST",
                    data: {
                        id_estado_usuario: id_estado_usuario
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
                                $('#estadoUsuarioTabka').DataTable().ajax.reload();
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

    const addEstadoUsuarioForm = document.querySelector("#addEstadoUsuarioForm");

    addEstadoUsuarioForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_estado_usuario = document.querySelector("#nombre_estado_usuario").value;

        $.ajax({
            url: "api/mantenedores/estado_usuario/create.php",
            type: "POST",
            data: {
                nombre_estado_usuario: nombre_estado_usuario
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
                        $('#addEstadoUsuarioModal').modal('hide');
                        addEstadoUsuarioForm.reset();
                        $('#estadoUsuarioTabka').DataTable().ajax.reload();
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

    $('#editEstadoUsuarioForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>