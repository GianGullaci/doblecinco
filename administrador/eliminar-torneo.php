<?php
    if(!isset($_GET['id_torneo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include('../model/conexion.php');
    $id_torneo = $_GET['id_torneo'];

    $sentencia = $bd->query("SELECT * FROM fechas where torneos_id_torneo1 = $id_torneo;");
    $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
    if (!empty($resultado)) {
        header('Location: torneos.php?mensaje=FechasAsociadas');
        exit();
    }
    else{
        $sentencia = $bd->query("SELECT * FROM torneos_notas where torneos_id_torneo = $id_torneo;");
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        if (!empty($resultado)) {
            header('Location: torneos.php?mensaje=FechasAsociadas');
            exit();
        }
        else{
            $sentencia = $bd->prepare("DELETE FROM torneos where id_torneo = ?;");
            $resultado = $sentencia->execute([$id_torneo]);
            if ($resultado === TRUE) {
                header('Location: torneos.php?mensaje=eliminado');
            } else {
                header('Location: torneos.php?mensaje=error');
                exit();
            }
        }
    }
    
?>