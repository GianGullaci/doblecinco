<?php include("includes/session.php");
	include("includes/coneccion.php");
	
	if(isset($_GET['delete'])) {
		
		$query = "SELECT * FROM jugadores where pierna_habil_id_pierna_habil=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
		  $arr = array ('deleted'=> false);
		  echo json_encode($arr);
		}
		else{
		
		  $consulta = 'DELETE FROM pierna_habil WHERE id_pierna_habil = '.(int)$_GET['delete'];
		  $sentencia = $mysqli->prepare($consulta);
		  $sentencia->execute();
		  $sentencia->close();
		  $arr = array ('deleted'=> true);
		  echo json_encode($arr);
		}
	}

?>