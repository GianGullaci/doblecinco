<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	
		
	$consulta = 'UPDATE publicidades SET archivada=0 
	WHERE id_publicidad='.$_GET['id'];
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'deleted' => true
	      );
	
	echo json_encode($json);

?>