<?php include("session.php");
	include("coneccion.php");
	include("functions.php");
	
	$nuevo_orden= explode(",",$_GET['orden_bloque']);
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
	    orden_bloque= '.$i.'
	    WHERE id_nota='.$id_nota_actual;
	    $sentencia = $mysqli->prepare($consulta);
	    $sentencia->execute();
	    $i++;
	}
	
	
	$json = array(
		'modificado' => true
	      );
		
	echo json_encode($json);
	
	
	

?>