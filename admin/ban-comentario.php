<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
			
		
		$consulta = 'UPDATE comentarios SET texto_comentario="El comentario fue eliminado por contener conceptos agraviantes.",  es_razon_admin=1 
		WHERE id_comentario = '.(int)$_GET['delete'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();

		
		$arr = array ('baned'=> true);
		echo json_encode($arr);

	}

?>