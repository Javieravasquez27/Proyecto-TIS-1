<title>KindomJob's</title>

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        color: "#fff",
        background: "#cf142b",
        showConfirmButton: false,
        timer: 10000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "warning",
        html: "Para ser mostrado en la búsqueda, <b>tienes que rellenar tus campos de profesional. </b><a href='index.php?p=profesional/profile' style='color:#fff;'>Rellene los campos aqui</a>"
    });



    document.addEventListener("DOMContentLoaded", function () {
        function cargarRegiones() {
            fetch("utils/get_region.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("region");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Región";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las regiones recibidas
                    data.forEach(region => {
                        const option = document.createElement("option");
                        option.value = region.id_region;
                        option.textContent = region.nombre_region;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar regiones:", error));
        }

        function cargarProvincias() {
            fetch("utils/get_provincia.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("provincia");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Provincia";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las provincias recibidas
                    data.forEach(provincia => {
                        const option = document.createElement("option");
                        option.value = provincia.id_provincia;
                        option.textContent = provincia.nombre_provincia;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar provincias:", error));
        }

        function cargarComunas() {
            fetch("utils/get_comuna.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("comuna");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Comuna";
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

        function cargarProfesiones() {
            fetch("utils/get_profesion.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("profesion");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Profesión";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las profesiones recibidas
                    data.forEach(profesion => {
                        const option = document.createElement("option");
                        option.value = profesion.id_profesion;
                        option.textContent = profesion.nombre_profesion;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar profesiones:", error));
        }

        function cargarInstituciones() {
            fetch("utils/get_institucion.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("institucion");
                    select.innerHTML = '';
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione una institución";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);
                    data.forEach(institucion => {
                        const option = document.createElement("option");
                        option.value = institucion.id_institucion;
                        option.textContent = institucion.nombre_institucion;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar instituciones:", error));
        }

        function cargarServicios() {
            fetch("utils/get_servicio.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("servicio");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Servicio";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las servicios recibidas
                    data.forEach(servicio => {
                        const option = document.createElement("option");
                        option.value = servicio.id_servicio;
                        option.textContent = servicio.nombre_servicio;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar servicios:", error));
        }

        cargarRegiones();
        cargarProvincias();
        cargarComunas();
        cargarProfesiones();
        cargarServicios();
    });
</script>

<div class="container">
    <div class="row py-5 text-center">
        <p class="h4">Busca profesionales y agenda tu cita aquí</p>
        <form class="d-flex" method="POST" role="search" action="index.php?p=busqueda">
            <div class="col">
                <div class="row py-3">
                    <div class="col py-5 px-1 mt-4">
                        <select id="profesion" name="profesion" class="form-select">
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="region" name="region" class="form-select">
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="provincia" name="provincia" class="form-select">
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="comuna" name="comuna" class="form-select">
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="servicio" name="servicio" class="form-select">
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4 input-group">
                        <input class="form-control" type="search" placeholder="Nombre" aria-label="Search"
                            name="nombreprof">
                        <button class="btn btn-success " type="submit">Buscar</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col text-center mb-1" style="font-size: 20px;"><span>Busqueda de profesionales cercanos</span></div>
    </div>
</div>

<div class="container cont_mapa">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 mapa">
            <!-- <iframe class="mapa" src="https://locatestore.com/Xh--K4" style="border:none;width:100%;height:300px" allow="geolocation"></iframe> -->
        </div>
        <dic class="col-2"></dic>
    </div>
</div>

</div>