<?php
    $id_tema = intval($_GET['id_tema']);

    // Se obtienen los detalles del tema
    $sql_consulta_foro_tema = "SELECT ft.titulo_tema, ft.contenido_tema, ft.estado_tema, ft.fecha_creacion, 
                                      u.nombres, r.nombre_rol, u.foto_perfil
                               FROM foro_tema ft
                               JOIN usuario u ON ft.rut_cliente = u.rut
                               JOIN rol r ON u.id_rol = r.id_rol
                               WHERE ft.id_tema = $id_tema;";
    $resultado_consulta_foro_tema = mysqli_query($conexion, $sql_consulta_foro_tema);
    $fila_foro_tema = mysqli_fetch_assoc($resultado_consulta_foro_tema);

    if (!$fila_foro_tema) {
        header('Location: index.php?p=error/pagina_no_existe.php');
    }
?>

<title>
    <?php echo htmlspecialchars($fila_foro_tema['titulo_tema']); ?> - Pregunta al Experto - KindomJob's
</title>

<div class="container mt-2 p-5">
    <!-- Encabezado del tema -->
    <h1>
        <?php echo htmlspecialchars($fila_foro_tema['titulo_tema']); ?>
    </h1>
    <p>
        <?php echo htmlspecialchars($fila_foro_tema['contenido_tema']); ?>
    </p>
    <small>
        <img src="<?php echo $fila_foro_tema['foto_perfil']; ?>" alt="Perfil" width="30" height="30"
            class="rounded-circle">
        <?php echo htmlspecialchars($fila_foro_tema['nombres']); ?> (<?php echo htmlspecialchars($fila_foro_tema['nombre_rol']); ?>)
        <?php if (!isset($_SESSION['rut'])): ?>
            <div class="mt-3"></div>
        <?php endif; ?>
    </small>

    <?php if (isset($_SESSION['rut'])): ?>
        <div class="mt-4">
            <!-- Select para cambiar el estado del tema -->
            <h4>Estado del Tema: <span id="estado-actual">
                    <?php echo ucfirst(htmlspecialchars($fila_foro_tema['estado_tema'])); ?>
                </span></h4>
            <select id="nuevo-estado" class="form-select">
                <option value="abierto" <?php if ($fila_foro_tema['estado_tema']==='abierto' ) echo 'selected' ; ?>>
                    Abierto
                </option>
                <option value="resuelto" <?php if ($fila_foro_tema['estado_tema']==='resuelto' ) echo 'selected' ; ?>>
                    Resuelto
                </option>
                <option value="cerrado" <?php if ($fila_foro_tema['estado_tema']==='cerrado' ) echo 'selected' ; ?>>
                    Cerrado
                </option>
            </select>
        </div>
    <?php endif; ?>

    <script>
        document.getElementById('nuevo-estado').addEventListener('change', function () {
            const nuevo_estado = this.value;
            const id_tema = <?php echo $id_tema; ?>;

            fetch('api/foro/foro_estado.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ id_tema, nuevo_estado })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('estado-actual').textContent = nuevo_estado;
                    } else {
                        alert(data.mensaje);
                    }
                });
        });
    </script>

    <?php if (isset($_SESSION['rut'])): ?>
        <div class="mt-4">
            <!-- Formulario para agregar respuesta -->
            <h4>Agregar Respuesta</h4>
            <form id="form-respuesta">
                <textarea id="contenido_respuesta" class="form-control" rows="3" placeholder="Escribe tu respuesta aquí..."
                    required></textarea>
                <button type="submit" class="btn btn-primary mt-2">Enviar Respuesta</button>
            </form>
        </div>
    <?php endif; ?>
    <?php if (!isset($_SESSION['rut'])): ?>
        <div class="alert alert-primary text-center" role="alert">
            <i class="bi bi-info-circle-fill"></i> Debes <a class="alert-link" href="index.php?p=auth/login">iniciar sesión</a> o <a class="alert-link" href="index.php?p=auth/register">registrarte</a> para poder enviar una respuesta a este tema.
        </div>
    <?php endif; ?>

    <script>
        document.getElementById('form-respuesta').addEventListener('submit', function (event) {
            event.preventDefault();

            const contenido_respuesta = document.getElementById('contenido_respuesta').value.trim();
            if (!contenido_respuesta) return;

            const id_tema = <?php echo $id_tema; ?>;

            fetch('api/foro/foro_respuesta.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ id_tema, contenido_respuesta })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const nuevaRespuesta = data.respuesta;

                        // Se crea un nuevo elemento HTML para la respuesta
                        const nuevaRespuestaHTML = `
                        <div class="card mb-3" style="background-color: #fffd6e;">
                            <div class="card-body">
                                <p>${nuevaRespuesta.contenido_respuesta}</p>
                                <small>
                                    <img src="${nuevaRespuesta.foto_perfil}" alt="Perfil" width="30" height="30" class="rounded-circle">
                                    ${nuevaRespuesta.nombres} (${nuevaRespuesta.nombre_rol}) · ${nuevaRespuesta.fecha_respuesta}
                                </small>
                                <div class="votos mt-3">
                                    <button class="btn btn-success btn-sm votar" data-id="${nuevaRespuesta.id_respuesta}" data-tipo="positivo">
                                        👍 ${nuevaRespuesta.votos_positivos}
                                    </button>
                                    <button class="btn btn-danger btn-sm votar" data-id="${nuevaRespuesta.id_respuesta}" data-tipo="negativo">
                                        👎 ${nuevaRespuesta.votos_negativos}
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;

                        // Se inserta la nueva respuesta al final de la lista de respuestas
                        const respuestasDiv = document.querySelector('.respuestas');
                        respuestasDiv.insertAdjacentHTML('beforeend', nuevaRespuestaHTML);

                        // Se actualiza contador de respuestas
                        const contadorRespuestas = document.getElementById('cantidad-respuestas');
                        contadorRespuestas.textContent = parseInt(contadorRespuestas.textContent) + 1;

                        // Se limpia el textarea
                        document.getElementById('contenido_respuesta').value = '';
                    } else {
                        alert(data.mensaje);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un problema al enviar la respuesta. Inténtalo de nuevo.');
                });
        });
    </script>

    <hr>
    <!-- Respuestas del tema -->
    <h3>Respuestas (<span id="cantidad-respuestas">0</span>)</h3>
    <div id="lista-respuestas" class="respuestas"></div>
    <div class="text-center mt-3">
        <button id="cargarMas" class="btn btn-primary">Cargar más</button>
    </div>
</div>

<script>
    let offset = 0; // Control de paginación
    const limit = 10; // Número máximo de respuestas por carga
    const idTema = <?php echo $id_tema; ?>;

    function cargarRespuestas() {
        fetch(`api/foro/foro_respuesta.php?id_tema=${idTema}&offset=${offset}&limit=${limit}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const respuestas = data.respuestas;
                    const listaRespuestas = document.getElementById('lista-respuestas');

                    respuestas.forEach(respuesta => {
                        const nuevaRespuestaHTML = `
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <p>${respuesta.contenido_respuesta}</p>
                                        <small>
                                            <img src="${respuesta.foto_perfil}" alt="Perfil" width="30" height="30" class="rounded-circle">
                                            ${respuesta.nombres} (${respuesta.nombre_rol}) · ${respuesta.fecha_respuesta}
                                        </small>
                                        <div class="votos mt-3">
                                            <button class="btn btn-success btn-sm votar" data-id="${respuesta.id_respuesta}" data-tipo="positivo">
                                                👍 ${respuesta.votos_positivos}
                                            </button>
                                            <button class="btn btn-danger btn-sm votar" data-id="${respuesta.id_respuesta}" data-tipo="negativo">
                                                👎 ${respuesta.votos_negativos}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `;
                        listaRespuestas.insertAdjacentHTML('beforeend', nuevaRespuestaHTML);
                    });

                    // Se incrementa el offset
                    offset += respuestas.length;

                    // Se actualiza contador de respuestas
                    const cantidadRespuestas = document.getElementById('cantidad-respuestas');
                    cantidadRespuestas.textContent = parseInt(cantidadRespuestas.textContent) + respuestas.length;

                    // Se oculta el botón si no hay más respuestas
                    if (respuestas.length < limit) {
                        document.getElementById('cargarMas').style.display = 'none';
                    }
                } else {
                    alert('Error al cargar las respuestas.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Se cargan respuestas iniciales
    cargarRespuestas();

    // Event listener para "Cargar más"
    document.getElementById('cargarMas').addEventListener('click', cargarRespuestas);
</script>

<script>
    document.querySelectorAll('.marcar-mejor-respuesta').forEach(button => {
        button.addEventListener('click', function () {
            const id_respuesta = this.getAttribute('data-id');
            const id_tema = <?php echo $id_tema; ?>;

            fetch('api/foro/foro_mejor_respuesta.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ id_respuesta, id_tema })
            })

            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Se actualiza la interfaz, resaltando la mejor respuesta
                    document.querySelectorAll('.badge.bg-success').forEach(badge => badge.remove());
                    this.parentNode.innerHTML += `<span class="badge bg-success mt-2">Mejor Respuesta</span>`;
                } else {
                    alert(data.mensaje);
                }
            });
        });
    });
