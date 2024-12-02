<?php
    include("database/conexion.php");

    if (isset($_SESSION['rut'])) {
        $rut = $_SESSION['rut'];

        $sql_consulta_serv_profesional = "SELECT * FROM servicio_profesional
                                          WHERE rut_profesional = '$rut';";
        $resultado_consulta_serv_profesional = mysqli_query($conexion, $sql_consulta_serv_profesional);
        $fila_serv_profesional = mysqli_fetch_assoc($resultado_consulta_serv_profesional);

        $sql_consulta_profesional = "SELECT profesional.rut, profesion.nombre_profesion, usuario.nombres, 
                                     GROUP_CONCAT(DISTINCT servicio.nombre_servicio ORDER BY servicio.nombre_servicio SEPARATOR '|') AS servicios, 
                                     GROUP_CONCAT(DISTINCT servicio_profesional.precio_serv_prof ORDER BY servicio.nombre_servicio SEPARATOR '|') AS montos,
                                     GROUP_CONCAT(DISTINCT comuna.nombre_comuna ORDER BY comuna.nombre_comuna SEPARATOR '|') AS lugares_atencion 
                                     FROM usuario
                                     JOIN profesional ON profesional.rut = '$_SESSION[rut]'
                                     JOIN profesion ON profesion.id_profesion = profesional.id_profesion
                                     JOIN servicio_profesional ON servicio_profesional.rut_profesional = profesional.rut
                                     JOIN servicio ON servicio.id_servicio = servicio_profesional.id_servicio
                                     JOIN lugar_atencion_presencial ON lugar_atencion_presencial.rut_profesional = profesional.rut
                                     JOIN comuna ON lugar_atencion_presencial.id_comuna = comuna.id_comuna";
        
        $resultado_consulta_profesional = mysqli_query($conexion,$sql_consulta_profesional);
        
        while ($fila_profesional = mysqli_fetch_array($resultado_consulta_profesional)) {
              $servicios = $fila_profesional["servicios"];
              $montos = $fila_profesional["montos"];
              $lugares_atencion = $fila_profesional["lugares_atencion"];
        }
    }
?>

<title>KindomJob's</title>

<script>
    <?php if (($_SESSION['id_rol'] != 4) && (!$fila_serv_profesional)): ?>
        <?php if (empty($servicios) || empty($montos) || empty($lugares_atencion)): ?>
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                color: "#fff",
                background: "#cf142b",
                showConfirmButton: false,
                showCloseButton: true,
                timer: 10000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "warning",
                html: "Para ser mostrado en la búsqueda, <b>tiene que rellenar sus campos de profesional.</b><br><a href='index.php?p=perfil&nombre_usuario=<?php echo $_SESSION['nombre_usuario']; ?>' style='color:#fff;'>Rellene los campos aquí</a>"
            });
        <?php endif; ?>
    <?php endif; ?>
</script>
<script>
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

                    // Rellenar el select con los servicios recibidas
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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<div class="container">
    <div class="row py-5 text-center">
    <p class="h1">Busca profesionales y agenda tu cita aquí</p>
        <form class="d-flex flex-wrap justify-content-center" method="POST" role="search" action="index.php?p=busqueda">
            <div class="row justify-content-center w-100">
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 py-1 mt-lg-4">
                    <select id="profesion" name="profesion" class="form-select">
                        <!-- Las opciones se llenarán aquí con AJAX -->
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 py-1 mt-lg-4">
                    <select id="region" name="region" class="form-select">
                        <!-- Las opciones se llenarán aquí con AJAX -->
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 py-1 mt-lg-4">
                    <select id="provincia" name="provincia" class="form-select">
                        <!-- Las opciones se llenarán aquí con AJAX -->
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 py-1 mt-lg-4">
                    <select id="comuna" name="comuna" class="form-select">
                        <!-- Las opciones se llenarán aquí con AJAX -->
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 py-1 mt-lg-4">
                    <select id="servicio" name="servicio" class="form-select">
                        <!-- Las opciones se llenarán aquí con AJAX -->
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 py-1 mt-lg-4">
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Nombre" aria-label="Search" name="nombreprof">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--
<script>
    $('#profesion').select2({
        width: 'resolve'
    });
    $('#region').select2();
    $('#provincia').select2();
    $('#comuna').select2();
    $('#servicio').select2();
</script>
-->
<div class="container-fluid">
    <div class="row">
        <div class="col text-center mb-1" style="font-size: 20px;">
        <h3>Búsqueda de profesionales cercanos</h3>
            <span>Ingresa una dirección, región o comuna:</span>
            <div class="container mt-2">
                <form id="address-form">
                    <div class="row justify-content-center g-3">
                        <div class="col-8 col-md-6 col-lg-4 col-xl-3">
                            <input type="text" id="address" name="address" class="form-control" placeholder="Ejemplo: Talcahuano" required>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Buscar</button>
                        </div>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>

<div class="container cont_mapa">
        <!-- Mapa Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <br>
        <div id="map"></div>
        <br>
        <p id="result"></p>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>

            document.getElementById('address-form').addEventListener('submit', async (event) => {
                event.preventDefault(); // Evita el envío tradicional del formulario

                const addressInput = document.getElementById('address');
                const address = addressInput.value;

                // Geocodificar la dirección con Nominatim
                const url = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json&limit=1`;
                try {
                    const response = await fetch(url);
                    const data = await response.json();

                    if (data.length > 0) {
                        const location = data[0];
                        const lat = parseFloat(location.lat);
                        const lon = parseFloat(location.lon);

                        // Mostrar la ubicación en el mapa
                        map.setView([lat, lon], 13);
                        
                    } else {
                        document.getElementById('result').innerText = 
                            `No se encontraron resultados para "${address}".`;
                    }
                } catch (error) {
                    console.error("Error en la geocodificación:", error);
                    document.getElementById('result').innerText = 
                        "Ocurrió un error al intentar geolocalizar la dirección.";
                }
            });

            async function geocodeAddresses(addresses) {
                const baseUrl = "https://nominatim.openstreetmap.org/search";
                const locations = [];

                for (const address of addresses) {
                    const url = `${baseUrl}?q=${encodeURIComponent(address)}&format=json&limit=1`;
                    try {
                        const response = await fetch(url);
                        const data = await response.json();
                        if (data.length > 0) {
                            const location = data[0];
                            console.log(`Dirección: ${address}, Coordenadas: ${location.lat}, ${location.lon}`);
                            locations.push({ 
                                address, 
                                lat: parseFloat(location.lat), 
                                lng: parseFloat(location.lon) 
                            });
                        } else {
                            console.error(`No se encontraron coordenadas para la dirección "${address}".`);
                        }
                    } catch (error) {
                        console.error("Error en la solicitud:", error);
                    }
                }
                return locations;
            }

            const map = L.map('map').setView([-36.8258763,-73.1154458], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap & KindomJob´s'
            }).addTo(map);

            setTimeout(() => {
                map.invalidateSize();
            }, 200);
            const addresses = [
                "Avenida Alonso de ribera 2850, concepcion, Chile ",
                "Lientur 1457, Concepción, chile",
                "Avenida Valle Blanco 280, concepcion, Chile"
            ];

            geocodeAddresses(addresses).then(locations => {
                locations.forEach(location => {
                    L.marker([location.lat, location.lng])
                        .addTo(map)
                        .bindPopup(`<b>${location.address}</b><br>Lat: ${location.lat}, Lng: ${location.lng}`)
                        .openPopup();
                });
            });
        </script>
        <style>
            #map {
                width: 100%;
                height: 500px;
            }
        </style>
</div>