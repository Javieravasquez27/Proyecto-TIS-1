<?php
    require_once 'middleware/auth.php';
    // define('PERMISO_REQUERIDO', 'foro_access');

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

    // Se obtienen las respuestas del tema
    $sql_consulta_foro_respuesta = "SELECT fr.id_respuesta, fr.contenido_respuesta, fr.fecha_respuesta, 
                                           fr.mejor_respuesta, fr.votos_positivos, fr.votos_negativos,
                                           u.nombres, u.foto_perfil, r.nombre_rol
                                    FROM foro_respuesta fr
                                    JOIN usuario u ON fr.rut_usuario = u.rut
                                    JOIN rol r ON u.id_rol = r.id_rol
                                    WHERE fr.id_tema = $id_tema
                                    ORDER BY fr.votos_positivos DESC, fr.fecha_respuesta ASC;";
    $resultado_consulta_foro_respuesta = mysqli_query($conexion, $sql_consulta_foro_respuesta);
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
        <?php echo htmlspecialchars($fila_foro_tema['nombres']); ?> (
        <?php echo htmlspecialchars($fila_foro_tema['nombre_rol']); ?>)
    </small>

    <div class="mt-4">
        <!-- Select para cambiar el estado del tema -->
        <h4>Estado del Tema: <span id="estado-actual">
                <?php echo ucfirst(htmlspecialchars($fila_foro_tema['estado_tema'])); ?>
            </span></h4>
        <select id="nuevo-estado" class="form-select">
            <option value="abierto" <?php if ($fila_foro_tema['estado_tema']==='abierto' ) echo 'selected' ; ?>>Abierto
            </option>
            <option value="resuelto" <?php if ($fila_foro_tema['estado_tema']==='resuelto' ) echo 'selected' ; ?>
                >Resuelto</option>
            <option value="cerrado" <?php if ($fila_foro_tema['estado_tema']==='cerrado' ) echo 'selected' ; ?>>Cerrado
            </option>
        </select>
    </div>

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

    <div class="mt-4">
        <!-- Formulario para agregar respuesta -->
        <h4>Agregar Respuesta</h4>
        <form id="form-respuesta">
            <textarea id="contenido_respuesta" class="form-control" rows="3" placeholder="Escribe tu respuesta aquí..."
                required></textarea>
            <button type="submit" class="btn btn-primary mt-2">Enviar Respuesta</button>
        </form>
    </div>

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
                                    ${nuevaRespuesta.nombre_usuario} (${nuevaRespuesta.nombre_rol}) · ${nuevaRespuesta.fecha_respuesta}
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
    <h3>Respuestas (<span id="cantidad-respuestas">
            <?php echo $resultado_consulta_foro_respuesta->num_rows; ?>
        </span>)</h3>
    <div class="respuestas">
        <?php while ($fila_foro_respuesta = mysqli_fetch_assoc($resultado_consulta_foro_respuesta)): ?>
        <div class="card mb-3">
            <div class="card-body">
                <p>
                    <?php echo htmlspecialchars($fila_foro_respuesta['contenido_respuesta']); ?>
                </p>
                <small>
                    <img src="<?php echo $fila_foro_respuesta['foto_perfil']; ?>" alt="Perfil" width="30" height="30"
                        class="rounded-circle">
                    <?php echo htmlspecialchars($fila_foro_respuesta['nombres']); ?> (
                    <?php echo htmlspecialchars($fila_foro_respuesta['nombre_rol']); ?>) ·
                    <?php echo date('d-m-Y H:i', strtotime($fila_foro_respuesta['fecha_respuesta'])); ?>
                </small>
                <div class="votos mt-3">
                    <button class="btn btn-success btn-sm votar"
                        data-id="<?php echo $fila_foro_respuesta['id_respuesta']; ?>" data-tipo="positivo">
                        👍
                        <?php echo $fila_foro_respuesta['votos_positivos']; ?>
                    </button>
                    <button class="btn btn-danger btn-sm votar"
                        data-id="<?php echo $fila_foro_respuesta['id_respuesta']; ?>" data-tipo="negativo">
                        👎
                        <?php echo $fila_foro_respuesta['votos_negativos']; ?>
                    </button>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

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
                            // Se actualiza la interfaz: resaltar la mejor respuesta
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