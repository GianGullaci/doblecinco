<?php
    if(!isset($_GET['id_torneo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include('../model/conexion.php');
    $id_torneo = $_GET['id_nota'];

    
    $sentencia = $bd->prepare("DELETE FROM notas where id_nota = ?;");
    $resultado = $sentencia->execute([$id_nota]);

    $sentencia2 = $bd->prepare("DELETE FROM clubes_notas where notas_id_nota = ?;");
    $resultado2 = $sentencia2->execute([$id_nota]);

    $sentencia3 = $bd->prepare("DELETE FROM categorias_deportivas_notas where notas_id_nota = ?;");
    $resultado3 = $sentencia3->execute([$id_nota]);

    $sentencia4 = $bd->prepare("DELETE FROM publicidades_posicionadas where notas_id_nota = ?;");
    $resultado4 = $sentencia4->execute([$id_nota]);

    if ($resultado === TRUE) {
        header('Location: notas.php?mensaje=eliminado');
    } else {
        header('Location: notas.php?mensaje=error');
        exit();
    }
    
?>