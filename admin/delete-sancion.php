<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	
		
	$consulta = 'DELETE FROM sanciones_equipos_torneo 
	WHERE id_sancion='.$_GET['delete'];
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'deleted' => true
	      );
	
	echo json_encode($json);

?>