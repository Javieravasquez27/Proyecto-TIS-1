<?php
    require_once 'middleware/auth.php';
    // define('PERMISO_REQUERIDO', 'foro_topic_create');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo_tema = mysqli_real_escape_string($conexion, $_POST['titulo_tema']);
        $contenido_tema = mysqli_real_escape_string($conexion, $_POST['contenido_tema']);
        $rut_cliente = $_SESSION['rut'];

        $sql_ingreso_foro_tema = "INSERT INTO foro_tema (titulo_tema, contenido_tema, rut_cliente, fecha_creacion, estado_tema)
                                  VALUES ('$titulo_tema', '$contenido_tema', '$rut_cliente', NOW(), 'abierto');";

        if (mysqli_query($conexion, $sql_ingreso_foro_tema)) {
            header('Location: index.php?p=foro/index');
            exit();
        } else {
            echo "Error: " . mysqli_error($conexion);
        }
    }
?>

<title>Nuevo Tema - Pregunta al Experto - KindomJob's</title>

<div class="container mt-2 p-5">
    <h1 class="mb-4 text-center">Crear Nuevo Tema</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="titulo_tema" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo_tema" name="titulo_tema" required>
        </div>
        <div class="mb-3">
            <label for="contenido_tema" class="form-label">Descripción</label>
            <textarea class="form-control" id="contenido_tema" name="contenido_tema" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear Tema</button>
    </form>
</div>