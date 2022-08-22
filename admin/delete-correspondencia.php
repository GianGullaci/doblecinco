<?php include("includes/session.php");
	include("includes/coneccion.php");
	
	if(isset($_GET['delete'])) {
		$consulta = 'DELETE FROM categorias WHERE id_categoria = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$sentencia->close();
	}

?>