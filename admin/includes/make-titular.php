<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$query = 'SELECT count(*) as cantidad_equipo FROM jugadores_partidos 
		WHERE partidos_id_partido='.$_GET['id_partido'].
		' AND equipos_id_equipo='.$_GET['id_equipo'].
		' AND titular=1';
//   	echo $query;	
	$result = $mysqli->query($query);
	if ($row = mysqli_fetch_array($result)) {
		if ($row['cantidad_equipo']>=11){
			$json = array(
				'modificado' => false,
				'razon'=> 'Ya existen 11 titulares'
			);
			echo json_encode($json);
			exit;
		}
		else{
		      //chequeamos la posicion,porque no puede hacer titular a uno que este en la misma posicion que otro titular
		      $posicion = $_GET['posicion'];
		      if ($posicion!=0){
			      $query = 'SELECT * FROM jugadores_partidos 
				      WHERE partidos_id_partido='.$_GET['id_partido'].
				      ' AND equipos_id_equipo='.$_GET['id_equipo'].
				      ' AND posicion='.$posicion.
				      ' AND titular=1' ;
		      //   	echo $query;	
			      $result = $mysqli->query($query);
			      if ($row = mysqli_fetch_array($result)) {
				      $json = array(
					      'modificado' => false,
					      'razon'=> 'Ya existe un titular es esa posicion'
				      );
				      echo json_encode($json);
				      exit;
			      }
		      }
		}
	}
	
	$consulta = 'UPDATE jugadores_partidos SET
	titular= 1 
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