<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	if(isset($_GET['id'])) {
		$query = "SELECT * FROM personal where clubes_id_club=".$_GET['id']." order by nombre" or die("Error in the consult.." . mysqli_error($mysqli));
		$result = $mysqli->query($query); 
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
		    $json[] = array(
		    'id' => $row['id_personal'],
		    'nombre' => $row['nombre'] 
		  );
		}
		echo json_encode($json);
			
	}

?>