<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
		
	$consulta = 'UPDATE notas SET
	orden_home= 0, home =0
	WHERE id_nota='.$_GET['id_nota'];
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'modificado' => true
	      );
		
	
	echo json_encode($json);

?>