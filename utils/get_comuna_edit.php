<?php
    require('../database/conexion.php');

    if (isset($_GET['id_comuna'])) {
        $id_comuna = $_GET['id_comuna'];

        try {
            // Obtener los datos de la comuna
            $sql_comuna = "SELECT id_comuna, nombre_comuna, id_provincia FROM comuna WHERE id_comuna = ?";
            $stmt = $conexion->prepare($sql_comuna);
            $stmt->bind_param("i", $id_comuna);
            $stmt->execute();
            $result_comuna = $stmt->get_result();

            if ($result_comuna->num_rows > 0) {
                $comuna = $result_comuna->fetch_assoc();

                // Obtener todas las provincias
                $sql_provincias = "SELECT id_provincia, nombre_provincia FROM provincia";
                $result_provincias = $conexion->query($sql_provincias);

                $provincias = [];
                while ($provincia = $result_provincias->fetch_assoc()) {
                    $provincias[] = $provincia;
                }

                echo json_encode([
                    "success" => true,
                    "id_provincia_actual" => $comuna['id_provincia'],
                    "provincias" => $provincias
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Comuna no encontrada"
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "Error al obtener los datos de la comuna"
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "message" => "ID de comuna no proporcionado"
        ]);
    }
?>