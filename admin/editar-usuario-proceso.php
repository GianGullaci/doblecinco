<?php
    print_r($_POST);
    if(!isset($_POST['id_admin'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_admin = $_POST['id_admin'];
    $nombre = $_POST['txtNombre'];
    $nombre_usuario = $_POST['txtUsuario'];
    $contraseña = $_POST['txtContraseña'];

    $sentencia = $bd->prepare("UPDATE admin SET 
                                nombre_usuario = ?, 
                                contraseña = ?,
                                nombre = ? where id_admin = ?;");
    $resultado = $sentencia->execute([$nombre_usuario,$contraseña,$nombre,$id_admin]);

    if ($resultado === TRUE) {
        header('Location: usuarios.php?mensaje=editado');
    } else {
        header('Location: usuarios.php?mensaje=error');
        exit();
    }
    
?>