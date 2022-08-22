<?php
    if(!isset($_GET['id_fecha'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_fecha = $_GET['id_fecha'];

    $sentencia = $bd->query("SELECT * FROM partidos where fechas_id_fecha = $id_fecha;");
    $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
    if (!empty($resultado)) {
        header('Location: fechas.php?mensaje=PartidosAsociados');
        exit();
    }
    else{
        $sentencia = $bd->query("SELECT * FROM fechas_notas where fechas_id_fecha = $id_fecha;");
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        if (!empty($resultado)) {
            header('Location: fechas.php?mensaje=PartidosAsociados');
            exit();
        }
        else{
            $sentencia = $bd->prepare("DELETE FROM fechas where id_fecha = ?;");
            $resultado = $sentencia->execute([$id_fecha]);
            if ($resultado === TRUE) {
                header('Location: fechas.php?mensaje=eliminado');
            } else {
                header('Location: fechas.php?mensaje=error');
                exit();
            }
        }
    }
    
?>