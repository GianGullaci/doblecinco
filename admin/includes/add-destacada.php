<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$query ="SELECT MAX( orden_destacada ) AS orden_destacada FROM  notas LIMIT 0 , 1";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$orden_destacada=$row['orden_destacada'] +1;
	}
		
	$consulta = 'UPDATE notas SET
	orden_destacada= '.$orden_destacada.', destacada =1
	WHERE id_nota='.$_GET['id_nota'];
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'modificado' => true,
		'orden_destacada' => $orden_destacada
	      );
		
	
	echo json_encode($json);

?>