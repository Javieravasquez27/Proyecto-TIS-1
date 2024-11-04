<?php
    session_start();
    if(session_destroy()){
        header("Location: ../pag_principal/index.php");
    }
?>