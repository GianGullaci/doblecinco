<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	//antes de actualizar, tenemos que chequear que no haya otro titular en la misma posicion
	//dependiendo de si el jugador es o no titular
	
	if ($_GET['titular']==1){
		$query = 'SELECT * FROM jugadores_partidos
			WHERE partidos_id_partido = '.$_GET['id_partido'].
			' AND posicion = '.$_GET['posicion'].
			' AND equipos_id_equipo = '.$_GET['id_equipo'].
			' AND jugadores_id_jugador <>'.$_GET['id_jugador'].
			' AND titular=1 ';
		//echo $query;	
		$result = $mysqli->query($query);
		if ($row = mysqli_fetch_array($result)) {
			$json = array(
				'modificado' => false,
				'razon'=> 'Existe otro titular en la misma posicion'
			);
			echo json_encode($json);
			exit;
		}
	}
		
	$consulta = 'UPDATE jugadores_partidos SET
	posicion= '.$_GET['posicion'] .' 
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