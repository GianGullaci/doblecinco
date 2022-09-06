
<?php
// 	para volver a mostrar todas las fases, quitar el break del primer while
// 	y en la consulta del segundo while quitar and fase=".$fase_actual."

	//tengo las variables torneo $torneo_menores y $torneo_infantiles
	//podría compararlas con la configuracion actual, si es distinta, entonces el torneo termino
	//si el torneo termino podría mostrar el fixture completo
	$filtro_fase=false;
	
	$torneo_menores_c=0;
	$torneo_infantiles_c=0;
	$query_c = "select *
		FROM  configuracion_home";
	$result_c = $mysqli->query($query_c); 
	if ($row_c = mysqli_fetch_array($result_c)){
		
		$torneo_menores_c=$row_c['id_torneo_menores'];
		$torneo_infantiles_c=$row_c['id_torneo_infantiles'];
		$fecha_menores_home_tab = $row_c['fecha_menores_home_tab'];
		$fecha_infantiles_home_tab = $row_c['fecha_infantiles_home_tab'];
	}

	if ($torneo_infantiles==$torneo_infantiles_c and $torneo_menores==$torneo_menores_c){
		//estoy mostrando el torneo actual
		$filtro_fase=true;
	}

	
?>

<?php
	$id_cat = $row_general['id_categoria'];
// 	En este archivo se muestra la informacion de una categoria paticular
// 	1. El listado superior con los numeros que determinan las fechas de esta categoria
// 	2. El panel de cada numero recien mencionado
?>



		<?php
			$j=1;
			
			
			//selecciono todas las fechas del torneo de la categoria $id_cat
			$query_fecha = "select fechas.id_fecha AS id_fecha,fechas.nombre AS nombre, fechas.fase as fase
					from torneos join fechas on fechas.torneos_id_torneo1 = torneos.id_torneo 
					join partidos on fechas.id_fecha = partidos.fechas_id_fecha 
					join equipos on equipos.id_equipo = partidos.equipos_id_equipo 
					join categorias on equipos.categorias_id_categoria = categorias.id_categoria 
					where  (torneos.id_torneo=".$torneo_menores." or torneos.id_torneo=".$torneo_infantiles.") 
					and id_categoria=".$id_cat." 
					group by fechas.id_fecha
					order by fase desc, fechas.id_fecha";
			$result_fecha = $mysqli->query($query_fecha); 
