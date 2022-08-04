<?php
    if(!isset($_GET['id_admin'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_admin = $_GET['id_admin'];

    $sentencia = $bd->prepare("DELETE FROM administradores where id_administrador = ?;");
    $resultado = $sentencia->execute([$id_admin]);

    if ($resultado === TRUE) {
        header('Location: usuarios.php?mensaje=eliminado');
    } else {
        header('Location: usuarios.php?mensaje=error');
        exit();
    }
    
?>