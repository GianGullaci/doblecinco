<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$query ="SELECT MAX( orden_columna_home ) AS orden_columna_home FROM  notas LIMIT 0 , 1";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$orden_columna_home=$row['orden_columna_home'] +1;
	}
		
	$consulta = 'UPDATE notas SET
	orden_columna_home= '.$orden_columna_home.', columna_home =1
	WHERE id_nota='.$_GET['id_nota'];
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'modificado' => true,
		'orden_columna_home' => $orden_columna_home
	      );
		
	
	echo json_encode($json);

?>