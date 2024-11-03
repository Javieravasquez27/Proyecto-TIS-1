<?php
// Descomentar linea 3 si es que se quiere usar la autenticación para esta página
// require("database/auth.php");
?>

<title>KindomJob's</title>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar profesiones usando AJAX
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

        // Llamar a la función para cargar profesiones al cargar la página
        cargarProfesiones();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar regiones usando AJAX
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

        // Llamar a la función para cargar regiones al cargar la página
        cargarRegiones();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar ciudades usando AJAX
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

        // Llamar a la función para cargar ciudades al cargar la página
        cargarCiudades();
    });
</script>
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

        // Llamar a la función para cargar comunas al cargar la página
        cargarComunas();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para cargar servicios usando AJAX
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

        // Llamar a la función para cargar servicios al cargar la página
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
                        <form class="d-flex" role="search">
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
                    <iframe class="mapa" src="https://locatestore.com/WcoXme" style="border:none;width:100%;height:300px" allow="geolocation"></iframe>
                </div>
                <dic class="col-2"></dic>
            </div>
        </div>
            
    </div>