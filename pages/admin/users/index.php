<?php 
    define('PERMISO_REQUERIDO', 'user_accounts_manage');
    include("middleware/auth.php");
?>

<title>Gestión de usuarios - KindomJob's</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    $(document).on('click', '.btn-outline-primary', function() {
        const rut = $(this).data('id');
        const currentRol = $(this).data('rol');

        $('#rut').val(rut);  // Establece el RUT en el modal

        // Cargar roles en el dropdown, filtrando según el rol actual
        cargarRoles(currentRol);
    });

    function cargarRoles(currentRol) {
        fetch("utils/get_rol_create.php")
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("rol");
                select.innerHTML = '';  // Limpiar el dropdown

                const defaultOption = document.createElement("option");
                defaultOption.textContent = "Seleccione un rol";
                defaultOption.value = "";
                select.appendChild(defaultOption);

                // Filtrar roles según el rol actual
                data.forEach(rol => {
                    if (
                        (currentRol == 1) && (rol.id_rol == 2 || rol.id_rol == 4) ||
                        (currentRol == 2) && (rol.id_rol == 4) ||
                        (currentRol == 3) && (rol.id_rol == 2 || rol.id_rol == 4) ||
                        (currentRol == 4) && (rol.id_rol == 2)
                    ) {
                        const option = document.createElement("option");
                        option.value = rol.id_rol;
                        option.textContent = rol.nombre_rol;
                        select.appendChild(option);
                    }
                });
            })
        .catch(error => console.error("Error al cargar roles:", error));
    }
</script>

<h1 class="text-center my-5">Gestión de usuarios</h1>

<main class="">
    <div class="card">
        <div class="card-body table-responsive">
            <table id="userTable" class="table table-hover" style="width: 100%;">
                <thead class="">
                    <tr>
                        <th scope="col">RUT</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellido P.</th>
                        <th scope="col">Apellido M.</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Fecha Nac.</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Comuna</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Cambiar rol de usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="addUserForm" id="addUserForm" action="" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <fieldset disabled>
                            <div class="col">
                                <label for="rut" class="form-label">RUT</label>
                                <input type="text" id="rut" name="rut" class="form-control" readonly>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="rol" class="form-label">Rol</label>
                            <select id="rol" name="rol" class="form-select" required>
                                <!-- Las opciones se llenarán aquí con AJAX -->
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="addUserForm" class="btn btn-primary">Cambiar Rol</button>
            </div>
        </div>
    </div>
</div>

<!-- DataTable -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        const table = $('#userTable').DataTable({
            "language": {
                "url": '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
            "processing": true,
            "ajax": {
                "url": "api/users/read.php",
                "dataType": "json",
                "type": "POST"
            },
            "columns": [{
                    "data": "rut"
                },
                {
                    "data": "nombre_usuario"
                },
                {
                    "data": "nombres"
                },
                {
                    "data": "apellido_p"
                },
                {
                    "data": "apellido_m"
                },
                {
                    "data": "correo"
                },
                {
                    "data": "telefono"
                },
                {
                    "data": "fecha_nac"
                },
                {
                    "data": "direccion"
                },
                {
                    "data": "comuna"
                },
                {
                    "data": "rol"
                },
                {
                    "data": "options"
                }
            ]
        });

        $(document).on('click', '.toggle-status', function() {
            var rut = $(this).data('id');
            var actual_estado_usuario = $(this).data('status');
            var nuevo_estado_usuario = actual_estado_usuario == 1 ? 2 : 1;
            var button = $(this);

            $.ajax({
                url: 'utils/cambio_estado_usuario.php',
                type: 'POST',
                data: { rut: rut, id_estado_usuario: nuevo_estado_usuario },
                success: function(response) {
                    if (response.success) {
                        // Actualizar el botón según el nuevo estado
                        if (nuevo_estado_usuario == 1) {
                            button
                                .removeClass('btn-outline-success')
                                .addClass('btn-outline-danger')
                                .text('Desactivar')
                                .data('status', 1);
                        } else {
                            button
                                .removeClass('btn-outline-danger')
                                .addClass('btn-outline-success')
                                .text('Activar')
                                .data('status', 2);
                        }
                    } else {
                        console.log("Error al cambiar el estado.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error en la solicitud AJAX: " + error);
                }
            });
        });
    });

    $('#addUserForm').submit(function(e) {
        e.preventDefault();
        const rut = $('#rut').val();
        const id_rol = $('#rol').val();

        if (!id_rol) {
            alert("Seleccione un rol.");
            return;
        }

        $.ajax({
            url: 'utils/cambio_rol_usuario.php',
            type: 'POST',
            data: { rut: rut, id_rol: id_rol },
            success: function(response) {
                if (response.success) {
                    $('#addUserModal').modal('hide');
                    $('#userTable').DataTable().ajax.reload();
                } else {
                    alert("Error al cambiar el rol del usuario.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    });
</script>