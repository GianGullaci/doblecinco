<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
		
	$consulta = 'UPDATE partidos SET
	id_equipo_ausente= '.$_GET['equipo'] .' 
	WHERE id_partido='.$_GET['partido'];
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'error' => false
	      );
		
	
	echo json_encode($json);

?>