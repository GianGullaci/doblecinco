<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$nuevo_orden= explode(",",$_GET['orden_destacada']);
	$i=1;
	$id_anterior_it = 0;
	$necesito_posterior = false;
	$id_posterior=0;
	foreach ($nuevo_orden as $id_nota_actual){
	    
	    if ($necesito_posterior){
		    $id_posterior=$id_nota_actual;
		    $necesito_posterior=false;
	    }
	    
	    if ($id_nota_actual==$_GET['nota']){
			//llegue a la nota qu moví en el listado, debo almacenar la nota anterior y la posterior
			$posicion=$i;
			$id_anterior = $id_anterior_it;
			$necesito_posterior = true;
	    }
	    else{
			$id_anterior_it = $id_nota_actual;
	    }
	
	    $consulta = 'UPDATE notas SET
	    orden_destacada= '.$i.'
	    WHERE id_nota='.$id_nota_actual;
	    $sentencia = $mysqli->prepare($consulta);
	    $sentencia->execute();
	    $i++;
	}
	
	$a_comparar = $id_anterior;
	if ($id_anterior==0){
		$a_comparar = $id_posterior;
	}
	if ($a_comparar!=0){
		$query = "SELECT * FROM notas 
		where id_nota=".$a_comparar;
		
		$result = $mysqli->query($query); 
		if($row = mysqli_fetch_array($result)) {
			//si la nota anterior esta o no en la destacada, significa que esta nota tampoco
			$consulta = 'UPDATE notas SET
			destacada='.$row['destacada'].' 
			WHERE id_nota='.$_GET['nota'];
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
			$destacada = $row['destacada'];
				
			
			$json = array(
				'modificado' => true,
				'destacada' => $destacada,
				'orden_destacada'=>$posicion
			      );
				
			
			
		      
		}
	}
	else{
		$json = array(
			'modificado' => true,
			'destacada' => 2,
			'orden_destacada'=>0
		      );
	}
	
		
	echo json_encode($json);
	
	
	

?>