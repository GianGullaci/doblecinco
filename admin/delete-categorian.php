<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM notas where categorias_notas_id_categoria_notas=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
			$arr = array ('deleted'=> false, 'razon'=>'(posee notas asociadas)');
			echo json_encode($arr);
		}
		else{
			$query = "SELECT * FROM categorias_notas where categorias_notas_id_categoria_notas=".(int)$_GET['delete'];
			$result = $mysqli->query($query); 
			if($row = mysqli_fetch_array($result)) {
				$arr = array ('deleted'=> false, 'razon'=>'(posee categorias asociadas)');
				echo json_encode($arr);
			}
			else{
				$consulta = 'DELETE FROM categorias_notas WHERE id_categoria_notas = '.(int)$_GET['delete'];
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
				$sentencia->close();
// 				delTree("../images/jugadores/".$_GET['delete']);
				$arr = array ('deleted'=> true, 'razon'=>'');
				echo json_encode($arr);
			}
		}
	}

?>