//  			echo $query_fecha;
			
			//en este while se mostrara el listado superior con cada fecha
			$fase_actual="";
			echo '<ul class="nav nav-pills mb-3 flex align-items-center" id="pills-tab" role="tablist">';
			while($row_fecha = mysqli_fetch_array($result_fecha)) {

				if ($row_fecha['fase']!=$fase_actual){
					
					
//  					if ($filtro_fase and $fase_actual!=""){
//  						break;
//  					}
				
					$fase_actual=$row_fecha['fase'];
					
					$fase_a_mostrar = $fase_actual;
					if ($fase_actual==2){
					      $fase_a_mostrar = "Fase 2";
					}
					else if ($fase_actual==3){
					      $fase_a_mostrar = "Semifinal";
					}
					else if ($fase_actual==4){
					      $fase_a_mostrar = "Final";
					}
					else if ($fase_actual==5){
					      $fase_a_mostrar = "Finalisima";
					}
					else if ($fase_actual==6 or $fase_actual==1){
					      $fase_a_mostrar = "Fase 1";
					}
					else if ($fase_actual==7){
// 					      $fase_a_mostrar = "Fase 2. <span style='color:#E42C1A;'>Torneo Apertura</span>";
					      $fase_a_mostrar = "Fase 2";
					}
					else if ($fase_actual==8){
// 					      $fase_a_mostrar = "Fase 2. <span style='color:#E42C1A;'>Torneo Clausura</span>";
					}
					else if ($fase_actual==9){
					      $fase_a_mostrar = "Final";
					}
					
					
					echo '<div class="fw-bold" >'.$fase_a_mostrar.'</div>';
				}
				echo '<li class="nav-item" role="presentation">
						<button class="nav-link'; if ($row_fecha['id_fecha']==$fecha_menores_home_tab or $row_fecha['id_fecha']==$fecha_infantiles_home_tab){
							echo " active ";
						}
						echo '" id="pills-'.$id_cat.'fecha-'.$row_fecha['nombre'].'-'.$row_fecha['id_fecha'].'-tab" data-bs-toggle="pill" data-bs-target="#pills-'.$id_cat.'fecha-'.$row_fecha['nombre'].'-'.$row_fecha['id_fecha'].'" type="button" role="tab" aria-controls="pills-'.$id_cat.'fecha-'.$row_fecha['nombre'].'-'.$row_fecha['id_fecha'].'" aria-selected="true">'.$row_fecha['nombre'].'</button>
			 		</li>';
				
				$j++;
			}
			
			
		?>
		
	</ul>

	<div class="tab-content" id="pills-tabContent">
		<?php
			$j=1;
			$and_filtro = " ";
			if ($filtro_fase){
// 				$and_filtro = " and fase=".$fase_actual;
			}
			
			
			$query_fecha_panel = "select fechas.id_fecha AS id_fecha,fechas.nombre AS nombre, fase
					      from torneos join fechas on fechas.torneos_id_torneo1 = torneos.id_torneo 
					      join partidos on fechas.id_fecha = partidos.fechas_id_fecha 
					      join equipos on equipos.id_equipo = partidos.equipos_id_equipo 
					      join categorias on equipos.categorias_id_categoria = categorias.id_categoria 
					      where  (torneos.id_torneo=".$torneo_menores." or torneos.id_torneo=".$torneo_infantiles.") 
					      and id_categoria=".$id_cat." 
					      ". $and_filtro. " 
					      group by fechas.id_fecha
					      order by fechas.id_fecha";
			$result_fecha_panel = $mysqli->query($query_fecha_panel); 
			
			//en este while se mostraran los paneles de cada fecha
			while($row_fecha_panel = mysqli_fetch_array($result_fecha_panel)) {
				
				echo '<div class="tab-pane fade'; if ($row_fecha_panel['id_fecha']==$fecha_menores_home_tab or $row_fecha_panel['id_fecha']==$fecha_infantiles_home_tab){
					echo " show active ";
				}
				echo '" id="pills-'.$id_cat.'fecha-'.$row_fecha_panel['nombre'].'-'.$row_fecha_panel['id_fecha'].'" role="tabpanel" aria-labelledby="pills-'.$id_cat.'fecha-'.$row_fecha_panel['nombre'].'-'.$row_fecha_panel['id_fecha'].'-tab">
				
				<div class="row">';
				
					
				
				
				//ahora debo recorrer cada partido de esta fecha
				
				//primero los partidos no jugados de la zona A
				$query_partido = "select id_partido, club_local.id_club as id_local, club_local.logo_club as logo_local, local.nombre_equipo as nombre_local,
					club_visitante.id_club as id_visitante, club_visitante.logo_club as logo_visitante, visitante.nombre_equipo as nombre_visitante,
					fecha_partido, hora_partido, lugares.clubes_id_club as club_lugar, tipo_lugar, nombre_arbitro, neutral, nombre_neutral
					FROM  partidos
					inner join equipos as local on local.id_equipo=partidos.equipos_id_equipo
					inner join clubes as club_local on club_local.id_club=local.clubes_id_club
					inner join equipos as visitante on visitante.id_equipo=partidos.equipos_id_equipo1
					inner join clubes as club_visitante on club_visitante.id_club=visitante.clubes_id_club
					left join lugares on lugares.id_lugar=partidos.lugares_id_lugar
					left join arbitros on arbitros.id_arbitro=partidos.arbitros_id_arbitro
					WHERE partidos.fechas_id_fecha=".$row_fecha_panel['id_fecha']." 
					AND zona='A' 
					AND local.categorias_id_categoria=".$id_cat." 
					AND (fecha_partido > curdate() or fecha_partido='0000-00-00 00:00:00')
					group by id_partido";
 				//echo $query_partido;
				$result_partido = $mysqli->query($query_partido); 
				
				$empezo=false;
				//en este while se mostraran los paneles de cada fecha
				while($row_partido = mysqli_fetch_array($result_partido)) {
					
					if (!$empezo){
						if ($row_fecha_panel['fase']==1 or $row_fecha_panel['fase']==6){
							$zona="A";
						}
						else{
							$zona="Campeonato";
						}
						echo '<div class="col-lg-6 col-12">
							<table class="table table-bordered">
							<thead>
							<tr>
								<th colspan="4">Zona '.$zona.'</th>
							</tr>
							</thead>
							<tbody>
						';
						$empezo=true;
					}
					
					$fecha_partido = "Sin definir";
					if ($row_partido['fecha_partido']!='0000-00-00 00:00:00'){
						$fecha_partido = date("d-m", strtotime($row_partido['fecha_partido']));
					}
					echo '
					
						<tr>
							<td>
								  <img src="img/clubes/'.$row_partido['id_local'].'/'.$row_partido['logo_local'].'" width="24" /></td><td>
								  '.$row_partido['nombre_local'].'
							</td>
						      <td >
								<img src="img/clubes/'.$row_partido['id_visitante'].'/'.$row_partido['logo_visitante'].'" width="24" /></td><td>
								'.$row_partido['nombre_visitante'].'
						      </td>
					      </tr>
					
					';
				
				}
				
				if ($empezo){
				
					echo '
							</tbody>
						</table>
						</div>';
					
				}
				
				//segundo los partidos YA jugados de la zona A

				$query_partido = "select id_partido, club_local.id_club as id_local, club_local.logo_club as logo_local, local.nombre_equipo as nombre_local, 
						club_visitante.id_club as id_visitante, club_visitante.logo_club as logo_visitante, visitante.nombre_equipo as nombre_visitante, 
						fecha_partido,
						
						sum(if((((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo) and (goles_partidos.en_contra = 0)) or ((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo1) and (goles_partidos.en_contra = 1))),1,0)) as goles_local,
						sum(if((((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo1) and (goles_partidos.en_contra = 0)) or ((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo) and (goles_partidos.en_contra = 1))),1,0)) as goles_visitante

						FROM partidos 
						inner join equipos as local on local.id_equipo=partidos.equipos_id_equipo 
						inner join clubes as club_local on club_local.id_club=local.clubes_id_club 
						inner join equipos as visitante on visitante.id_equipo=partidos.equipos_id_equipo1 
						inner join clubes as club_visitante on club_visitante.id_club=visitante.clubes_id_club 
						left join goles_partidos on goles_partidos.partidos_id_partido=id_partido
						WHERE partidos.fechas_id_fecha=".$row_fecha_panel['id_fecha']." 
						AND zona='A' AND local.categorias_id_categoria=".$id_cat." 
						AND fecha_partido <= curdate() and fecha_partido<>'0000-00-00 00:00:00'
						group by id_partido";
//   				echo $query_partido;
				$result_partido = $mysqli->query($query_partido); 
				
				$empezo=false;
				//en este while se mostraran los paneles de cada fecha
				while($row_partido = mysqli_fetch_array($result_partido)) {
					
					if (!$empezo){
						if ($row_fecha_panel['fase']==1 or $row_fecha_panel['fase']==6){
							$zona="A";
						}
						else{
							$zona="Campeonato";
						}
						echo '<div class="col-lg-6 col-12">
							<table class="table table-bordered">
							<thead>
							<tr>
								<th colspan="6">Zona '.$zona.'</th>
								<th>Dia</th>
								<th>Ficha</th>
							</tr>
							</thead>
							<tbody>
						';
						$empezo=true;
					}
				
					$fecha_partido = "Sin definir";
					if ($row_partido['fecha_partido']!='0000-00-00 00:00:00'){
						$fecha_partido = date("d-m", strtotime($row_partido['fecha_partido']));
					}
					
					echo '
					
						<tr>
							<td>
								  <img src="img/clubes/'.$row_partido['id_local'].'/'.$row_partido['logo_local'].'" width="24" />
							</td>
							<td class="nombre-equipo">
								  '.$row_partido['nombre_local'].'
							</td>
							<td><span class="goles">'.$row_partido['goles_local'].'</span></td>
							<td><span class="goles">'.$row_partido['goles_visitante'].'</span></td>
							<td>
								'.$row_partido['nombre_visitante'].'
							</td>
							<td >
								<img src="img/clubes/'.$row_partido['id_visitante'].'/'.$row_partido['logo_visitante'].'" width="24" />
							</td>
							<td>'.$fecha_partido.'</td>
							<td style="text-align: center;"><a onclick="obtenerId('.$row_partido['id_partido'].')" title="" href="" data-bs-toggle="modal" data-bs-target="#ficha"><i class="bi bi-plus-square-fill"></i></a></td>
						</tr>

						
					
					';
				
				}
				
				if ($empezo){
				
					echo '
							</tbody>
						</table>
						</div>';
					
				}
				
				
				
				//TERCERO los partidos NO jugados de la zona B
				$empezo=false;

				//ahora debo recorrer cada partido de esta fecha
				$query_partidob = "select id_partido, club_local.id_club as id_local, club_local.logo_club as logo_local, local.nombre_equipo as nombre_local,
					club_visitante.id_club as id_visitante, club_visitante.logo_club as logo_visitante, visitante.nombre_equipo as nombre_visitante,
					fecha_partido, hora_partido, lugares.clubes_id_club as club_lugar, tipo_lugar, nombre_arbitro, neutral, nombre_neutral
					FROM  partidos
					inner join equipos as local on local.id_equipo=partidos.equipos_id_equipo
					inner join clubes as club_local on club_local.id_club=local.clubes_id_club
					inner join equipos as visitante on visitante.id_equipo=partidos.equipos_id_equipo1
					inner join clubes as club_visitante on club_visitante.id_club=visitante.clubes_id_club
					left join lugares on lugares.id_lugar=partidos.lugares_id_lugar
					left join arbitros on arbitros.id_arbitro=partidos.arbitros_id_arbitro
					WHERE partidos.fechas_id_fecha=".$row_fecha_panel['id_fecha']." 
					AND zona='B' 
					AND local.categorias_id_categoria=".$id_cat." 
					AND (fecha_partido > curdate() or fecha_partido='0000-00-00 00:00:00')
					group by id_partido";
				$result_partidob = $mysqli->query($query_partidob); 
				
				//en este while se mostraran los paneles de cada fecha
				while($row_partidob = mysqli_fetch_array($result_partidob)) {
				
					if (!$empezo){
						if ($row_fecha_panel['fase']==1 or $row_fecha_panel['fase']==6){
							$zona="B";
						}
						else{
							$zona="Competencia";
						}
						echo '<div class="col-lg-6 col-12">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th colspan="4">Zona '.$zona.'</th>
								</tr>
								</thead>
								<tbody>
							';
						$empezo=true;
							
					}
				
					$fecha_partidob = "Sin definir";
					if ($row_partidob['fecha_partido']!='0000-00-00 00:00:00'){
						$fecha_partidob = date("d-m", strtotime($row_partidob['fecha_partido']));
					}
					
					echo '
					
						<tr>
							<td>
								  <img src="img/clubes/'.$row_partidob['id_local'].'/'.$row_partidob['logo_local'].'" width="24" /></td><td>
								  '.$row_partidob['nombre_local'].'
							</td>
						<td >
							  <img src="img/clubes/'.$row_partidob['id_visitante'].'/'.$row_partidob['logo_visitante'].'" width="24" /></td><td>
							  '.$row_partidob['nombre_visitante'].'
						</td>
					</tr>
					
					';
				
				}
				
				if ($empezo){

					echo '
						</tbody>
					</table>
					</div>';
				}
				
				
				//CUARTO los partidos YA jugados de la zona B
				
				$query_partido = "select id_partido, club_local.id_club as id_local, club_local.logo_club as logo_local, local.nombre_equipo as nombre_local, 
						club_visitante.id_club as id_visitante, club_visitante.logo_club as logo_visitante, visitante.nombre_equipo as nombre_visitante, 
						fecha_partido,
						sum(if((((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo) and (goles_partidos.en_contra = 0)) or ((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo1) and (goles_partidos.en_contra = 1))),1,0)) as goles_local,
						sum(if((((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo1) and (goles_partidos.en_contra = 0)) or ((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo) and (goles_partidos.en_contra = 1))),1,0)) as goles_visitante

						FROM partidos 
						inner join equipos as local on local.id_equipo=partidos.equipos_id_equipo 
						inner join clubes as club_local on club_local.id_club=local.clubes_id_club 
						inner join equipos as visitante on visitante.id_equipo=partidos.equipos_id_equipo1 
						inner join clubes as club_visitante on club_visitante.id_club=visitante.clubes_id_club 
						left join goles_partidos on goles_partidos.partidos_id_partido=id_partido
						WHERE partidos.fechas_id_fecha=".$row_fecha_panel['id_fecha']." 
						AND zona='B' AND local.categorias_id_categoria=".$id_cat." 
						AND fecha_partido <= curdate() and fecha_partido<>'0000-00-00 00:00:00'
						group by id_partido";
						
//  				echo $query_partido;
				$result_partido = $mysqli->query($query_partido); 
				
				$empezo=false;
				//en este while se mostraran los paneles de cada fecha
				while($row_partido = mysqli_fetch_array($result_partido)) {
					
					if (!$empezo){
						if ($row_fecha_panel['fase']==1 or $row_fecha_panel['fase']==6){
							$zona="B";
						}
						else{
							$zona="Competencia";
						}
						echo '<div class="col-lg-6 col-12">
							<table class="table table-bordered">
							<thead>
							<tr>
								<th colspan="6">Zona '.$zona.'</th>
								<th>Dia</th>
								<th>Ficha</th>
							</tr>
							</thead>
							<tbody>
						';
						$empezo=true;
					}
				
					$fecha_partido = "Sin definir";
					if ($row_partido['fecha_partido']!='0000-00-00 00:00:00'){
						$fecha_partido = date("d-m", strtotime($row_partido['fecha_partido']));
					}
					
					echo '
					
						<tr>
							<td>
								  <img src="img/clubes/'.$row_partido['id_local'].'/'.$row_partido['logo_local'].'" width="24" />
							</td>
							<td class="nombre-equipo">
								  '.$row_partido['nombre_local'].'
							</td>
							<td><span class="goles">'.$row_partido['goles_local'].'</span></td>
							<td><span class="goles">'.$row_partido['goles_visitante'].'</span></td>
							<td>
								'.$row_partido['nombre_visitante'].'
							</td>
							<td >
								<img src="img/clubes/'.$row_partido['id_visitante'].'/'.$row_partido['logo_visitante'].'" width="24" />
							</td>
							<td>'.$fecha_partido.'</td>
							<td style="text-align: center;"><a onclick="obtenerId('.$row_partido['id_partido'].')" title="" href="" data-bs-toggle="modal" data-bs-target="#ficha"><i class="bi bi-plus-square-fill"></i></a></td>
						</tr>
						
					
					';
				
				}
				
				if ($empezo){
				
					echo '
							</tbody>
						</table>
						</div>';
					
				}
				
								
				echo '
	
				</div>
				</div>';
			}
			
		?>
	</div>

