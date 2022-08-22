<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	
	$query = "SELECT *, max(orden_bloque) as ultimo_orden 
	FROM notas 
	WHERE bloque_home=".$_GET['bloque'];
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$orden = $row['ultimo_orden']+1;
		$consulta = 'UPDATE notas SET orden_bloque='.$orden.', bloque_home='.$_GET['bloque'].' where id_nota = '.$_GET['nota'];
// 		echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		$query = "SELECT * 
		FROM notas 
		join categorias_notas on categorias_notas.id_categoria_notas=notas.categorias_notas_id_categoria_notas
		WHERE id_nota=".$_GET['nota'];
		$result = $mysqli->query($query); 
		if ($row = mysqli_fetch_array($result)) {
			$dia ="";
			if ($row['fecha_nota']!="0000-00-00 00:00:00"){
			  $dia= $row['fecha_nota'];
			  $time = strtotime($dia);
			  $dia = date("d-m-Y", $time);
			}
		
			$json = array(
				'error' => false,
				'id_nota' => $row['id_nota'],
				'fecha' => $dia,
				'categoria' => $row['nombre_categoria'],
				'posicion' => $orden,
				'mensaje_error' => ''
			      );
		}
		      
	}
	else {
		
		$json = array(
			'error' => true,
			'mensaje_error' => 'Error '
		      );	

	}
	
	echo json_encode($json);

?>