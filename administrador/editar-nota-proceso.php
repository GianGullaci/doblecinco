<?php
    if(!isset($_POST['id_nota'])){
        header('Location: index.php?mensaje=error');
    }

    include_once '../model/conexion.php';
    $id_nota = $_POST['id_nota'];

    $txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['editor']);
    
    $sentencia = $bd->prepare("UPDATE notas SET titulo_nota = ?, copete = ?, titulo_galeria = ?, bajada = ?, epigrafe = ?, autores_id_autor = ?, galerias_id_galeria = ?, categorias_notas_id_categoria_notas = ?, texto_nota = ? where id_nota = ?;");
    $resultado = $sentencia->execute([$_POST['txtTitulo'],$_POST['txtCopete'],$_POST['txtTituloGaleria'],$_POST['txtBajada'],$_POST['txtEpigrafe'],$_POST['cbAutor'],$_POST['cbGaleria'],$_POST['cbCategoriaNota'],base64_encode($txt),$id_nota]);

    //eliminamos las categorias deportivas y las volvemos a insertar
    $sentencia = $bd->prepare("DELETE FROM categorias_deportivas_notas 
    WHERE notas_id_nota = ?;");
    $resultado = $sentencia->execute([$id_nota]);

    //asocio las categorias
    if (isset($_POST['cbCategorias'])){
        foreach($_POST['cbCategorias'] as $cat){
            $sentencia = $bd->prepare("INSERT INTO categorias_deportivas_notas (notas_id_nota, categorias_id_categoria) VALUES (?,?);");
            $resultado = $sentencia->execute([$id_nota,$cat]);
        }
    }

    //eliminamos los clubes y los volvemos a insertar
    $sentencia = $bd->prepare("DELETE FROM clubes_notas 
    WHERE notas_id_nota = ?;");
    $resultado = $sentencia->execute([$id_nota]);

    //asocio los clubes
    if (isset($_POST['cbClubes'])){
        foreach($_POST['cbClubes'] as $club){
            $sentencia = $bd->prepare("INSERT INTO clubes_notas (notas_id_nota, clubes_id_club) VALUES (?,?);");
            $resultado = $sentencia->execute([$id_nota,$club]);
        }
    }

    //eliminamos los torneos y los volvemos a insertar
    $sentencia = $bd->prepare("DELETE FROM torneos_notas 
    WHERE notas_id_nota = ?;");
    $resultado = $sentencia->execute([$id_nota]);

    //asocio los torneos
    if (isset($_POST['cbTorneos'])){
        foreach($_POST['cbTorneos'] as $torneo){
            $sentencia = $bd->prepare("INSERT INTO torneos_notas (notas_id_nota, torneos_id_torneo) VALUES (?,?);");
            $resultado = $sentencia->execute([$id_nota,$torneo]);
        }
    }

    if (!file_exists("../img/notas/".$id_nota)){
        mkdir("../img/notas/".$id_nota, 0777, true);
		chmod("../img/notas/".$id_nota, 0777);
    }

    $principal = $_FILES["imgPrincipal"]["name"];
    $tmpPrincipal = $_FILES["imgPrincipal"]["tmp_name"];
    
    if($principal!=""){
        move_uploaded_file($tmpPrincipal,"../img/notas/".$id."/principal.jpg");
        $sentencia = $bd->prepare("UPDATE notas SET imagen_principal = 'principal.jpg' WHERE id_nota = $id;");
        $resultado = $sentencia->execute();
    };

    $home = $_FILES["imgHome"]["name"];
    $tmpHome = $_FILES["imgHome"]["tmp_name"];
    
    if($home!=""){
        move_uploaded_file($tmpHome,"../img/notas/".$id."/home.jpg");
        $sentencia = $bd->prepare("UPDATE notas SET imagen_home = 'home.jpg' WHERE id_nota = $id;");
        $resultado = $sentencia->execute();
    };

    $home2 = $_FILES["imgHome2"]["name"];
    $tmpHome2 = $_FILES["imgHome2"]["tmp_name"];
    
    if($home2!=""){
        move_uploaded_file($tmpHome2,"../img/notas/".$id_nota."/home2.jpg");
        $sentencia = $bd->prepare("UPDATE notas SET imagen_celular = 'home2.jpg' WHERE id_nota = $id_nota;");
        $resultado = $sentencia->execute();
    };

    //PUBLICIDADES DE LA NOTA
    $sentencia = $bd->prepare("DELETE FROM publicidades_posicionadas WHERE notas_id_nota = $id_nota AND 
    (ubicaciones_id_ubicacion=20 or ubicaciones_id_ubicacion=21 or ubicaciones_id_ubicacion=22 or ubicaciones_id_ubicacion=23);");
    $resultado = $sentencia->execute();

    //Insertamos en E1
    $id_publicidad = $_POST['cbPubliE1'];
    $sentencia = $bd->prepare("INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, notas_id_nota) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$id_publicidad,20,$id_nota]);

    //Insertamos en F1
    $id_publicidad = $_POST['cbPubliF1'];
    $sentencia = $bd->prepare("INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, notas_id_nota) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$id_publicidad,21,$id_nota]);

    //Insertamos en G1
    $id_publicidad = $_POST['cbPubliG1'];
    $sentencia = $bd->prepare("INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, notas_id_nota) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$id_publicidad,22,$id_nota]);

    header("Location: editar-nota.php?id_nota=".$id_nota."&mensaje=editado");
    
?>