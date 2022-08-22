<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	if(isset($_GET['fecha']) and isset($_GET['categoria'])) {
		
		$id_local=$_GET['id_local'];
		$id_visitante=$_GET['id_visitante'];
		
		$where_id="";
		if (isset($_GET['id']) ){
		    $where_id=" AND partidos.id_partido<> ".$_GET['id'];
		    
		}
		
		//chequeo la existencia del partido
		$query = "SELECT * FROM partidos 
			  where equipos_id_equipo=".$id_local." 
			  AND equipos_id_equipo1=".$id_visitante." 
			  AND fechas_id_fecha = ".$_GET['fecha']. $where_id;
			  
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
			//error el partido ya existe
			$json = array(
			    'error' => true,
			    'mensaje_error' => 'El partido ya existe'
			  );
		}
		else{
		    //puedo hacer submit
		    $json = array(
			'error' => false,
			'mensaje_error' => ''
		      );
		}
		
		
		echo json_encode($json);
			
	}
	

?>