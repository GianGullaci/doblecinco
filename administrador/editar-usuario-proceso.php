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

    $sentencia = $bd->prepare("UPDATE administradores SET 
                                nombre_usuario = ?, 
                                password = ?,
                                nombre = ? where id_administrador = ?;");
    $resultado = $sentencia->execute([$nombre_usuario,$contraseña,$nombre,$id_admin]);

    if ($resultado === TRUE) {
        header('Location: usuarios.php?mensaje=editado');
    } else {
        header('Location: usuarios.php?mensaje=error');
        exit();
    }
    
?>