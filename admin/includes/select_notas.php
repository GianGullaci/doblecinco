<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$where = "";
	if(isset($_GET['ajax'])) {
		
		$query = "SELECT * FROM notas
		where bloque_home=0
		order by id_nota desc";
		//echo $query;
		$result = $mysqli->query($query); 
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
		    $json[] = array(
		      'id' => $row['id_nota'],
		      'titulo' => $row['titulo_nota']
		    );
		}
		echo json_encode($json);
			
	}

?>