<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM notas where colaboradores_id_colaborador=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
		  $arr = array ('deleted'=> false, 'razon'=>'(posee notas asociadas)');
		  echo json_encode($arr);
		}
		else{
			$consulta = 'DELETE FROM colaboradores WHERE id_colaborador = '.(int)$_GET['delete'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
			
			$arr = array ('deleted'=> true);
			echo json_encode($arr);
		}
	}

?>