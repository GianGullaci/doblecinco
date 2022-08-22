<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		
		
		
		//eliminamos las publicidades
		$consulta = 'DELETE FROM campeones_infantiles WHERE id_campeon= '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
		
		$arr = array ('deleted'=> true, 'razon'=>'');
		echo json_encode($arr);
	      
	}

?>