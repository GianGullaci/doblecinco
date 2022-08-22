<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$query = "SELECT jugadores_partidos.equipos_id_equipo as id_equipo, nombre_jugador, puntaje, posicion, anio, titular, jugadores.id_jugador as id_jugador
		FROM jugadores_partidos
		left join partidos on partidos.id_partido=jugadores_partidos.partidos_id_partido
		left join jugadores on jugadores.id_jugador=jugadores_partidos.jugadores_id_jugador
		where jugadores_partidos.partidos_id_partido=".$_GET['id_partido']. " AND jugadores_partidos.jugadores_id_jugador=".$_GET['id_jugador'] ;
    // 	    echo $query;
		$result = $mysqli->query($query); 
		if ($row = mysqli_fetch_array($result)) {
		    $json = array(
			    'nombre_jugador' => $row['nombre_jugador'],
			    'anio_jugador' => $row['anio'],
			    'puntaje' => $row['puntaje'],
			    'posicion' => $row['posicion'],
			    'titular' => $row['titular'],
			    'error' => false
			  );
		}
			
	echo json_encode($json);

?>