<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre']) || empty($_POST['txtFecha'])){
        header('location: jugadores.php?mensaje=falta');
        exit();
    }
    
    include_once '../model/conexion.php';
    $nombre_jugador = $_POST['txtNombre'];
    $fecha_nacimiento = $_POST['txtFecha'];
    $anio = substr($_POST['txtFecha'],0, +4);
    $id_ciudad = $_POST['cbCiudad'];
    $id_puesto = $_POST['cbPuesto'];
    $id_pierna= $_POST['cbPierna'];
    $id_club= $_POST['cbClub'];
    $equipo_club = $_POST['cbEquipo'];
    $texto = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
    $texto = base64_encode($texto);

    $sentencia = $bd->prepare("INSERT INTO jugadores(nombre_jugador,fecha_nacimiento,anio,puesto_id_puesto, pierna_habil_id_pierna_habil, ciudades_id_ciudad,
    clubes_id_club, equipo_club, descripcion) VALUES (?,?,?,?,?,?,?,?,?);");
    $resultado = $sentencia->execute([$nombre_jugador,$fecha_nacimiento,$anio,$id_puesto,$id_pierna,$id_ciudad,$id_club,$equipo_club,$texto]);

    if ($resultado === TRUE) {
        header('location: jugadores.php?mensaje=registrado');
    } else {
        header('location: jugadores.php?mensaje=error');
        exit();
    }
    
    
?>