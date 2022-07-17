<?php
    print_r($_POST);
    if(!isset($_POST['id_equipo'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_equipo = $_POST['id_equipo'];
    $nombre_equipo = $_POST['txtNombre'];
    $direccion_sede = $_POST['txtSede'];
    $telefono = $_POST['txtTel'];
    $nombre_presidente = $_POST['txtPresidente'];
    $descripcion = $_POST['txtDescripcion'];

    $sentencia = $bd->prepare("UPDATE equipos SET 
                                nombre_equipo = ?, 
                                direccion_sede = ?,
                                telefono_equipo = ?,
                                nombre_presidente = ?,
                                descripcion = ? where id_equipo = ?;");
    $resultado = $sentencia->execute([$nombre_equipo,$direccion_sede,$telefono,$nombre_presidente,$descripcion,$id_equipo]);

    $logo = $_FILES["txtLogo"]["name"];
    $tmpLogo = $_FILES["txtLogo"]["tmp_name"];
    
    if($logo!=""){
        move_uploaded_file($tmpLogo,"../imagenes/".$logo);
        $consulta = $bd->prepare("UPDATE equipos SET 
                                    logo_equipo = ? where id_equipo = ?;");
        $res = $consulta->execute([$logo,$id_equipo]);
    };
    
    if ($resultado === TRUE) {
        header('Location: equipos.php?mensaje=editado');
    } else {
        header('Location: equipos.php?mensaje=error');
        exit();
    }
    
?>