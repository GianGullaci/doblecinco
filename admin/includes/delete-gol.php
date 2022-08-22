<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
		
	$consulta = 'DELETE FROM goles_partidos 
	WHERE id_goles_partidos='.$_GET['id_gol'];
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'deleted' => true
	      );
	
	echo json_encode($json);

?>