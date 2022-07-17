<?php
    print_r($_POST);
    if(!isset($_POST['id_torneo'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_torneo = $_POST['id_torneo'];
    $nombre_torneo = $_POST['txtNombre'];

    $sentencia = $bd->prepare("UPDATE torneos SET nombre_torneo = ? where id_torneo = ?;");
    $resultado = $sentencia->execute([$nombre_torneo,$id_torneo]);

    if ($resultado === TRUE) {
        header('Location: torneos.php?mensaje=editado');
    } else {
        header('Location: torneos.php?mensaje=error');
        exit();
    }
    
?>