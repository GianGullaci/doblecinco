<?php
    if(!isset($_GET['id_ciudad'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include '../model/conexion.php';
    $id_ciudad = $_GET['id_ciudad'];

    $sentencia = $bd->query("SELECT * FROM jugadores where ciudades_id_ciudad = $id_ciudad;");
    $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
    if (!empty($resultado)) {
        header('Location: ciudades.php?mensaje=JugadoresAsociados');
        exit();
    }
    else{
        $sentencia = $bd->prepare("DELETE FROM ciudades where id_ciudad = ?;");
        $resultado = $sentencia->execute([$id_ciudad]);
        if ($resultado === true) {
            header('Location: ciudades.php?mensaje=eliminado');
        } else {
            header('Location: ciudades.php?mensaje=error');
            exit();
        }
    }
?>