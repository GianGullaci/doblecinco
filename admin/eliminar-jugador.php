<?php
    if(!isset($_GET['id_jugador'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_jugador = $_GET['id_jugador'];

    $sentencia = $bd->prepare("DELETE FROM jugadores where id_jugador = ?;");
    $resultado = $sentencia->execute([$id_jugador]);

    if ($resultado === TRUE) {
        header('Location: jugadores.php?mensaje=eliminado');
    } else {
        header('Location: jugadores.php?mensaje=error');
        exit();
    }
    
?>