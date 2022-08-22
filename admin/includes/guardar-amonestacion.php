<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	$query = "SELECT * FROM amonestaciones_partidos WHERE partidos_id_partido=".$_GET['id_partido']." AND jugadores_id_jugador=".$_GET['jugador']." 
	AND tarjeta_roja=".$_GET['tarjeta']." AND hora='".$_GET['hora']."'";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$json = array(
			'error' => true,
			'mensaje_error' => 'La amonestacion ya está asociada al jugador en este juego'
		      );
		      
	}
	else {
		
		
		$consulta = 'INSERT INTO amonestaciones_partidos (partidos_id_partido, jugadores_id_jugador, equipos_id_equipo, tarjeta_roja, hora) VALUES
		('.$_GET['id_partido'].', '.$_GET['jugador'].', '.$_GET['equipo'].', '.$_GET['tarjeta'].', "'.$_GET['hora'].'")';
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		$json = array(
			'error' => false,
			'id_amonestacion' => mysqli_insert_id($mysqli),
			'mensaje_error' => ''
		      );	

	}
	
	echo json_encode($json);

?>