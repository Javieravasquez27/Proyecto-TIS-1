<?php
include '../database/conexion.php';
session_start();

$rut_recibe = $_POST['rut_recibe'];
$rut_envia = $_POST['rut_envia'];

$query = "SELECT m.contenido_mensaje, u.nombres AS username 
          FROM mensaje m 
          JOIN usuario u ON m.rut_envia = u.rut 
          WHERE (m.rut_recie = '$rut_envia' AND m.rut_envia = '$rut_recibe') 
             OR (m.rut_recive = '$rut_recibe' AND m.rut_envia = '$rut_envia')
          ORDER BY m.id_mensaje ASC";

$resultado = mysqli_query($conexion, $query);

while ($row = mysqli_fetch_assoc($resultado)) {
    if ($_SESSION['rut'] == $rut_envia) {
        echo "<div class='message text-start'>
                <span class='username'>" . htmlspecialchars($row['username']) . ":</span>
                <span class='text'>" . htmlspecialchars($row['contenido_mensaje']) . "</span>
            </div>";
    } else {
        echo "<div class='message text-end'>
                <span class='username'>" . htmlspecialchars($row['username']) . ":</span>
                <span class='text'>" . htmlspecialchars($row['contenido_mensaje']) . "</span>
            </div>";
    }
}
?>