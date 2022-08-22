<?php include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
	
	if(isset($_GET['delete'])) {
		$query = "SELECT * FROM jugadores where clubes_id_club=".(int)$_GET['delete'];
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
		  $arr = array ('deleted'=> false, 'razon'=>'(posee jugadores asociados)');
		  echo json_encode($arr);
		}
		else{
			$query = "SELECT * FROM personal where clubes_id_club=".(int)$_GET['delete'];
			$result = $mysqli->query($query); 
			if($row = mysqli_fetch_array($result)) {
			  $arr = array ('deleted'=> false, 'razon'=>'(posee personal asociado)');
			  echo json_encode($arr);
			}
			else{
			
				$query = "SELECT * FROM equipos where clubes_id_club=".(int)$_GET['delete'];
				$result = $mysqli->query($query); 
				if($row = mysqli_fetch_array($result)) {
					$arr = array ('deleted'=> false, 'razon'=>'(posee equipos asociados)');
					echo json_encode($arr);
				}
				else{
				
					$query = "SELECT * FROM clubes_notas where clubes_id_club=".(int)$_GET['delete'];
					$result = $mysqli->query($query); 
					if($row = mysqli_fetch_array($result)) {
						$arr = array ('deleted'=> false, 'razon'=>'(posee notas asociados)');
						echo json_encode($arr);
					}
					else{
			
						$consulta = 'DELETE FROM clubes WHERE id_club = '.(int)$_GET['delete'];
						$sentencia = $mysqli->prepare($consulta);
						$sentencia->execute();
						
						$consulta = 'DELETE FROM lugares WHERE clubes_id_club = '.(int)$_GET['delete'];
						$sentencia = $mysqli->prepare($consulta);
						$sentencia->execute();
						
						if (file_exists("../img/clubes/".$_GET['delete'])){
							delTree("../img/clubes/".$_GET['delete']);
						}
						
						$file_pattern = "../sitio/img/logos/".$_GET['delete']."-logo.*"; // Assuming your files are named like profiles/bb-x62.foo, profiles/bb-x62.bar, etc.
						array_map( "unlink", glob( $file_pattern ) );
						
						$arr = array ('deleted'=> true);
						echo json_encode($arr);
					}
				}
			}
		}
	}

?>