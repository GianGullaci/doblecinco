<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
		$fecha = "NULL";
		if ($_GET['dia']!="" and $_GET['dia']!=NULL){
			$dt = DateTime::createFromFormat('d-m-Y', $_GET['dia']);
			$fecha = $dt->format('Y-m-d');
		}
		
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_GET['descripcion']);
		$consulta = 'UPDATE partidos SET
		arbitros_id_arbitro= '.$_GET['arbitro'].',
		arbitros_id_arbitro1= '.$_GET['arbitro1'].',
		arbitros_id_arbitro2= '.$_GET['arbitro2'].',
		hora_partido= "'.$_GET['hora'].'", 
		fecha_partido="'.$fecha.'" , 
		lugares_id_lugar= '.$_GET['lugar'].', 
		galerias_id_galeria= '.$_GET['galeria'].', 
		zona= "'.$_GET['zona'].'", 
		face_album= "'.$_GET['face_album'].'", 
		flickr_album= "'.$_GET['flickr_album'].'", 
		fechas_id_fecha= '.$_GET['fecha'].', 
		descripcion="'.base64_encode($txt).'" 
		WHERE id_partido='.$_GET['id'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		$json = array(
			'error' => false,
			'mensaje_error' => ''
		      );

	echo json_encode($json);

?>