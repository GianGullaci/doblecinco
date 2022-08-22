<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$consulta = 'UPDATE administradores SET activo=0 WHERE id_administrador = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
	}

?>