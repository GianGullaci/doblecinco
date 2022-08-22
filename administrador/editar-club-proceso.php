<?php
    if(!isset($_POST['id_club'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_club = $_POST['id_club'];
    $nombre_club = $_POST['txtNombre'];
    $fechaInaugura = $_POST['txtFechaInaugura'];
    $direccion_sede = $_POST['txtSede'];
    $direccion_estadio = $_POST['txtEstadio'];
    $direccion_predio = $_POST['txtPredio'];
    $telefono = $_POST['txtTel'];
    $nombre_presidente = $_POST['txtPresidente'];
    $texto = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
    $texto = base64_encode($texto);

    $sentencia = $bd->prepare("UPDATE clubes SET 
                                nombre_club = ?,
                                fecha_inauguracion = ?, 
                                direccion_sede = ?,
                                direccion_estadio = ?,
                                direccion_predio = ?,
                                telefono_club = ?,
                                nombre_presidente = ?,
                                descripcion = ? where id_club = ?;");
    $resultado = $sentencia->execute([$nombre_club,$fechaInaugura,$direccion_sede,$direccion_estadio,$direccion_predio,$telefono,$nombre_presidente,$texto,$id_club]);

    $logo = $_FILES["txtLogo"]["name"];
    $tmpLogo = $_FILES["txtLogo"]["tmp_name"];
    
    if($logo!=""){
        move_uploaded_file($tmpLogo,"../img/clubes/".$id_club."/".$logo);
        $consulta = $bd->prepare("UPDATE clubes SET 
                                    logo_club = ? where id_club = ?;");
        $res = $consulta->execute([$logo,$id_club]);
    };
    
    if ($resultado === TRUE) {
        header('Location: clubes.php?mensaje=editado');
    } else {
        header('Location: clubes.php?mensaje=error');
        exit();
    }
    
?>