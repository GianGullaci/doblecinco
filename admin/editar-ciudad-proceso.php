<?php
    print_r($_POST);
    if(!isset($_POST['id_ciudad'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_ciudad = $_POST['id_ciudad'];
    $nombre_ciudad = $_POST['txtNombre'];

    $sentencia = $bd->prepare("UPDATE ciudades SET nombre = ? where id_ciudad = ?;");
    $resultado = $sentencia->execute([$nombre_ciudad,$id_ciudad]);

    if ($resultado === TRUE) {
        header('Location: ciudades.php?mensaje=editado');
    } else {
        header('Location: ciudades.php?mensaje=error');
        exit();
    }
    
?>