<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de roles - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_rol = $(this).data('id'); // ID específico del botón presionado
        const nombre_rol = $(this).data('rol');

        // Se guarda el ID en un campo oculto del formulario
        $('#editRolForm').data('id', id_rol);

        // Se rellena el campo del nombre del rol
        $('#nombre_rol_edit').val(nombre_rol);
    });

    function guardarEdicion() {
        const id_rol = $('#editRolForm').data('id'); // ID del rol desde el formulario
        const nombre_rol = $('#nombre_rol_edit').val();

        // Se validan datos antes de enviar
        if (!nombre_rol) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/rol/update.php",
            type: "POST",
            data: {
                id_rol: id_rol,
                nombre_rol: nombre_rol
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editRolModal').modal('hide');
                        $('#rolTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de roles</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addRolModal">
                        Ingresar nuevo rol
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="rolTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addRolModal" tabindex="-1" aria-labelledby="addRolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRolModalLabel">Ingresar nuevo rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRolForm">
                    <div class="mb-3">
                        <label for="nombre_rol" class="form-label">Rol</label>
                        <input type="text" class="form-control" id="nombre_rol" name="nombre_rol"
                            placeholder="Ingrese el nombre del nuevo rol" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addRolForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editRolModal" tabindex="-1" aria-labelledby="editRolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRolModalLabel">Editar rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRolForm">
                    <div class="mb-3">
                        <label for="nombre_rol_edit" class="form-label">Rol</label>
                        <input type="text" class="form-control" id="nombre_rol_edit" name="nombre_rol_edit"
                            placeholder="Ingrese el nuevo nombre para el rol" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editRolForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#rolTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/rol/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_rol"
            },
            {
                "data": "nombre_rol"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_rol = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar este rol?",
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
                    url: "api/mantenedores/rol/delete.php",
                    type: "POST",
                    data: {
                        id_rol: id_rol
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
                                $('#rolTabla').DataTable().ajax.reload();
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

    const addRolForm = document.querySelector("#addRolForm");

    addRolForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_rol = document.querySelector("#nombre_rol").value;

        $.ajax({
            url: "api/mantenedores/rol/create.php",
            type: "POST",
            data: {
                nombre_rol: nombre_rol
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
                        $('#addRolModal').modal('hide');
                        addRolForm.reset();
                        $('#rolTabla').DataTable().ajax.reload();
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

    $('#editRolForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>