<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM partidos where arbitros_id_arbitro=".(int)$_GET['delete']." or arbitros_id_arbitro1=".(int)$_GET['delete']." or arbitros_id_arbitro2=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
		  $arr = array ('deleted'=> false, 'razon'=>'(posee partidos asociados)');
		  echo json_encode($arr);
		}
		else{
				
			$query = "SELECT * FROM arbitros_notas where arbitros_id_arbitro=".(int)$_GET['delete'];
			$result = $mysqli->query($query); 
			if($row = mysqli_fetch_array($result)) {
				$arr = array ('deleted'=> false, 'razon'=>'(posee notas asociadas)');
				echo json_encode($arr);
			}
			else{
	
				$consulta = 'DELETE FROM arbitros WHERE id_arbitro = '.(int)$_GET['delete'];
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
				$sentencia->close();
				delTree("../img/arbitros/".$_GET['delete']);
				$arr = array ('deleted'=> true);
				echo json_encode($arr);
			}
				
		}
	}

?>