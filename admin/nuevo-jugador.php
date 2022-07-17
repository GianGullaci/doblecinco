<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre']) || empty($_POST['txtFecha'])){
        header('location: jugadores.php?mensaje=falta');
        exit();
    }
    
    include_once '../model/conexion.php';
    $nombre_jugador = $_POST['txtNombre'];
    $fecha_nacimiento = $_POST['txtFecha'];
    $id_ciudad = $_POST['cbCiudad'];
    $id_puesto = $_POST['cbPuesto'];
    $id_pierna= $_POST['cbPierna'];
    $id_equipo= $_POST['cbEquipo'];

    $sentencia = $bd->prepare("INSERT INTO jugadores(nombre_jugador,fecha_nacimiento,id_ciudad,id_puesto,id_pierna_habil,id_equipo) VALUES (?,?,?,?,?,?);");
    $resultado = $sentencia->execute([$nombre_jugador,$fecha_nacimiento,$id_ciudad,$id_puesto,$id_pierna,$id_equipo]);

    if ($resultado === TRUE) {
        header('location: jugadores.php?mensaje=registrado');
    } else {
        header('location: jugadores.php?mensaje=error');
        exit();
    }
    
?>