<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	if(isset($_GET['categoria'])) {
		
		$categoria = $_GET['categoria'];
		
		$query = "SELECT * FROM equipos 
		left join clubes on clubes.id_club=equipos.clubes_id_club
		where equipos.categorias_id_categoria=".$categoria." 
		order by nombre_equipo";
		// echo $query;
		$result = $mysqli->query($query); 
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
		    $json[] = array(
		    'id' => $row['id_equipo'],
		    'nombre' => $row['nombre_equipo']
		  );
		}
		echo json_encode($json);
			
	}

?>