<?php
    if(!isset($_GET['id_partido'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_partido = $_GET['id_partido'];

    $sentencia = $bd->prepare("DELETE FROM partidos where id_partido = ?;");
    $resultado = $sentencia->execute([$id_partido]);

    if ($resultado === TRUE) {
        header('Location: partidos.php?mensaje=eliminado');
    } else {
        header('Location: partidos.php?mensaje=error');
        exit();
    }
    
?>