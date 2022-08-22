<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
		
	$consulta = 'DELETE FROM amonestaciones_partidos 
	WHERE id_amonestaciones_partidos='.$_GET['id_amonestacion'];
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'deleted' => true
	      );
	
	echo json_encode($json);

?>