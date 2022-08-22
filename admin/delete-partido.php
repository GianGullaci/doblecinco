<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		if (isset($_GET['test']) and $_GET['test']==1){
			$query = "SELECT * FROM jugadores_partidos where partidos_id_partido=".(int)$_GET['delete'];
			$result = $mysqli->query($query); 
			if($row = mysqli_fetch_array($result)) {
			  $arr = array ('candelete'=> false, 'razon'=>'Posee jugadores asociados');
			  echo json_encode($arr);
			}
			else{
				
				$query = "SELECT * FROM goles_partidos where partidos_id_partido=".(int)$_GET['delete'];
				$result = $mysqli->query($query); 
				if($row = mysqli_fetch_array($result)) {
					$arr = array ('candelete'=> false, 'razon'=>'Posee goles asociados');
					echo json_encode($arr);
				}
				else{
					
					$query = "SELECT * FROM amonestaciones_partidos where partidos_id_partido=".(int)$_GET['delete'];
					$result = $mysqli->query($query); 
					if($row = mysqli_fetch_array($result)) {
						$arr = array ('candelete'=> false, 'razon'=>'Posee amonestaciones asociados');
						echo json_encode($arr);
					}
					else{
						$arr = array ('candelete'=> true, 'razon'=>'');
						echo json_encode($arr);
					}
				}
			}
		}
		else{
		
			$consulta = 'DELETE FROM goles_partidos WHERE partidos_id_partido = '.(int)$_GET['delete'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
			
			$consulta = 'DELETE FROM jugadores_partidos WHERE partidos_id_partido  = '.(int)$_GET['delete'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
			
			$consulta = 'DELETE FROM amonestaciones_partidos WHERE partidos_id_partido  = '.(int)$_GET['delete'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
					
			
			$consulta = 'DELETE FROM partidos WHERE id_partido = '.(int)$_GET['delete'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
			$arr = array ('deleted'=> true, 'razon'=>'');
			echo json_encode($arr);
		}

	}

?>