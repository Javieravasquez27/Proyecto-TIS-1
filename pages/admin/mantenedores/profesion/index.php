<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de profesiones - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_profesion = $(this).data('id'); // ID específico del botón presionado
        const nombre_profesion = $(this).data('profesion');

        // Se guarda el ID en un campo oculto del formulario
        $('#editProfesionForm').data('id', id_profesion);

        // Se rellena el campo del nombre de la profesión
        $('#nombre_profesion_edit').val(nombre_profesion);
    });

    function guardarEdicion() {
        const id_profesion = $('#editProfesionForm').data('id'); // ID de la profesión desde el formulario
        const nombre_profesion = $('#nombre_profesion_edit').val();

        // Se validan datos antes de enviar
        if (!nombre_profesion) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/profesion/update.php",
            type: "POST",
            data: {
                id_profesion: id_profesion,
                nombre_profesion: nombre_profesion
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editProfesionModal').modal('hide');
                        $('#profesionTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de profesiones</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addProfesionModal">
                        Ingresar nueva profesión
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="profesionTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Profesión</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addProfesionModal" tabindex="-1" aria-labelledby="addProfesionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProfesionModalLabel">Ingresar nueva profesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProfesionForm">
                    <div class="mb-3">
                        <label for="nombre_profesion" class="form-label">Profesión</label>
                        <input type="text" class="form-control" id="nombre_profesion" name="nombre_profesion"
                            placeholder="Ingrese el nombre de la nueva profesión" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addProfesionForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editProfesionModal" tabindex="-1" aria-labelledby="editProfesionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfesionModalLabel">Editar profesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfesionForm">
                    <div class="mb-3">
                        <label for="nombre_profesion_edit" class="form-label">Profesión</label>
                        <input type="text" class="form-control" id="nombre_profesion_edit" name="nombre_profesion_edit"
                            placeholder="Ingrese el nuevo nombre para la profesión" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editProfesionForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#profesionTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/profesion/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_profesion"
            },
            {
                "data": "nombre_profesion"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_profesion = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar esta profesión?",
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
                    url: "api/mantenedores/profesion/delete.php",
                    type: "POST",
                    data: {
                        id_profesion: id_profesion
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
                                $('#profesionTabla').DataTable().ajax.reload();
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

    const addProfesionForm = document.querySelector("#addProfesionForm");

    addProfesionForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_profesion = document.querySelector("#nombre_profesion").value;

        $.ajax({
            url: "api/mantenedores/profesion/create.php",
            type: "POST",
            data: {
                nombre_profesion: nombre_profesion
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
                        $('#addProfesionModal').modal('hide');
                        addProfesionForm.reset();
                        $('#profesionTabla').DataTable().ajax.reload();
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

    $('#editProfesionForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>