<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
		
	$consulta = 'UPDATE comentarios SET
	activo =0
	WHERE id_comentario='.$_GET['id_comentario'];
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'modificado' => true
	      );
		
	
	echo json_encode($json);

?>