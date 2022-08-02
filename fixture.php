<?php include 'template/header.php' ?>

<?php

	//seleccionamos el torneo que se setea en el admin
	include_once "model/coneccion.php";
	$query = "select *
		FROM  configuracion_home";
	$torneos=false;
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)){
		$torneo_menores=$row['id_torneo_menores'];
		//$torneo_menores=14;
		$torneo_infantiles=$row['id_torneo_infantiles'];
		//$torneo_infantiles=15;
		$texto_cita_posiciones = $row['texto_cita_posiciones'];
		$titulo_torneo=$row['titulo_torneo'];
		$torneos=true;
	}

?>

<section class="pt-2">
<div class="container">
		<?php
			
			
			if ($torneos!=""){
			
				//hay torneos para mostrar
			
				$query_general = "select padre.id_categoria AS id_categoria_padre,padre.nombre_categoria AS nombre_categoria_padre,
							cat.id_categoria AS id_categoria,cat.nombre_categoria AS nombre_categoria,cat.diferencia AS diferencia 
							from torneos join fechas on fechas.torneos_id_torneo1 = torneos.id_torneo 
							join partidos on fechas.id_fecha = partidos.fechas_id_fecha 
							join equipos on equipos.id_equipo = partidos.equipos_id_equipo 
							join categorias as cat on equipos.categorias_id_categoria = cat.id_categoria 
							join categorias as padre on cat.categorias_id_categoria = padre.id_categoria 
							where torneos.id_torneo=".$torneo_infantiles." 
							or torneos.id_torneo=".$torneo_menores." 
							group by cat.id_categoria
							order by diferencia desc";
				$result_general = $mysqli->query($query_general); 
				$started = false;
				
				$padre="";
				
				//este while muestra todas las categorias sobre el margen izquierdo
				while($row_general = mysqli_fetch_array($result_general)) {
					if (!$started){
						echo '
							
							<h2>Campeonato Juveniles y Menores</h2>
							<div class="d-flex">  
							<div class="nav flex-column nav-pills me-4" style="width:20%" id="v-pills-tab" role="tablist" aria-orientation="vertical">

							<div class="fw-bold text-center" >'.$row_general['nombre_categoria_padre'].'</div>
								<button class="nav-link active" id="v-pills-'.$row_general['nombre_categoria'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$row_general['nombre_categoria'].'" type="button" role="tab" aria-controls="v-pills-'.$row_general['nombre_categoria'].'" aria-selected="false">'.$row_general['nombre_categoria'].'</button>
						';
						$padre = $row_general['nombre_categoria_padre'];
					}
					else{
						if ($padre!=$row_general['nombre_categoria_padre']){
							$padre=$row_general['nombre_categoria_padre'];
							echo '<div class="fw-bold text-center" >'.$row_general['nombre_categoria_padre'].'</div>';
							
						}
						echo '<button class="nav-link" id="v-pills-'.$row_general['nombre_categoria'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$row_general['nombre_categoria'].'" type="button" role="tab" aria-controls="v-pills-'.$row_general['nombre_categoria'].'" aria-selected="false">'.$row_general['nombre_categoria'].'</button>';
					}
					$started=true;
				}
				
				if ($started){
				
					echo '</div>';
				
				}
				
				//ya mostramos las categorias, ahora armamos por cada categoria el panel que contendra todas las fechas
				
				$query_general = "select categorias.id_categoria AS id_categoria,categorias.nombre_categoria AS nombre_categoria,categorias.diferencia AS diferencia 
							from torneos join fechas on fechas.torneos_id_torneo1 = torneos.id_torneo 
							join partidos on fechas.id_fecha = partidos.fechas_id_fecha 
							join equipos on equipos.id_equipo = partidos.equipos_id_equipo 
							join categorias on equipos.categorias_id_categoria = categorias.id_categoria 
							where torneos.id_torneo=".$torneo_menores." or torneos.id_torneo=".$torneo_infantiles." 
							group by categorias.id_categoria";
				$result_general = $mysqli->query($query_general); 
				$started = false;
				$contador=1;
				
				//este while va a recorrer todas las categorias para obtener sus fechas
				while($row_general = mysqli_fetch_array($result_general)) {
				
					//el id de los tabs son los nombres de las categorias
					if (!$started){
						echo '
									<div class="tab-content" id="v-pills-tabContent">

									<div class="tab-pane fade show active" id="v-pills-'.$row_general['nombre_categoria'].'" role="tabpanel" aria-labelledby="v-pills-'.$row_general['nombre_categoria'].'-tab">
									<h3 data-tab="'.$row_general['nombre_categoria'].'">'.$row_general['nombre_categoria'].'</h3>
								';
					}
					else{
						echo '<div class="tab-pane fade" id="v-pills-'.$row_general['nombre_categoria'].'" role="tabpanel" aria-labelledby="v-pills-'.$row_general['nombre_categoria'].'-tab">
						<h3 data-tab="'.$row_general['nombre_categoria'].'">'.$row_general['nombre_categoria'].'</h3>';
					}
					
						$nro=$contador;
						include("fecha-fixture-zonas.php");
						echo '</div>';
					
					$started=true;
					$contador++;
				}
				
				if ($started){
					
					
					echo '</div></div>';
				
				}
			?>
							
						
			
						
					
		<?php
			}
		?>
</div>
</section>

<?php include 'template/footer.php' ?>