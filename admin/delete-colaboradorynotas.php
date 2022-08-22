<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$consulta = "DELETE FROM notas where colaboradores_id_colaborador=".(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		$consulta = 'DELETE FROM colaboradores WHERE id_colaborador = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		$arr = array ('deleted'=> true);
		echo json_encode($arr);
	}

?>