<?php
    if(empty($_POST['oculto']) || empty($_POST['txtNombre'])){
        header('location: autores.php?mensaje=falta');
        exit();
    }

    include_once '../model/conexion.php';
    $nombre_autor = $_POST['txtNombre'];
    $titulo = $_POST['txtTitulo'];
    $email = $_POST['txtEmail'];

    $sentencia = $bd->prepare("INSERT INTO autores (nombre_autor, titulo_autor, email) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$nombre_autor,$titulo,$email]);

    $id_autor = $bd->lastInsertId();

    $foto = $_FILES["imgFoto"]["name"];
    $tmpFoto = $_FILES["imgFoto"]["tmp_name"];
    mkdir("../img/autores/".$id_autor, 0777, true);
	chmod("../img/autores/".$id_autor, 0777);
    
    if($foto!=""){
        move_uploaded_file($tmpFoto,"../img/autores/".$id_autor."/autor.jpg");
        $sentencia = $bd->prepare("UPDATE autores SET foto = 'autor.jpg' WHERE id_autor = $id_autor;");
        $resultado = $sentencia->execute();
    };
    
    if ($resultado === TRUE) {
        header('location: autores.php?mensaje=registrado');
    } else {
        header('location: autores.php?mensaje=error');
        exit();
    }
    
?>