</script>

<script>
    document.querySelectorAll('.votar').forEach(button => {
        button.addEventListener('click', function () {
            const id_respuesta = this.getAttribute('data-id');
            const tipo_voto = this.getAttribute('data-tipo');

            fetch('api/foro/foro_voto_respuesta.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ id_respuesta, tipo_voto })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Se actualizan los contadores de votos dinámicamente
                        const votos = data.votos;

                        // Se actualiza la UI de los botones al presionarlos (se restablece al recargar la página)
                        const botonesVotos = document.querySelectorAll(`[data-id="${id_respuesta}"]`);
                        botonesVotos.forEach(btn => {
                            if (btn.getAttribute('data-tipo') === 'positivo') {
                                btn.innerHTML = `👍 ${votos.votos_positivos}`;
                            } else if (btn.getAttribute('data-tipo') === 'negativo') {
                                btn.innerHTML = `👎 ${votos.votos_negativos}`;
                            }
                            btn.classList.remove('active'); // Se quitan estilos previos
                            if (btn.getAttribute('data-tipo') === tipo_voto) {
                                btn.classList.add('active'); // Se destaca el voto actual
                            }
                        });
                    } else {
                        alert(data.mensaje);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un problema al procesar el voto. Inténtalo de nuevo.');
                });
        });
    });
