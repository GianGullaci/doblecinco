<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre']) || empty($_POST['cbTorneos']) || empty($_POST['txtFase'])){
        header('location: fechas.php?mensaje=falta');
        exit();
    }
    
    include_once('../model/conexion.php');
    $nombre_fecha = $_POST['txtNombre'];
    $id_torneo = $_POST['cbTorneos'];
    $fase = $_POST['txtFase'];

    $sentencia = $bd->prepare("INSERT INTO fechas(nombre,torneos_id_torneo1,fase) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$nombre_fecha,$id_torneo,$fase]);

    if ($resultado === TRUE) {
        header('location: fechas.php?mensaje=registrado');
    } else {
        header('location: fechas.php?mensaje=error');
        exit();
    }
    
?>