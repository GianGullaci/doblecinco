<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM partidos where equipos_id_equipo=".(int)$_GET['delete']." OR equipos_id_equipo=1".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
		  $arr = array ('deleted'=> false, 'razon'=>'(posee partidos asociados)');
		  echo json_encode($arr);
		}
		else{
			
			$query = "SELECT * FROM equipos_notas where equipos_id_equipo=".(int)$_GET['delete'];
			$result = $mysqli->query($query); 
			if($row = mysqli_fetch_array($result)) {
				$arr = array ('deleted'=> false, 'razon'=>'(posee notas asociadas)');
				echo json_encode($arr);
			}
			else{
				$consulta = 'DELETE FROM equipos WHERE id_equipo = '.(int)$_GET['delete'];
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
				$sentencia->close();
				$arr = array ('deleted'=> true, 'razon'=>'');
				echo json_encode($arr);
			}
		}

	}

?>