<?php
    print_r($_POST);
    if(!isset($_POST['id_jugador'])){
        header('Location: index.php?mensaje=error');
    }

    include_once '../model/conexion.php';
    $id_jugador = $_POST['id_jugador'];
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

    $sentencia = $bd->prepare("UPDATE jugadores SET nombre_jugador = ?, fecha_nacimiento = ?, anio = ?, puesto_id_puesto = ?, pierna_habil_id_pierna_habil = ?, ciudades_id_ciudad = ?, clubes_id_club = ?, equipo_club = ?, descripcion = ? where id_jugador = ?;");
    $resultado = $sentencia->execute([$nombre_jugador,$fecha_nacimiento,$anio,$id_puesto,$id_pierna,$id_ciudad,$id_club,$equipo_club,$texto,$id_jugador]);


    if ($resultado === TRUE) {
        header('Location: jugadores.php?mensaje=editado');
    } else {
        header('Location: jugadores.php?mensaje=error');
        exit();
    }
    
?>