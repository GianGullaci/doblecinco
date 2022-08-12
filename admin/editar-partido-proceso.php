<?php
    if(!isset($_POST['id_partido'])){
        header('Location: index.php?mensaje=error');
    }

    include '../model/conexion.php';
    $id_partido = $_POST['id_partido'];
    $id_fecha = $_POST['cbFecha'];
    $zona = $_POST['cbZona'];
    $fecha_partido = $_POST['txtDia'];
    $hora_partido = $_POST['txtHora'];
    $categoria = $_POST['cbCategoria'];
    $arbitro = $_POST['cbArbitro'];
    $arbitro1 = $_POST['cbArbitro1'];
    $arbitro2 = $_POST['cbArbitro2'];
    $id_equipo_local = $_POST['cbLocal'];
    $id_equipo_visitante = $_POST['cbVisitante'];
    $galeria = $_POST['cbGaleria'];
    $lugar = $_POST['cbLugar'];
    $txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
    $txt = base64_encode($txt); 

    $sentencia = $bd->prepare("UPDATE partidos SET arbitros_id_arbitro= $arbitro,
    arbitros_id_arbitro1= $arbitro1,
    arbitros_id_arbitro2= $arbitro2,
    hora_partido= $hora_partido, 
    fecha_partido=$fecha_partido, 
    lugares_id_lugar=$lugar, 
    galerias_id_galeria=$galeria, 
    zona= $zona,
    fechas_id_fecha= $id_fecha, 
    descripcion=$txt 
    WHERE id_partido=$id_partido;");
    $resultado = $sentencia->execute();


    if ($resultado === TRUE) {
        header("Location: partidos.php?mensaje=editado");
    } else {
        header('Location: partidos.php?mensaje=error');
        exit();
    }
    
?>