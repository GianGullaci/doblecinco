<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	if(isset($_GET['id'])) {
		$query = "SELECT * FROM fechas where torneos_id_torneo1=".$_GET['id']." order by nombre";
		$result = $mysqli->query($query); 
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
		    $fase= $row['fase'];
		    if ($fase==1 or $fase==6){
			    $fase= "Fase 1";
		    }
		    else if ($fase==2){
			    $fase= "Fase 2 Juveniles";
		    }
		    else if ($fase==3){
			    $fase= "Semifinal Juveniles (Fase 3)";
		    }
		    else if ($fase==4){
			    $fase= "Final Juveniles";
		    }
		    else if ($fase==5){
			    $fase= "Finalisima Juveniles";
		    }
		    else if ($fase==7){
			    $fase= "Torneo Apertura Menores";
		    }
		    else if ($fase==8){
			    $fase= "Torneo Clausura Menores";
		    }
		    else if ($fase==9){
			    $fase= "Final Menores";
		    }
		    $json[] = array(
		    'id' => $row['id_fecha'],
		    'nombre' => ucfirst($row['nombre'])." - ".$fase
		  );
		}
		echo json_encode($json);
			
	}

?>