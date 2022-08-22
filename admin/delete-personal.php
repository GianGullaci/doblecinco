<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		
		$query = "SELECT * FROM equipos where personal_id_personal=".(int)$_GET['delete']. " or personal_id_personal1=".(int)$_GET['delete']. " or personal_id_personal2=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
			$arr = array ('deleted'=> false, 'razon'=>'(posee equipos asociados)');
			echo json_encode($arr);
		}
		else{
			$consulta = 'DELETE FROM personal WHERE id_personal = '.(int)$_GET['delete'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
			$sentencia->close();
			delTree("../img/personal/".$_GET['delete']);
			$arr = array ('deleted'=> true, 'razon'=>'');
			echo json_encode($arr);
		}
	      
	}

?>