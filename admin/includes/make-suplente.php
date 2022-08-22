<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
		
		$consulta = 'UPDATE jugadores_partidos SET
		titular= 0 
		WHERE partidos_id_partido='.$_GET['id_partido'].
		' AND jugadores_id_jugador='.$_GET['id_jugador'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		$json = array(
			'modificado' => true
		      );
		
	
	echo json_encode($json);

?>