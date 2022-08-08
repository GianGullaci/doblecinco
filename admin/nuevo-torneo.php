<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre']) || empty($_POST['txtFechaInicio']) || empty($_POST['txtFechaFin'])){
        header('location: torneos.php?mensaje=falta');
        exit();
    }

    include_once('../model/conexion.php');
    $nombre_torneo = $_POST['txtNombre'];
    $fechaInicio = $_POST['txtFechaInicio'];
    $FechaFin = $_POST['txtFechaFin'];

    $sentencia = $bd->prepare("INSERT INTO torneos(nombre_torneo, fecha_inicio, fecha_fin) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$nombre_torneo,$fechaInicio,$FechaFin]);

    if ($resultado === TRUE) {
        header('location: torneos.php?mensaje=registrado');
    } else {
        header('location: torneos.php?mensaje=error');
        exit();
    }
    
?>