<?php
    if(empty($_POST['oculto']) || empty($_POST['cbTorneo']) || empty($_POST['cbFecha'])){
        header('location: partidos.php?mensaje=falta');
        exit();
    }
    
    include_once '../model/conexion.php';
    $id_fecha = $_POST['cbFecha'];
    if ($_POST['cbZona'] == 1){
        $zona = 'A';
    } else {
        $zona = 'B';
    };
    $fecha_partido = $_POST['txtDia'];
    $hora_partido = $_POST['txtHora'];
    $id_equipo = $_POST['cbEquipo'];
    $id_equipo1 = $_POST['cbEquipo1'];

    if ($id_equipo != $id_equipo1){
        $sentencia = $bd->prepare("INSERT INTO partidos(fecha_partido,hora_partido,id_fecha,id_equipo,id_equipo1,zona) VALUES (?,?,?,?,?,?);");
        $resultado = $sentencia->execute([$fecha_partido,$hora_partido,$id_fecha,$id_equipo,$id_equipo1,$zona]);
        if ($resultado === TRUE) {
            header('location: partidos.php?mensaje=registrado');
        } else {
            header('location: partidos.php?mensaje=error');
            exit();
        }
    } else{
        header('location: partidos.php?mensaje=equiposIguales');
        exit();
    }
    
    
?>