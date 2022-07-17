<?php
    if(!isset($_GET['id_torneo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_torneo = $_GET['id_torneo'];

    $sentencia = $bd->prepare("DELETE FROM torneos where id_torneo = ?;");
    $resultado = $sentencia->execute([$id_torneo]);

    if ($resultado === TRUE) {
        header('Location: torneos.php?mensaje=eliminado');
    } else {
        header('Location: torneos.php?mensaje=error');
        exit();
    }
    
?>