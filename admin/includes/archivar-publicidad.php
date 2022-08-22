<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	$query = 'SELECT * FROM publicidades_posicionadas
		WHERE publicidades_id_publicidad='.$_GET['id'];
   	//echo $query;	
	$result = $mysqli->query($query);
	if ($row = mysqli_fetch_array($result)) {
		$json = array(
			'deleted' => false,
			'razon'=> 'No se puede archivar la publicidad porque está posicionada'
		);
		echo json_encode($json);
		exit;
	}
	
	
		
	$consulta = 'UPDATE publicidades SET archivada=1 
	WHERE id_publicidad='.$_GET['id'];
	  //echo $consulta;
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'deleted' => true
	      );
	
	echo json_encode($json);

?>