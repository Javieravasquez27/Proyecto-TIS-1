<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de provincias - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_provincia = $(this).data('id'); // ID específico del botón presionado
        const nombre_provincia = $(this).data('provincia');
        const id_region = $(this).data('region');

        // Se guarda el ID en un campo oculto del formulario
        $('#editProvinciaForm').data('id', id_provincia);

        // Se rellena el campo del nombre de la provincia
        $('#nombre_provincia_edit').val(nombre_provincia);

        // Se espera a que las regiones se carguen
        fetch("utils/get_region.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("region_edit");
                select.innerHTML = '';  // Se limpia el dropdown

                const defaultOption = document.createElement("option");
                defaultOption.textContent = "Seleccione una región";
                defaultOption.value = "";
                select.appendChild(defaultOption);

                // Se llena el select con las regiones
                data.forEach(region => {
                    const option = document.createElement("option");
                    option.value = region.id_region;
                    option.textContent = region.nombre_region;
                    select.appendChild(option);
                });

                // Se selecciona la región actual
                $('#region_edit').val(id_region).change();
            })
            .catch(error => console.error("Error al cargar regiones:", error));
    });


    function cargarRegiones() {
        fetch("utils/get_region.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("region");
                select.innerHTML = '';  // Se limpia el dropdown

                const defaultOption = document.createElement("option");
                defaultOption.textContent = "Seleccione una región";
                defaultOption.value = "";
                select.appendChild(defaultOption);

                data.forEach(region => {
                    const option = document.createElement("option");
                    option.value = region.id_region;
                    option.textContent = region.nombre_region;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error("Error al cargar regiones:", error));
    }
    cargarRegiones();

    function guardarEdicion() {
        const id_provincia = $('#editProvinciaForm').data('id'); // ID de la provincia desde el formulario
        const nombre_provincia = $('#nombre_provincia_edit').val();
        const id_region = $('#region_edit').val();

        // Validar datos antes de enviar
        if (!nombre_provincia || !id_region) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, complete todos los campos antes de guardar.'
            });
            return;
        }

        // Enviar datos al servidor
        $.ajax({
            url: "api/mantenedores/provincia/update.php",
            type: "POST",
            data: {
                id_provincia: id_provincia,
                nombre_provincia: nombre_provincia,
                id_region: id_region
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editProvinciaModal').modal('hide');
                        $('#provinciaTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de provincias</h1>

<div class="px-4">
    <main class="">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-center">
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addProvinciaModal">
                            Ingresar nueva provincia
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="provinciaTabla" class="table table-hover" style="width: 100%;">
                    <thead class="">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Provincia</th>
                            <th scope="col">Región</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Modal -->
<div class="modal fade" id="addProvinciaModal" tabindex="-1" aria-labelledby="addProvinciaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProvinciaModalLabel">Ingresar nueva provincia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProvinciaForm">
                    <div class="mb-3">
                        <label for="nombre_provincia" class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="nombre_provincia" name="nombre_provincia"
                            placeholder="Ingrese el nombre de la nueva provincia" required>
                    </div>
                    <div class="mb-3">
                        <label for="region" class="form-label">Región</label>
                        <select id="region" name="region" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addProvinciaForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editProvinciaModal" tabindex="-1" aria-labelledby="editProvinciaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProvinciaModalLabel">Editar provincia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProvinciaForm">
                    <div class="mb-3">
                        <label for="nombre_provincia_edit" class="form-label">Provincia</label>
                        <input type="text" class="form-control" id="nombre_provincia_edit" name="nombre_provincia_edit"
                            placeholder="Ingrese el nuevo nombre para la provincia" required>
                    </div>
                    <div class="mb-3">
                        <label for="region_edit" class="form-label">Región</label>
                        <select id="region_edit" name="region_edit" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editProvinciaForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#provinciaTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/provincia/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_provincia"
            },
            {
                "data": "nombre_provincia"
            },
            {
                "data": "region"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_provincia = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar esta provincia?",
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
                    url: "api/mantenedores/provincia/delete.php",
                    type: "POST",
                    data: {
                        id_provincia: id_provincia
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
                                $('#provinciaTabla').DataTable().ajax.reload();
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

    const addProvinciaForm = document.querySelector("#addProvinciaForm");

    addProvinciaForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_provincia = document.querySelector("#nombre_provincia").value;
        const id_region = document.querySelector("#region").value;

        $.ajax({
            url: "api/mantenedores/provincia/create.php",
            type: "POST",
            data: {
                nombre_provincia: nombre_provincia,
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
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar",
                        allowOutsideClick: false
                    }).then(() => {
                        $('#addProvinciaModal').modal('hide');
                        addProvinciaForm.reset();
                        $('#provinciaTabla').DataTable().ajax.reload();
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

    $('#editProvinciaForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>