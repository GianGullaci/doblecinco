<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		
			
		$consulta = 'DELETE FROM publicidades WHERE id_publicidad = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
						
		
		
		if (file_exists("../img/publicidades/".$_GET['delete'])){
			delTree("../img/publicidades/".$_GET['delete']);
		}
		
		
		$arr = array ('deleted'=> true);
		echo json_encode($arr);

	}

?>