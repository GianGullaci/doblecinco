<?php
    if(!isset($_GET['id_equipo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_equipo = $_GET['id_equipo'];

    $sentencia = $bd->prepare("DELETE FROM equipos where id_equipo = ?;");
    $resultado = $sentencia->execute([$id_equipo]);

    if ($resultado === TRUE) {
        header('Location: equipos.php?mensaje=eliminado');
    } else {
        header('Location: equipos.php?mensaje=error');
        exit();
    }
    
?>