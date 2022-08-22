<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	
		
		
	$consulta = 'INSERT INTO penales_partidos (partidos_id_partido, jugadores_id_jugador, equipos_id_equipo, hora) VALUES
	('.$_GET['id_partido'].', '.$_GET['jugador'].', '.$_GET['equipo'].', "'.$_GET['hora'].'")';
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'error' => false,
		'id_penal' => mysqli_insert_id($mysqli),
		'mensaje_error' => ''
	      );	

	
	
	echo json_encode($json);

?>