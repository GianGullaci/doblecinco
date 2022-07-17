<?php
    if(!isset($_GET['id_ciudad'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_ciudad = $_GET['id_ciudad'];

    $sentencia = $bd->prepare("DELETE FROM ciudades where id_ciudad = ?;");
    $resultado = $sentencia->execute([$id_ciudad]);

    if ($resultado === TRUE) {
        header('Location: ciudades.php?mensaje=eliminado');
    } else {
        header('Location: ciudades.php?mensaje=error');
        exit();
    }
    
?>