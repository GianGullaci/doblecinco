<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$where = "";
	if(isset($_GET['equipo1']) or isset($_GET['equipo2'])) {
		if (isset($_GET['equipo1']) and isset($_GET['equipo2'])){
		  $where = " WHERE equipos.id_equipo=".$_GET['equipo1']."  OR equipos.id_equipo=".$_GET['equipo2'];
		}
		else if (isset($_GET['equipo2'])){
		  $where = " WHERE equipos.id_equipo=".$_GET['equipo2'];
		}
		else{
		  $where = " WHERE equipos.id_equipo=".$_GET['equipo1'];
		}
		$query = "SELECT distinct(id_lugar), tipo_lugar, id_lugar, nombre_club, direccion FROM lugares
		join clubes on clubes.id_club=lugares.clubes_id_club
		join equipos on equipos.clubes_id_club=clubes.id_club
		".$where." order by direccion_sede";
		//echo $query;
		$result = $mysqli->query($query); 
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
		    if ($row['tipo_lugar']==1){
		      $tipo="Sede ";
		    }
		    else if ($row['tipo_lugar']==2){
		      $tipo="Estadio ";
		    }
		    else{
		      $tipo="Predio ";
		    }
		    $json[] = array(
		      'id' => $row['id_lugar'],
		      'direccion' => $tipo.$row['nombre_club'].": ".$row['direccion'] 
		    );
// 		    if (isset( $row['direccion_estadio']) and $row['direccion_estadio']!="" and  $row['direccion_estadio']!="NULL"){
// 			  $json[] = array(
// 			    'id' => $row['id_club']."_estadio",
// 			    'direccion' => "Estadio ".$row['nombre_club'].": ".$row['direccion_estadio'] 
// 			  );
// 		    }
// 		    if (isset( $row['direccion_predio']) and $row['direccion_predio']!="" and  $row['direccion_predio']!="NULL"){
// 			  $json[] = array(
// 			    'id' => $row['id_club']."_predio",
// 			    'direccion' => "Predio ".$row['nombre_club'].": ".$row['direccion_predio'] 
// 			  );
// 		    }
		}
		echo json_encode($json);
			
	}

?>