<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	if(isset($_GET['id'])) {
		
		$id_seleccionado = $_GET['id'];
		$id_partido = $_GET['id_partido'];		
		
		$query = "SELECT * FROM jugadores_partidos 
		left join partidos on jugadores_partidos.partidos_id_partido=partidos.id_partido
		left join jugadores on jugadores.id_jugador=jugadores_partidos.jugadores_id_jugador
		where jugadores_partidos.equipos_id_equipo=".$id_seleccionado." 
		AND partidos.id_partido=".$id_partido."
		order by nombre_jugador";
		// echo $query;
		$result = $mysqli->query($query); 
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
		    $json[] = array(
		    'id' => $row['id_jugador'],
		    'nombre' => $row['nombre_jugador']
		  );
		}
		echo json_encode($json);
			
	}

?>