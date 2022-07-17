<?php
    if(!isset($_POST['id_partido'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_partido = $_POST['id_partido'];
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

    $sentencia = $bd->prepare("UPDATE partidos SET id_fecha = ?, zona = ?, fecha_partido = ?, hora_partido = ?, id_equipo = ?, id_equipo1 = ? where id_partido = ?;");
    $resultado = $sentencia->execute([$id_fecha,$zona,$fecha_partido,$hora_partido,$id_equipo,$id_equipo1,$id_partido]);


    if ($resultado === TRUE) {
        header("Location: partidos.php?mensaje=editado");
    } else {
        header('Location: partidos.php?mensaje=error');
        exit();
    }
    
?>