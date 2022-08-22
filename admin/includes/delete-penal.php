<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
		
	$consulta = 'DELETE FROM penales_partidos 
	WHERE id_penales_partidos='.$_GET['id_penal'];
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'deleted' => true
	      );
	
	echo json_encode($json);

?>