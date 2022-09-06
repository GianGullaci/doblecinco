<?php

	$id_partido = $_REQUEST['id'];

	include_once "model/coneccion.php";
		$query_partido = "select id_partido, partidos.descripcion as descripcion, club_local.id_club as id_local, club_local.logo_club as logo_local, club_local.nombre_club as nombre_local, club_visitante.id_club as id_visitante, club_visitante.logo_club as logo_visitante, club_visitante.nombre_club as nombre_visitante, fecha_partido,
				  
				  sum(if((((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo) and (goles_partidos.en_contra = 0)) or ((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo1) and (goles_partidos.en_contra = 1))),1,0)) as goles_local,
				  sum(if((((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo1) and (goles_partidos.en_contra = 0)) or ((goles_partidos.equipos_id_equipo = partidos.equipos_id_equipo) and (goles_partidos.en_contra = 1))),1,0)) as goles_visitante,
				  
				  local.id_equipo as id_equipo_local, visitante.id_equipo as id_equipo_visitante,
				  personal_local.nombre as dt_local, personal_visitante.nombre as dt_visitante, lugares.tipo_lugar, 
				  club_lugar.nombre_club as nombre_lugar, nombre_arbitro
				  FROM partidos 
				  inner join equipos as local on local.id_equipo=partidos.equipos_id_equipo 
				  inner join clubes as club_local on club_local.id_club=local.clubes_id_club 
				  left join personal as personal_local on local.personal_id_personal=personal_local.id_personal
				  inner join equipos as visitante on visitante.id_equipo=partidos.equipos_id_equipo1 
				  inner join clubes as club_visitante on club_visitante.id_club=visitante.clubes_id_club 
				  left join personal as personal_visitante on visitante.personal_id_personal=personal_visitante.id_personal
				  left join goles_partidos on goles_partidos.partidos_id_partido=id_partido
				  left join lugares on lugares.id_lugar=partidos.lugares_id_lugar
				  left join clubes as club_lugar on club_lugar.id_club=lugares.clubes_id_club
				  left join arbitros on arbitros.id_arbitro=partidos.arbitros_id_arbitro
				  WHERE partidos.id_partido=".$id_partido;
//  				echo $query_partido;
			$result_partido = $mysqli->query($query_partido); 
			
			//en este while se mostraran los paneles de cada fecha
			if ($row_partido = mysqli_fetch_array($result_partido)) {
			
		
    	?>
		

    	
			
	<table class="table">
				<tbody>

					<tr class="table-primary">
						<td>
							  <img src="img/clubes/<?=$row_partido['id_local']?>/<?=$row_partido['logo_local']?>" width="30" />
						</td>
						<td><h6><b><?=$row_partido['nombre_local']?></b></h6></td>
						<td><h6><span class="badge bg-primary"><?=$row_partido['goles_local']?></span></h6></td>
						<td><h6><span class="badge bg-primary"><?=$row_partido['goles_visitante']?></span></h6></td>
						<td >
							<img src="img/clubes/<?=$row_partido['id_visitante']?>/<?=$row_partido['logo_visitante']?>" width="30" />
						</td>
						<td><h6><b><?=$row_partido['nombre_visitante']?></b></h6></td>
					</tr>
									
					<tr class="table-success">
						<td colspan='6' class="table-success"><b>Goles:</b></td>
					</tr>
					
					<?php
					
						$jugadores1g=[];
						$jugadores2g=[];
					
						$query_partido1g = "select nombre_jugador, en_contra 
						FROM goles_partidos
						inner join jugadores on jugadores.id_jugador=goles_partidos.jugadores_id_jugador
						WHERE goles_partidos.partidos_id_partido=".$id_partido. "
						and goles_partidos.equipos_id_equipo= ".$row_partido['id_equipo_local'];
// 	        				 echo $query_partido1g;
						$result_partido1g = $mysqli->query($query_partido1g); 

						while ($row_partido1g = mysqli_fetch_array($result_partido1g)) {
							$jugadores1g[]=$row_partido1g;
						}
						
						
						$query_partido2g = "select nombre_jugador, en_contra 
						FROM goles_partidos
						inner join jugadores on jugadores.id_jugador=goles_partidos.jugadores_id_jugador
						WHERE goles_partidos.partidos_id_partido=".$id_partido. "
						and goles_partidos.equipos_id_equipo= ".$row_partido['id_equipo_visitante'];
						$result_partido2g = $mysqli->query($query_partido2g); 

						
						while ($row_partido2g = mysqli_fetch_array($result_partido2g)) {
							$jugadores2g[]=$row_partido2g;
						}
						
						$count = max(count($jugadores1g), count($jugadores2g));
						
						for ($i=0;$i<=$count;$i++){
							echo "<tr>";
								echo "<td colspan='3'>";
								
								if (isset($jugadores1g[$i][0])){
								
									echo $jugadores1g[$i][0];
									
									if ($jugadores1g[$i][1]==1){
									      echo "<b> (en contra)</b>";
									}
								}
								echo "</td>";
								
								echo "<td colspan='3'>";
								
								if (isset($jugadores2g[$i][0])){
								
									echo $jugadores2g[$i][0];
									
									if ($jugadores2g[$i][1]==1){
									      echo "<b> (en contra)</b>";
									}
								}
								
								echo "</td>";
								
							echo "</tr>";
						}
					?>
					
					<tr class="table-danger">
						<td colspan='6' class="table-danger"><b>Expulsiones:</b></td>
					</tr>
					
					<?php
					
						$jugadores1ex=[];
						$jugadores2ex=[];
						
						$query_partido1e = "select nombre_jugador
						FROM amonestaciones_partidos
						inner join jugadores on jugadores.id_jugador=amonestaciones_partidos.jugadores_id_jugador
						WHERE amonestaciones_partidos.partidos_id_partido=".$id_partido. "
						and tarjeta_roja=1 
						and amonestaciones_partidos.equipos_id_equipo= ".$row_partido['id_equipo_local'];
// 	        				 echo $query_partido1g;
						$result_partido1e = $mysqli->query($query_partido1e); 

						while ($row_partido1e = mysqli_fetch_array($result_partido1e)) {
							$jugadores1ex[]=$row_partido1e;
						}
						
						
						$query_partido2e = "select nombre_jugador
						FROM amonestaciones_partidos
						inner join jugadores on jugadores.id_jugador=amonestaciones_partidos.jugadores_id_jugador
						WHERE amonestaciones_partidos.partidos_id_partido=".$id_partido. "
						and tarjeta_roja=1 
						and amonestaciones_partidos.equipos_id_equipo= ".$row_partido['id_equipo_visitante'];
						$result_partido2e = $mysqli->query($query_partido2e); 

						
						while ($row_partido2e = mysqli_fetch_array($result_partido2e)) {
							$jugadores2ex[]=$row_partido2e;
						}
						
						$count = max(count($jugadores1ex), count($jugadores2ex));
						
						for ($i=0;$i<=$count;$i++){
							echo "<tr>";
								echo "<td colspan='3'>";
								if (isset($jugadores1ex[$i][0])){
									echo $jugadores1ex[$i][0];
								}
								echo "</td>";
								echo "<td colspan='3'>";
								if (isset($jugadores2ex[$i][0])){
									echo $jugadores2ex[$i][0];
								}
								echo "</td>";
							echo "</tr>";
						}
					?>

				</tbody>
			</table>
			

		
	<?php
		}
	?>