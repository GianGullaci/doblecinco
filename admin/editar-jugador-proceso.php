<?php
    print_r($_POST);
    if(!isset($_POST['id_jugador'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_jugador = $_POST['id_jugador'];
    $nombre_jugador = $_POST['txtNombre'];
    $fecha_nacimiento = $_POST['txtFecha'];
    $id_ciudad = $_POST['cbCiudad'];
    $id_puesto = $_POST['cbPuesto'];
    $id_pierna= $_POST['cbPierna'];
    $id_equipo= $_POST['cbEquipo'];

   

    $sentencia = $bd->prepare("UPDATE jugadores SET nombre_jugador = ?, fecha_nacimiento = ?, id_ciudad = ?, id_puesto = ?, id_pierna_habil = ?, id_equipo = ? where id_jugador = ?;");
    $resultado = $sentencia->execute([$nombre_jugador,$fecha_nacimiento,$id_ciudad,$id_puesto,$id_pierna,$id_equipo,$id_jugador]);


    if ($resultado === TRUE) {
        header('Location: jugadores.php?mensaje=editado');
    } else {
        header('Location: jugadores.php?mensaje=error');
        exit();
    }
    
?>