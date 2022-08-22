<?php
    print_r($_POST);
    if(!isset($_POST['id_fecha'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_fecha = $_POST['id_fecha'];
    $nombre_fecha = $_POST['txtNombre'];
    
    $id_torneo = $_POST['cbTorneos'];
    $fase = $_POST['txtFase'];

    $sentencia = $bd->prepare("UPDATE fechas SET nombre = ?, torneos_id_torneo1 = ?, fase = ? where id_fecha = ?;");
    $resultado = $sentencia->execute([$nombre_fecha,$id_torneo,$fase,$id_fecha]);


    if ($resultado === TRUE) {
        header('Location: fechas.php?mensaje=editado');
    } else {
        header('Location: fechas.php?mensaje=error');
        exit();
    }
    
?>