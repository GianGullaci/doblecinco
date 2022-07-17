<?php
    session_start();

    session_unset();
    unset($_SESSION['nombre']);
    unset($_SESSION['id_admin']);
    unset($_SESSION['nombre_usuario']);
    session_destroy();

    header("Location: login.php");
    exit;
?>