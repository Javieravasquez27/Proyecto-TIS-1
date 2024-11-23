<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de tipos de horario - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_th = $(this).data('id'); // ID específico del botón presionado
        const horario = $(this).data('th');

        // Se guarda el ID en un campo oculto del formulario
        $('#editTipoHorarioForm').data('id', id_th);

        // Se rellena el campo del nombre del tipo de horario
        $('#horario_edit').val(horario);
    });

    function guardarEdicion() {
        const id_th = $('#editTipoHorarioForm').data('id'); // ID del tipo de horario desde el formulario
        const horario = $('#horario_edit').val();

        // Se validan datos antes de enviar
        if (!horario) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/tipo_horario/update.php",
            type: "POST",
            data: {
                id_th: id_th,
                horario: horario
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editTipoHorarioModal').modal('hide');
                        $('#tipoHorarioTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de tipos de horario</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addTipoHorarioModal">
                        Ingresar nuevo tipo de horario
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="tipoHorarioTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo de Horario</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addTipoHorarioModal" tabindex="-1" aria-labelledby="addTipoHorarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTipoHorarioModalLabel">Ingresar nuevo tipo de horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTipoHorarioForm">
                    <div class="mb-3">
                        <label for="horario" class="form-label">Tipo de Horario</label>
                        <input type="time" class="form-control" id="horario" name="horario" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addTipoHorarioForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editTipoHorarioModal" tabindex="-1" aria-labelledby="editTipoHorarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTipoHorarioModalLabel">Editar tipo de horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTipoHorarioForm">
                    <div class="mb-3">
                        <label for="horario_edit" class="form-label">Tipo de Horario</label>
                        <input type="time" class="form-control" id="horario_edit" name="horario_edit" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editTipoHorarioForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#tipoHorarioTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/tipo_horario/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_th"
            },
            {
                "data": "horario"
            },
            {
                "data": "opciones"
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_th = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar este tipo de horario?",
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
                    url: "api/mantenedores/tipo_horario/delete.php",
                    type: "POST",
                    data: {
                        id_th: id_th
                    },
                    success: function (response) {
                        const result = JSON.pathe(response);
                        if (result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: result.message,
                                timer: 1500,
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false
                            }).then(() => {
                                $('#tipoHorarioTabla').DataTable().ajax.reload();
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

    const addTipoHorarioForm = document.querySelector("#addTipoHorarioForm");

    addTipoHorarioForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const horario = document.querySelector("#horario").value;

        $.ajax({
            url: "api/mantenedores/tipo_horario/create.php",
            type: "POST",
            data: {
                horario: horario
            },
            success: function (response) {
                const result = JSON.pathe(response);
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
                        $('#addTipoHorarioModal').modal('hide');
                        addTipoHorarioForm.reset();
                        $('#tipoHorarioTabla').DataTable().ajax.reload();
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

    $('#editTipoHorarioForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>