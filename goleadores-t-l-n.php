<!--goleadores-->

<?php

	include_once "model/coneccion.php";
	$query = "select *
	FROM  torneos_notas where notas_id_nota=".$id_nota." LIMIT 0,2";
	$torneos=false;
	$result = $mysqli->query($query); 

	if ($row_torneo = mysqli_fetch_array($result)){
		$torneo_menores=$row_torneo['torneos_id_torneo'];
		$torneos=true;
	}
	if ($row_torneo = mysqli_fetch_array($result)){
		$torneo_infantiles=$row_torneo['torneos_id_torneo'];
		$torneos=true;
	}


?>



	<div class="container">
		<?php
			
			$query_general3 = "select padre.id_categoria AS id_categoria_padre,padre.nombre_categoria AS nombre_categoria_padre,
							cat.id_categoria AS id_categoria,cat.nombre_categoria AS nombre_categoria,cat.diferencia AS diferencia 
			FROM  categorias as cat
			join categorias as padre on cat.categorias_id_categoria = padre.id_categoria 
		    where cat.id_categoria<>16
			order by cat.diferencia desc";
			$result_general3 = $mysqli->query($query_general3); 
			$started = false;
			$padre="";
			//este while muestra todas las categorias sobre el margen izquierdo
			while($row_general3 = mysqli_fetch_array($result_general3)) {
				if (!$started){
					echo '
						<h1>Goleadores</h1>
						<div class="d-flex">  
							<div class="nav flex-column nav-pills me-4" style="width:20%" id="v-pills-tab" role="tablist" aria-orientation="vertical">

							<div class="fw-bold text-center" >'.$row_general3['nombre_categoria_padre'].'</div>
							<button class="nav-link active" id="v-pills-goleadores-'.$row_general3['nombre_categoria'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-goleadores-'.$row_general3['nombre_categoria'].'" type="button" role="tab" aria-controls="v-pills-goleadores-'.$row_general3['nombre_categoria'].'" aria-selected="false">'.$row_general3['nombre_categoria'].'</button>
					';
					$padre = $row_general3['nombre_categoria_padre'];
				}
				else{
					if ($padre!=$row_general3['nombre_categoria_padre']){
							$padre=$row_general3['nombre_categoria_padre'];
							echo '<div class="fw-bold text-center" >'.$row_general3['nombre_categoria_padre'].'</div>';
							
						}
					echo '<button class="nav-link" id="v-pills-goleadores-'.$row_general3['nombre_categoria'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-goleadores-'.$row_general3['nombre_categoria'].'" type="button" role="tab" aria-controls="v-pills-goleadores-'.$row_general3['nombre_categoria'].'" aria-selected="false">'.$row_general3['nombre_categoria'].'</button>';
				}
				$started=true;
			}
			
			if ($started){
			
				echo '</div>';
			
			}
			
			//ya mostramos las categorias, ahora armamos por cada categoria el panel que contendra todas las fechas
			
			$query_general3 = "select *
					FROM  categorias where categorias_id_categoria<>0
					order by diferencia desc";
			$result_general3 = $mysqli->query($query_general3); 
			$started = false;
			$contador=1;
			
			//este while va a recorrer todas las categorias para obtener sus fechas
			while($row_general3 = mysqli_fetch_array($result_general3)) {
			
				//el id de los tabs son los nombres de las categorias
				if (!$started){
					echo '
							
								<div class="tab-content" id="v-pills-tabContent">

								<div class="tab-pane fade show active" id="v-pills-goleadores-'.$row_general3['nombre_categoria'].'" role="tabpanel" aria-labelledby="v-pills-goleadores-'.$row_general3['nombre_categoria'].'-tab">
								<h3 data-tab="goleadores-'.$row_general3['nombre_categoria'].'" class="v_nav v_active ">'.$row_general3['nombre_categoria'].'</h3>
							';
				}
				else{
					echo '<div class="tab-pane fade" id="v-pills-goleadores-'.$row_general3['nombre_categoria'].'" role="tabpanel" aria-labelledby="v-pills-goleadores-'.$row_general3['nombre_categoria'].'-tab">
					<h3 data-tab="goleadores-'.$row_general3['nombre_categoria'].'">'.$row_general3['nombre_categoria'].'</h3>';
				}
				
					$nro=$contador;
					include("goleadores-cat.php");
					echo '</div>';
				
				$started=true;
				$contador++;
			}
			
			if ($started){
			
				echo '</div></div>';
			
			}
		?>
							

	</div>