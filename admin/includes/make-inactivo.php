<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	
	$consulta = 'UPDATE clubes SET
	club_activo= 0 
	WHERE id_club='.$_GET['id_club'];
	 //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'modificado' => true
	      );
		
	echo json_encode($json);
	

?>