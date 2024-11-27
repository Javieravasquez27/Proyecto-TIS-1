<?php
    // Se obtienen los temas existentes del foro
    $sql_consulta_foro_tema = "SELECT ft.id_tema, ft.titulo_tema, ft.contenido_tema, ft.estado_tema, ft.fecha_creacion, 
                   u.nombres, r.nombre_rol, u.foto_perfil
            FROM foro_tema ft
            JOIN usuario u ON ft.rut_cliente = u.rut
            JOIN rol r ON u.id_rol = r.id_rol
            ORDER BY ft.fecha_creacion DESC;";
    $resultado_consulta_foro_tema = mysqli_query($conexion, $sql_consulta_foro_tema);
?>

<title>Pregunta al Experto - KindomJob's</title>

<div class="container mt-2 p-5">
    <h1 class="mb-4 text-center">Pregunta al Experto</h1>

    <!-- Botón para crear un nuevo tema -->
    <?php if (isset($_SESSION['rut'])): ?>
        <div class="d-flex justify-content-center mb-3">
            <a href="index.php?p=foro/nuevo_tema" class="btn btn-primary">
                <i class="fa fa-plus"></i> Crear Nuevo Tema
            </a>
        </div>
    <?php endif; ?>
    <?php if (!isset($_SESSION['rut'])): ?>
        <div class="alert alert-primary text-center" role="alert">
            <i class="bi bi-info-circle-fill"></i> Debes <a class="alert-link" href="index.php?p=auth/login">iniciar sesión</a> o <a class="alert-link" href="index.php?p=auth/register">registrarte</a> para poder crear un nuevo tema.
        </div>
    <?php endif; ?>

    <!-- Lista de temas -->
    <div class="list-group">
        <?php while ($fila_foro_tema = mysqli_fetch_assoc($resultado_consulta_foro_tema)): ?>
        <a href="index.php?p=foro/tema&id_tema=<?php echo $fila_foro_tema['id_tema']; ?>"
            class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">
                    <?php echo htmlspecialchars($fila_foro_tema['titulo_tema']); ?>
                </h5>
                <small>
                    <?php echo date('d-m-Y H:i', strtotime($fila_foro_tema['fecha_creacion'])); ?>
                </small>
            </div>
            <p class="mb-1">
                <?php echo htmlspecialchars($fila_foro_tema['contenido_tema']); ?>
            </p>
            <small>
                <img src="<?php echo $fila_foro_tema['foto_perfil']; ?>" alt="Perfil" width="30" height="30"
                    class="rounded-circle">
                <?php echo htmlspecialchars($fila_foro_tema['nombres']); ?> (<?php echo htmlspecialchars($fila_foro_tema['nombre_rol']); ?>)
            </small>
        </a>
        <?php endwhile; ?>
    </div>
</div>