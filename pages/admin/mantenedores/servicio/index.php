<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de servicios - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_servicio = $(this).data('id'); // ID específico del botón presionado
        const nombre_servicio = $(this).data('servicio');

        // Se guarda el ID en un campo oculto del formulario
        $('#editServicioForm').data('id', id_servicio);

        // Se rellena el campo del nombre del servicio
        $('#nombre_servicio_edit').val(nombre_servicio);
    });

    function guardarEdicion() {
        const id_servicio = $('#editServicioForm').data('id'); // ID del servicio desde el formulario
        const nombre_servicio = $('#nombre_servicio_edit').val();

        // Se validan datos antes de enviar
        if (!nombre_servicio) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/servicio/update.php",
            type: "POST",
            data: {
                id_servicio: id_servicio,
                nombre_servicio: nombre_servicio
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editServicioModal').modal('hide');
                        $('#servicioTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de servicios</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addServicioModal">
                        Ingresar nuevo servicio
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="servicioTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Servicio</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addServicioModal" tabindex="-1" aria-labelledby="addServicioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addServicioModalLabel">Ingresar nuevo servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addServicioForm">
                    <div class="mb-3">
                        <label for="nombre_servicio" class="form-label">Servicio</label>
                        <input type="text" class="form-control" id="nombre_servicio" name="nombre_servicio"
                            placeholder="Ingrese el nombre del nuevo servicio" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addServicioForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editServicioModal" tabindex="-1" aria-labelledby="editServicioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServicioModalLabel">Editar servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editServicioForm">
                    <div class="mb-3">
                        <label for="nombre_servicio_edit" class="form-label">Servicio</label>
                        <input type="text" class="form-control" id="nombre_servicio_edit" name="nombre_servicio_edit"
                            placeholder="Ingrese el nuevo nombre para el servicio" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editServicioForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#servicioTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/servicio/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_servicio"
            },
            {
                "data": "nombre_servicio"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_servicio = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar este servicio?",
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
                    url: "api/mantenedores/servicio/delete.php",
                    type: "POST",
                    data: {
                        id_servicio: id_servicio
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
                                $('#servicioTabla').DataTable().ajax.reload();
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

    const addServicioForm = document.querySelector("#addServicioForm");

    addServicioForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_servicio = document.querySelector("#nombre_servicio").value;

        $.ajax({
            url: "api/mantenedores/servicio/create.php",
            type: "POST",
            data: {
                nombre_servicio: nombre_servicio
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
                        $('#addServicioModal').modal('hide');
                        addServicioForm.reset();
                        $('#servicioTabla').DataTable().ajax.reload();
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

    $('#editServicioForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>