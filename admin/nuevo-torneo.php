<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre'])){
        header('location: torneos.php?mensaje=falta');
        exit();
    }

    include_once '../model/conexion.php';
    $nombre_torneo = $_POST['txtNombre'];

    $sentencia = $bd->prepare("INSERT INTO torneos(nombre_torneo) VALUES (?);");
    $resultado = $sentencia->execute([$nombre_torneo]);

    if ($resultado === TRUE) {
        header('location: torneos.php?mensaje=registrado');
    } else {
        header('location: torneos.php?mensaje=error');
        exit();
    }
    
?>