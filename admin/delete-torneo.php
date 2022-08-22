<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM fechas where torneos_id_torneo1=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
		  $arr = array ('deleted'=> false, 'razon'=>'(posee fechas asociadas)');
		  echo json_encode($arr);
		}
		else{
		
			$query = "SELECT * FROM torneos_notas where torneos_id_torneo=".(int)$_GET['delete'];
			$result = $mysqli->query($query); 
			if($row = mysqli_fetch_array($result)) {
				$arr = array ('deleted'=> false, 'razon'=>'(posee notas asociadas)');
				echo json_encode($arr);
			}
			else{
				$consulta = 'DELETE FROM torneos WHERE id_torneo = '.(int)$_GET['delete'];
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
				$sentencia->close();
				$arr = array ('deleted'=> true, 'razon'=>'');
				echo json_encode($arr);
			}
		}
	}

?>