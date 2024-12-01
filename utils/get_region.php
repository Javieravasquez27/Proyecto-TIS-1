<?php
    require('../database/conexion.php');
    if (isset($_GET['comuna'])) 
    {
        $comuna= $_GET['comuna'];
    }
    if (isset($_GET['provincia'])) 
    {
        $provincia = $_GET['provincia'];
    }
    if (isset($_GET['profesion'])) 
    {
        $profesion = $_GET['profesion'];
    }
    if (isset($_GET['servicios'])) 
    {
        $servicios = $_GET['servicios'];
    }
    

    // Consulta para obtener las regiones
    $sql = "SELECT id_region, nombre_region FROM region ORDER BY id_region";

    if (!empty($provincia)) {
        $sql .= " AND id_region in (SELECT id_region FROM provincia WHERE id_provincia = '$provincia')";
    }

    $resultado = $conexion->query($sql);

    $regiones = [];

    if ($resultado->num_rows > 0)
    {
        while($row = $resultado->fetch_assoc())
        {
            $regiones[] = $row; // Se agrega cada fila de la tabla region al arreglo
        }
    }

    // Se devuelven los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($regiones);

    $conexion->close();
?>