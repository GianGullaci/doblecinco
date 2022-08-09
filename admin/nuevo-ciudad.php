<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre'])){
        header('location: ciudades.php?mensaje=falta');
        exit();
    }

    include_once '../model/conexion.php';
    $nombre_ciudad = $_POST['txtNombre'];

    $sentencia = $bd->prepare("INSERT INTO ciudades(nombre) VALUES (?);");
    $resultado = $sentencia->execute([$nombre_ciudad]);

    if ($resultado === TRUE) {
        header('location: ciudades.php?mensaje=registrado');
    } else {
        header('location: ciudades.php?mensaje=error');
        exit();
    }
    
?>