</script>

<script>
    document.getElementById('lista-respuestas').addEventListener('click', function (event) {
        if (event.target.classList.contains('votar')) {
            const button = event.target;
            const id_respuesta = button.getAttribute('data-id');
            const tipo_voto = button.getAttribute('data-tipo');
        
            fetch('api/foro/foro_voto_respuesta.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ id_respuesta, tipo_voto })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const votos = data.votos;
                    document.querySelector(`[data-id="${id_respuesta}"][data-tipo="positivo"]`).innerHTML = `👍 ${votos.votos_positivos}`;
                    document.querySelector(`[data-id="${id_respuesta}"][data-tipo="negativo"]`).innerHTML = `👎 ${votos.votos_negativos}`;

                    // Se actualiza la UI de los botones al presionarlos (se restablece al recargar la página)
                    const botonesVotos = document.querySelectorAll(`[data-id="${id_respuesta}"]`);
                        botonesVotos.forEach(btn => {
                            if (btn.getAttribute('data-tipo') === 'positivo') {
                                btn.innerHTML = `👍 ${votos.votos_positivos}`;
                            } else if (btn.getAttribute('data-tipo') === 'negativo') {
                                btn.innerHTML = `👎 ${votos.votos_negativos}`;
                            }
                            btn.classList.remove('active'); // Se quitan estilos previos
                            if (btn.getAttribute('data-tipo') === tipo_voto) {
                                btn.classList.add('active'); // Se destaca el voto actual
                            }
                        });
                } else {
                    alert(data.mensaje);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
</script>