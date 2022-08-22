<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$query ="SELECT MAX( orden_home ) AS orden_home FROM  notas LIMIT 0 , 1";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$orden_home=$row['orden_home'] +1;
	}
		
	$consulta = 'UPDATE notas SET
	orden_home= '.$orden_home.', home =1
	WHERE id_nota='.$_GET['id_nota'];
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'modificado' => true,
		'orden_home' => $orden_home
	      );
		
	
	echo json_encode($json);

?>