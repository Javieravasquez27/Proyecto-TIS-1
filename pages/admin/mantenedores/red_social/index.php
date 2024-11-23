<?php
    define('PERMISO_REQUERIDO', 'Gestionar los mantenedores de la plataforma');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de redes sociales - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_rs = $(this).data('id'); // ID específico del botón presionado
        const nombre_rs = $(this).data('rs');

        // Se guarda el ID en un campo oculto del formulario
        $('#editRedSocialForm').data('id', id_rs);

        // Se rellena el campo del nombre de la red social
        $('#nombre_rs_edit').val(nombre_rs);
    });

    function guardarEdicion() {
        const id_rs = $('#editRedSocialForm').data('id'); // ID de la red social desde el formulario
        const nombre_rs = $('#nombre_rs_edit').val();

        // Se validan datos antes de enviar
        if (!nombre_rs) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, completa todos los campos antes de guardar.'
            });
            return;
        }

        // Se envían datos al servidor
        $.ajax({
            url: "api/mantenedores/red_social/update.php",
            type: "POST",
            data: {
                id_rs: id_rs,
                nombre_rs: nombre_rs
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editRedSocialModal').modal('hide');
                        $('#redSocialTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de redes sociales</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addRedSocialModal">
                        Ingresar nueva red social
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="redSocialTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Red Social</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addRedSocialModal" tabindex="-1" aria-labelledby="addRedSocialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRedSocialModalLabel">Ingresar nueva red social</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRedSocialForm">
                    <div class="mb-3">
                        <label for="nombre_rs" class="form-label">Red Social</label>
                        <input type="text" class="form-control" id="nombre_rs" name="nombre_rs"
                            placeholder="Ingrese el nombre de la nueva red social" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addRedSocialForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editRedSocialModal" tabindex="-1" aria-labelledby="editRedSocialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRedSocialModalLabel">Editar red social</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRedSocialForm">
                    <div class="mb-3">
                        <label for="nombre_rs_edit" class="form-label">Red Social</label>
                        <input type="text" class="form-control" id="nombre_rs_edit" name="nombre_rs_edit"
                            placeholder="Ingrese el nuevo nombre para la red social" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editRedSocialForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#redSocialTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/red_social/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_rs"
            },
            {
                "data": "nombre_rs"
            },
            {
                "data": "opciones"
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_rs = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar esta red social?",
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
                    url: "api/mantenedores/red_social/delete.php",
                    type: "POST",
                    data: {
                        id_rs: id_rs
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
                                $('#redSocialTabla').DataTable().ajax.reload();
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

    const addRedSocialForm = document.querySelector("#addRedSocialForm");

    addRedSocialForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_rs = document.querySelector("#nombre_rs").value;

        $.ajax({
            url: "api/mantenedores/red_social/create.php",
            type: "POST",
            data: {
                nombre_rs: nombre_rs
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
                        $('#addRedSocialModal').modal('hide');
                        addRedSocialForm.reset();
                        $('#redSocialTabla').DataTable().ajax.reload();
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

    $('#editRedSocialForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>