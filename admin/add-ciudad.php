<?php include("includes/session.php");
	include("includes/coneccion.php");
	
	if(isset($_GET['add'])) {
		$consulta = 'INSERT INTO ciudades (nombre) VALUES ("'.$_GET['add'].'")';
		// echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		//$sentencia->close();
		$arr = array ('id'=> mysqli_insert_id($mysqli));
		echo json_encode($arr); // {"a":1,"b":2,"c":3,"d":4,"e":5}
	}

?>