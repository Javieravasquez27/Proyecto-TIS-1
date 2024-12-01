<?php
    $status = $_GET['status'];
    $buyOrder = $_GET['buyOrder'];
    $amount = $_GET['amount'];

    if ($status == 'success') {
        echo "Pago realizado con éxito. Orden de compra: $buyOrder, Monto: $amount";
    } else {
        echo "Error en el pago.";
    }
?>