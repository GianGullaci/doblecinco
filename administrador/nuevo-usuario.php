<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre']) || empty($_POST['txtUsuario']) || empty($_POST['txtContraseña'])){
        header('location: usuarios.php?mensaje=falta');
        exit();
    }

    include_once '../model/conexion.php';
    $nombre = $_POST['txtNombre'];
    $nombre_usuario = $_POST['txtUsuario'];
    $contraseña = $_POST['txtContraseña'];

    $sentencia = $bd->prepare("INSERT INTO admin(nombre_usuario,contraseña,nombre) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$nombre_usuario,$contraseña,$nombre]);

    if ($resultado === TRUE) {
        header('location: usuarios.php?mensaje=registrado');
    } else {
        header('location: usuarios.php?mensaje=error');
        exit();
    }
?>