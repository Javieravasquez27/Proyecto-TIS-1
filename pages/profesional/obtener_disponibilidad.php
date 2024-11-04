<?php
    include 'database/conexion.php';

    session_start();
    $query = "SELECT nombre_usuario FROM usuario WHERE rut = '$_SESSION[rut]'";
    $resultado = mysqli_query($conexion, $query);
    $user = mysqli_fetch_assoc($resultado);

    $nombre_usuario = $user["nombre_usuario"]; // Cambia este ID según el profesional
    $consulta = "SELECT fecha, hora FROM disponibilidad WHERE nombre_usuario = '$nombre_usuario' AND disponible = TRUE ORDER BY fecha, hora";
    $resultado = $conexion->query($consulta);

    $disponibilidad = [];
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $fecha = $fila['fecha'];
            $hora = $fila['hora'];

            if (!isset($disponibilidad[$fecha])) {
                $disponibilidad[$fecha] = [];
            }
            $disponibilidad[$fecha][] = $hora;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($disponibilidad);

    $conexion->close();
?>