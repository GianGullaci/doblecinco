<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	$query = "SELECT * FROM jugadores_partidos WHERE partidos_id_partido=".$_GET['id_partido']." AND jugadores_id_jugador=".$_GET['id_jugador'];
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$json = array(
			'error' => true,
			'mensaje_error' => 'El jugador ya está asociado al juego'
		      );
		      
	}
	else {
		
		if ($_GET['titular']==1){
			$query = "SELECT count(*) as cantidad_titulares FROM jugadores_partidos WHERE titular=1 AND partidos_id_partido=".$_GET['id_partido']." AND equipos_id_equipo=".$_GET['id_equipo'];
			$result = $mysqli->query($query); 
			if ($row = mysqli_fetch_array($result)) {
				if ($row['cantidad_titulares']>=11){
					$json = array(
						'error' => true,
						'mensaje_error' => 'Ya existen 11 titulares'
					      );
					echo json_encode($json);
					exit;
				}
				
			}
		}
		
		$consulta = 'INSERT INTO jugadores_partidos (partidos_id_partido, jugadores_id_jugador, equipos_id_equipo, puntaje, posicion, titular) VALUES
		('.$_GET['id_partido'].', '.$_GET['id_jugador'].', '.$_GET['id_equipo'].', '.$_GET['puntaje'].', '.$_GET['posicion'].', '.$_GET['titular'].')';
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		$json = array(
			'error' => false,
			'mensaje_error' => ''
		      );	

	}
	
	echo json_encode($json);

?>