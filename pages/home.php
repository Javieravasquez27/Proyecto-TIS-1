<title>KindomJob's</title>

<script>
    document.addEventListener("DOMContentLoaded", function() {
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

        function cargarCiudades() {
            fetch("utils/get_ciudad.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("ciudad");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Ciudad";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las ciudades recibidas
                    data.forEach(ciudad => {
                        const option = document.createElement("option");
                        option.value = ciudad.id_ciudad;
                        option.textContent = ciudad.nombre_ciudad;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar ciudades:", error));
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
        cargarCiudades();
        cargarComunas();
        cargarProfesiones();
        cargarServicios();
    });
</script>

<div class="container">
        
        <div class="row py-5">
            <div class="col-1"></div>
            <div class="col-7">
                <div class="row py-3">
                    <div class="col py-5 px-1 mt-4">
                        <select id="profesion" name="profesion" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="region" name="region" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="ciudad" name="ciudad" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="comuna" name="comuna" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="servicio" name="servicio" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>                    
                    
                </div>
            </div>
            <div class="col-3">
                <div class="row py-3">
                    <div class="col py-5 px-1 mt-4">
                        <form class="d-flex" role="search" action="index.php?p=busqueda">
                            <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success " type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
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