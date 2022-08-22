<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM comentarios where comentarios_id_comentario=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
		  $arr = array ('deleted'=> false, 'razon'=>'(posee respuestas asociadas)');
		  echo json_encode($arr);
		}
		else{
			
			
			$consulta = 'DELETE FROM comentarios WHERE id_comentario = '.(int)$_GET['delete'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();

			
			$arr = array ('deleted'=> true);
			echo json_encode($arr);

		}
	}

?>