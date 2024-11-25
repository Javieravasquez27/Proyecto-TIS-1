<?php
    define('PERMISO_REQUERIDO', 'mantainers_manage');
    include("middleware/auth.php");
    include 'includes/admin/navbar_mantenedores.php';
?>

<title>Gestión de comunas - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '#edit', function () {
        const id_comuna = $(this).data('id'); // ID específico del botón presionado
        const nombre_comuna = $(this).data('comuna');
        const id_provincia = $(this).data('provincia');

        // Se guarda el ID en un campo oculto del formulario
        $('#editComunaForm').data('id', id_comuna);

        // Se rellena el campo del nombre de la comuna
        $('#nombre_comuna_edit').val(nombre_comuna);

        // Se espera a que las provincias se carguen
        fetch("utils/get_provincia.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("provincia_edit");
                select.innerHTML = '';  // Se limpia el dropdown

                const defaultOption = document.createElement("option");
                defaultOption.textContent = "Seleccione una provincia";
                defaultOption.value = "";
                select.appendChild(defaultOption);

                // Se llena el select con las provincias
                data.forEach(provincia => {
                    const option = document.createElement("option");
                    option.value = provincia.id_provincia;
                    option.textContent = provincia.nombre_provincia;
                    select.appendChild(option);
                });

                // Se selecciona la provincia actual
                $('#provincia_edit').val(id_provincia).change();
            })
            .catch(error => console.error("Error al cargar provincias:", error));
    });


    function cargarProvincias() {
        fetch("utils/get_provincia.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("provincia");
                select.innerHTML = '';  // Se limpia el dropdown

                const defaultOption = document.createElement("option");
                defaultOption.textContent = "Seleccione una provincia";
                defaultOption.value = "";
                select.appendChild(defaultOption);

                data.forEach(provincia => {
                    const option = document.createElement("option");
                    option.value = provincia.id_provincia;
                    option.textContent = provincia.nombre_provincia;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error("Error al cargar provincias:", error));
    }
    cargarProvincias();

    function guardarEdicion() {
        const id_comuna = $('#editComunaForm').data('id'); // ID de la comuna desde el formulario
        const nombre_comuna = $('#nombre_comuna_edit').val();
        const id_provincia = $('#provincia_edit').val();

        // Validar datos antes de enviar
        if (!nombre_comuna || !id_provincia) {
            Swal.fire({
                icon: 'error',
                title: 'No se han completado todos los datos',
                text: 'Por favor, complete todos los campos antes de guardar.'
            });
            return;
        }

        // Enviar datos al servidor
        $.ajax({
            url: "api/mantenedores/comuna/update.php",
            type: "POST",
            data: {
                id_comuna: id_comuna,
                nombre_comuna: nombre_comuna,
                id_provincia: id_provincia
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editComunaModal').modal('hide');
                        $('#comunaTabla').DataTable().ajax.reload();
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

<h1 class="text-center my-5">Gestión de comunas</h1>

<main class="">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addComunaModal">
                        Ingresar nueva comuna
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="comunaTabla" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Comuna</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addComunaModal" tabindex="-1" aria-labelledby="addComunaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addComunaModalLabel">Ingresar nueva comuna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addComunaForm">
                    <div class="mb-3">
                        <label for="nombre_comuna" class="form-label">Comuna</label>
                        <input type="text" class="form-control" id="nombre_comuna" name="nombre_comuna"
                            placeholder="Ingrese el nombre de la nueva comuna" required>
                    </div>
                    <div class="mb-3">
                        <label for="provincia" class="form-label">Provincia</label>
                        <select id="provincia" name="provincia" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addComunaForm" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editComunaModal" tabindex="-1" aria-labelledby="editComunaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editComunaModalLabel">Editar comuna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editComunaForm">
                    <div class="mb-3">
                        <label for="nombre_comuna_edit" class="form-label">Comuna</label>
                        <input type="text" class="form-control" id="nombre_comuna_edit" name="nombre_comuna_edit"
                            placeholder="Ingrese el nuevo nombre para la comuna" required>
                    </div>
                    <div class="mb-3">
                        <label for="provincia_edit" class="form-label">Provincia</label>
                        <select id="provincia_edit" name="provincia_edit" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editComunaForm" class="btn btn-primary">Guardar</button>
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
        const table = $('#comunaTabla').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/mantenedores/comuna/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                "data": "id_comuna"
            },
            {
                "data": "nombre_comuna"
            },
            {
                "data": "provincia"
            },
            {
                "data": "opciones", orderable: false, searchable: false
            }
            ]
        });
    });

    $(document).on('click', '#delete', function () {
        const id_comuna = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar esta comuna?",
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
                    url: "api/mantenedores/comuna/delete.php",
                    type: "POST",
                    data: {
                        id_comuna: id_comuna
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
                                $('#comunaTabla').DataTable().ajax.reload();
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

    const addComunaForm = document.querySelector("#addComunaForm");

    addComunaForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const nombre_comuna = document.querySelector("#nombre_comuna").value;
        const id_provincia = document.querySelector("#provincia").value;

        $.ajax({
            url: "api/mantenedores/comuna/create.php",
            type: "POST",
            data: {
                nombre_comuna: nombre_comuna,
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
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar",
                        allowOutsideClick: false
                    }).then(() => {
                        $('#addComunaModal').modal('hide');
                        addComunaForm.reset();
                        $('#comunaTabla').DataTable().ajax.reload();
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

    $('#editComunaForm').on('submit', function (event) {
        event.preventDefault();
        guardarEdicion();
    });
</script>