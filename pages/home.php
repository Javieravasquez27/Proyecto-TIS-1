<title>KindomJob's</title>

<script>
    <?php $query="SELECT profesional.rut, profesion.nombre_profesion, usuario.nombres, 
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
              $result=mysqli_query($conexion,$query);
              while($row=mysqli_fetch_array($result)){
                    $servicios=$row["servicios"];
                    $montos=$row["montos"];
                    $lugares_atencion=$row["lugares_atencion"];
              }
    ?>
    <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 3): ?>
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
                html: "Para ser mostrado en la búsqueda, <b>tiene que rellenar sus campos de profesional.</b><br><a href='index.php?p=profile' style='color:#fff;'>Rellene los campos aquí</a>"
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

                    // Rellenar el select con las servicios recibidas
                    data.forEach(horario => {
                        const option = document.createElement("option");
                        option.value = horario.nombre_horario;
                        option.textContent = horario.id_th;
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container">
    <div class="row py-5 text-center">
    <p class="h1">Busca profesionales y agenda tu cita aquí</p>
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
<script>
    $('#profesion').select2({
        width: 'resolve'
    });
    $('#region').select2();
    $('#provincia').select2();
    $('#comuna').select2();
    $('#servicio').select2();
</script>
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