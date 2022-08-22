<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	$query = "SELECT * FROM goles_partidos WHERE partidos_id_partido=".$_GET['id_partido']." AND jugadores_id_jugador=".$_GET['jugador']." 
	AND hora='".$_GET['hora']."'";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$json = array(
			'error' => true,
			'mensaje_error' => 'El gol ya está asociado al juego'
		      );
		      
	}
	else {
		
		
		$consulta = 'INSERT INTO goles_partidos (partidos_id_partido, jugadores_id_jugador, equipos_id_equipo, hora, en_contra) VALUES
		('.$_GET['id_partido'].', '.$_GET['jugador'].', '.$_GET['equipo'].', "'.$_GET['hora'].'", '.$_GET['contra'].')';
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		$json = array(
			'error' => false,
			'id_gol' => mysqli_insert_id($mysqli),
			'mensaje_error' => ''
		      );	

	}
	
	echo json_encode($json);

?>