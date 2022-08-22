<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	$query = 'SELECT * FROM goles_partidos
		left join jugadores_partidos on jugadores_partidos.jugadores_id_jugador=goles_partidos.jugadores_id_jugador
		WHERE goles_partidos.partidos_id_partido='.$_GET['id_partido'].
		' AND goles_partidos.jugadores_id_jugador='.$_GET['id_jugador'];
   	//echo $query;	
	$result = $mysqli->query($query);
	if ($row = mysqli_fetch_array($result)) {
		$json = array(
			'deleted' => false,
			'razon'=> 'No se puede eliminar el jugador porque ha metido goles en el partido'
		);
		echo json_encode($json);
		exit;
	}
	
	$query = 'SELECT * FROM amonestaciones_partidos
		left join jugadores_partidos on jugadores_partidos.jugadores_id_jugador=amonestaciones_partidos.jugadores_id_jugador
		WHERE amonestaciones_partidos.partidos_id_partido='.$_GET['id_partido'].
		' AND amonestaciones_partidos.jugadores_id_jugador='.$_GET['id_jugador'];
   	//echo $query;	
	$result = $mysqli->query($query);
	if ($row = mysqli_fetch_array($result)) {
		$json = array(
			'deleted' => false,
			'razon'=> 'No se puede eliminar el jugador porque posee amonestaciones en el partido'
		);
		echo json_encode($json);
		exit;
	}
		
	$consulta = 'DELETE FROM jugadores_partidos 
	WHERE partidos_id_partido='.$_GET['id_partido'] .
	' AND jugadores_id_jugador='.$_GET['id_jugador'];
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'deleted' => true
	      );
	
	echo json_encode($json);

?>