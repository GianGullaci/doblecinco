<?php include("includes/session.php");
	include("includes/coneccion.php");
	
	if(isset($_GET['add'])) {
		$consulta = 'INSERT INTO pierna_habil (nombre_pierna) VALUES ("'.$_GET['add'].'")';
		// echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		//$sentencia->close();
		$arr = array ('id'=> mysqli_insert_id($mysqli));
		echo json_encode($arr); 
	}

?>