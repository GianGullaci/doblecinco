<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM jugadores_notas where jugadores_id_jugador=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
			$arr = array ('deleted'=> false, 'razon'=>'(posee notas asociadas)');
			echo json_encode($arr);
		}
		else{
			$query = "SELECT * FROM jugadores_partidos where jugadores_id_jugador=".(int)$_GET['delete'];
			$result = $mysqli->query($query); 
			if($row = mysqli_fetch_array($result)) {
				$arr = array ('deleted'=> false, 'razon'=>'(posee partidos asociados)');
				echo json_encode($arr);
			}
			else{
				$consulta = 'DELETE FROM jugadores WHERE id_jugador = '.(int)$_GET['delete'];
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
				$sentencia->close();
				delTree("../img/jugadores/".$_GET['delete']);
				$arr = array ('deleted'=> true, 'razon'=>'');
				echo json_encode($arr);
			}
		}
	}

?>