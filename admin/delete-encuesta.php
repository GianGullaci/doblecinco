<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		
		
		$consulta = 'DELETE FROM encuestas WHERE id_encuesta = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
		
		$consulta = 'DELETE FROM opciones_encuesta WHERE encuestas_id_encuesta = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
		
		$arr = array ('deleted'=> true, 'razon'=>'');
		echo json_encode($arr);
	      
	}

?>