<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		
		
		$consulta = 'DELETE FROM notas WHERE id_nota = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
		
		$consulta = 'DELETE FROM clubes_notas WHERE notas_id_nota = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
		
		$consulta = 'DELETE FROM categorias_deportivas_notas WHERE notas_id_nota = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
		
		//eliminamos las publicidades
		$consulta = 'DELETE FROM publicidades_posicionadas WHERE notas_id_nota= '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
		
		$arr = array ('deleted'=> true, 'razon'=>'');
		echo json_encode($arr);
	      
	}

?>