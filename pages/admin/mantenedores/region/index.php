<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de regiones - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_region = $(this).data('id'); // ID específico del botón presionado
        const nombre_region = $(this).data('region');

        // Se guarda el ID en un campo oculto del formulario
        $('#editRegionForm').data('id', id_region);

        // Se rellena el campo del nombre de la region
        $('#nombre_region_edit').val(nombre_region);
    });

    function guardarEdicion() {
        const id_region = $('#editRegionForm').data('id'); // ID de la región desde el formulario
        const nombre_region = $('#nombre_region_edit').val();

        // Se validan datos antes de enviar
        if (!nombre_region) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/region/update.php",
            type: "POST",
            data: {
                id_region: id_region,
                nombre_region: nombre_region
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editRegionModal').modal('hide');
                        $('#regionTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de regiones</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addRegionModal">
                        Ingresar nueva región
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="regionTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Región</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addRegionModal" tabindex="-1" aria-labelledby="addRegionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRegionModalLabel">Ingresar nueva región</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRegionForm">
                    <div class="mb-3">
                        <label for="nombre_region" class="form-label">Región</label>
                        <input type="text" class="form-control" id="nombre_region" name="nombre_region"
                            placeholder="Ingrese el nombre de la nueva región" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addRegionForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editRegionModal" tabindex="-1" aria-labelledby="editRegionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRegionModalLabel">Editar región</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRegionForm">
                    <div class="mb-3">
                        <label for="nombre_region_edit" class="form-label">Región</label>
                        <input type="text" class="form-control" id="nombre_region_edit" name="nombre_region_edit"
                            placeholder="Ingrese el nuevo nombre para la región" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editRegionForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#regionTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/region/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_region"
            },
            {
                "data": "nombre_region"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_region = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar esta región?",
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
                    url: "api/mantenedores/region/delete.php",
                    type: "POST",
                    data: {
                        id_region: id_region
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
                                $('#regionTabla').DataTable().ajax.reload();
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

    const addRegionForm = document.querySelector("#addRegionForm");

    addRegionForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_region = document.querySelector("#nombre_region").value;

        $.ajax({
            url: "api/mantenedores/region/create.php",
            type: "POST",
            data: {
                nombre_region: nombre_region
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
                        $('#addRegionModal').modal('hide');
                        addRegionForm.reset();
                        $('#regionTabla').DataTable().ajax.reload();
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

    $('#editRegionForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>