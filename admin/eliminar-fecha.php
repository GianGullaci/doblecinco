<?php
    if(!isset($_GET['id_fecha'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_fecha = $_GET['id_fecha'];

    $sentencia = $bd->prepare("DELETE FROM fechas where id_fecha = ?;");
    $resultado = $sentencia->execute([$id_fecha]);

    if ($resultado === TRUE) {
        header('Location: fechas.php?mensaje=eliminado');
    } else {
        header('Location: fechas.php?mensaje=error');
        exit();
    }
    
?>