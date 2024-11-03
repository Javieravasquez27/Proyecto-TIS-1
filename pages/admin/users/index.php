<?php
    include("middleware/auth.php");
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar comunas usando AJAX
        function cargarComunas() {
            fetch("utils/get_comuna.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("comuna");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione una comuna";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las comunas recibidas
                    data.forEach(comuna => {
                        const option = document.createElement("option");
                        option.value = comuna.id_comuna;
                        option.textContent = comuna.nombre_comuna;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar comunas:", error));
        }

        // Llamar a la función para cargar comunas al cargar la página
        cargarComunas();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar roles usando AJAX
        function cargarRoles() {
            fetch("utils/get_rol_create.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("rol");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione un rol";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con los roles recibidos
                    data.forEach(rol => {
                        const option = document.createElement("option");
                        option.value = rol.id_rol;
                        option.textContent = rol.nombre_rol;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar roles:", error));
        }

        // Llamar a la función para cargar roles al cargar la página
        cargarRoles();
    });
</script>

<h1 class="text-center my-5">Gestión de usuarios</h1>

<main class="container mt-5">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center">

                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        Agregar nuevo
                    </button>
                    <!-- <a class="btn btn-sm btn-primary" href="index.php?p=users/create" role="button">Agregar nuevo</a> -->
                </div>
            </div>
        </div>
        <div class="card-body table-responsive ">
            <table id="userTable" class="table table-hover" style="width:100%">
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
                        <th scope="col">Opciones</th>
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
                <h5 class="modal-title" id="addUserModalLabel">Agregar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label for="rut" class="form-label">RUT</label>
                        <input type="text" class="form-control" id="rut" name="rut" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_p" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellido_p" name="apellido_p" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_m" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellido_m" name="apellido_m" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="comuna" class="form-label">Comuna</label>
                        <select id="comuna" name="comuna" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_password" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select id="rol" name="rol" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>   
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="addUserForm" class="btn btn-primary">Agregar</button>
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
                "url": "api/users/users.php",
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
    });


    $(document).on('click', '#delete', function() {
        const rut = $(this).data("id");

        Swal.fire({
            title: "¿Estás seguro de eliminar este usuario?",
            text: "¡No podrás revertir esta accion!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "api/users/delete.php",
                    type: "POST",
                    data: {
                        rut: rut
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            Swal.fire({
                                icon: 'success',
                                title: result.message,
                                timer: 1500,
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "Aceptar",
                                allowOutsideClick: false,
                            }).then(() => {
                                $('#userTable').DataTable().ajax.reload();
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

    const addUserForm = document.querySelector("#addUserForm");

    addUserForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const rut = document.querySelector("#rut").value;
        const nombre_usuario = document.querySelector("#nombre_usuario").value;
        const nombres = document.querySelector("#nombres").value;
        const apellido_p = document.querySelector("#apellido_p").value;
        const apellido_m = document.querySelector("#apellido_m").value;
        const correo = document.querySelector("#correo").value;
        const telefono = document.querySelector("#telefono").value;
        const fecha_nac = document.querySelector("#fecha_nac").value;
        const direccion = document.querySelector("#direccion").value;
        const comuna = document.querySelector("#comuna").value;
        const password = document.querySelector("#password").value;
        const confirmar_password = document.querySelector("#confirmar_password").value;
        const rol = document.querySelector("#rol").value;

        if (password !== confirmar_password) {
            Swal.fire({
                icon: 'error',
                title: 'Las contraseñas no coinciden',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        $.ajax({
            url: "api/users/create.php",
            type: "POST",
            data: {
                rut: rut,
                nombre_usuario: nombre_usuario,
                nombres: nombres,
                apellido_p: apellido_p,
                apellido_m: apellido_m,
                correo: correo,
                telefono: telefono,
                fecha_nac: fecha_nac,
                direccion: direccion,
                comuna: comuna,
                password: password,
                rol: rol
            },
            success: function(response) {
                const result = JSON.parse(response);
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: result.message,
                        timer: 1500,
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar",
                        allowOutsideClick: false,
                    }).then(() => {
                        $('#addUserModal').modal('hide');
                        addUserForm.reset();
                        $('#userTable').DataTable().ajax.reload();
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

</script>