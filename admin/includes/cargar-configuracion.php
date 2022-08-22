<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
		
	$consulta = 'UPDATE partidos SET
	configuracion_local= '.$_GET['conf_local'].',
	configuracion_visitante= '.$_GET['conf_visitante'].'
	WHERE id_partido='.$_GET['id_partido'];
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'error' => false,
		'mensaje_error' => ''
	      );

	
	echo json_encode($json);

?>