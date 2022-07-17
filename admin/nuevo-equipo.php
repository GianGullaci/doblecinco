<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre']) || empty($_POST['txtSede']) || empty($_POST['txtTel']) || empty($_POST['txtPresidente'])){
        header('location: equipos.php?mensaje=falta');
        exit();
    }

    include_once '../model/conexion.php';
    $nombre_equipo = $_POST['txtNombre'];
    $direccion_sede = $_POST['txtSede'];
    $telefono = $_POST['txtTel'];

    $logo = $_FILES["txtLogo"]["name"];
    $tmpLogo = $_FILES["txtLogo"]["tmp_name"];
    
    if($logo!=""){
        move_uploaded_file($tmpLogo,"../imagenes/".$logo);
    };

    $nombre_presidente = $_POST['txtPresidente'];
    $descripcion = $_POST['txtDescripcion'];

    $sentencia = $bd->prepare("INSERT INTO equipos(nombre_equipo,direccion_sede,telefono_equipo,logo_equipo,nombre_presidente,descripcion) VALUES (?,?,?,?,?,?);");
    $resultado = $sentencia->execute([$nombre_equipo,$direccion_sede,$telefono,$logo,$nombre_presidente,$descripcion]);

    if ($resultado === TRUE) {
        header('location: equipos.php?mensaje=registrado');
    } else {
        header('location: equipos.php?mensaje=error');
        exit();
    }
?>