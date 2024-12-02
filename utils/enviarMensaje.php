<?php
    include '../database/conexion.php';
    session_start();
    $query = "INSERT INTO mensaje (rut_recibe,rut_envia,contenido_mensaje) 
    VALUES ('".$_POST['rut_recibe']."','".$_POST['rut_envia']."','".$_POST['mensaje']."')";
    $result = mysqli_query($conexion, $query);
?>