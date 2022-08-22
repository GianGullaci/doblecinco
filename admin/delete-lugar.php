<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM partidos where lugares_id_lugar=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
		  $arr = array ('deleted'=> false, 'razon'=>'(posee partidos asociados)');
		  echo json_encode($arr);
		}
		else{
			
			$consulta = 'DELETE FROM lugares WHERE id_lugar = '.(int)$_GET['delete'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
				
			$arr = array ('deleted'=> true);
			echo json_encode($arr);
		}
	}

?>