<?php
	$id_cat = $row_general3['id_categoria'];
?>

<!--
	En este archivo se muestra la informacion de una categoria paticular
	1. El listado superior con los numeros que determinan las fechas de esta categoria
	2. El panel de cada numero recien mencionado
-->
	

		<?php
			$j=1;
			
			echo '<div class="col-lg-6 col-12">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>Nombre</th>
						<th style="width: 30%;">Equipo</th>
						<th>Goles</th>
					</tr>
					</thead>
					<tbody>
			';
			
			$query_goleador = "select *
				  FROM goles_torneos 
				  where contra=0 
				  and categorias_id_categoria=".$id_cat." 
				  and (id_torneo=".$torneo_menores." or id_torneo=".$torneo_infantiles." ) 
				  order by favor desc";
				  
			$query_goleador="SELECT torneos.id_torneo as id_torneo, jugadores.id_jugador as id_jugador, jugadores.nombre_jugador as nombre_jugador,
			clubes.id_club as id_club, clubes.nombre_club as nombre_club, equipos.id_equipo as id_equipo,
			equipos.nombre_equipo as nombre_equipo, equipos.categorias_id_categoria as categorias_id_categoria,
			sum((case goles_partidos.en_contra when 1 then 0 else 1 end)) AS favor,
			sum((case goles_partidos.en_contra when 1 then 1 else 0 end)) AS contra,
			clubes.logo_club AS logo_club
			FROM `goles_partidos`
			left join jugadores on goles_partidos.jugadores_id_jugador=jugadores.id_jugador
			left join partidos on partidos.id_partido=goles_partidos.partidos_id_partido
			left join fechas on fechas.id_fecha=partidos.fechas_id_fecha
			left JOIN torneos on torneos.id_torneo=fechas.torneos_id_torneo1
			LEFT JOIN equipos on equipos.id_equipo = goles_partidos.equipos_id_equipo
			left join clubes on clubes.id_club=equipos.clubes_id_club
			where goles_partidos.en_contra=0
			and categorias_id_categoria=".$id_cat." 
			and (id_torneo=".$torneo_menores." or id_torneo=".$torneo_infantiles." ) 
			group by jugadores.id_jugador,clubes.id_club,equipos.id_equipo
			order by favor desc";

			$result_goleador = $mysqli->query($query_goleador); 
			
			//en este while se mostraran los paneles de cada fecha
			$contador = 0;
			while($row_goleador = mysqli_fetch_array($result_goleador)) {
					$cero = "";
					$contador++;
					if ($row_goleador['favor']<10){
						  $cero ="0";
					}
					if ($contador>10){
					    $class="tr-oculto";
					}
					if ($contador>20){
					    $class="tr-oculto2";
					}
					if ($contador>30){
					    $class="tr-oculto3";
					}
					echo '
					
						<tr>
							<td>'.$row_goleador['nombre_jugador'].'</td>
							<td style="width: 30%;text-align:left;">
								  <img src="img/clubes/'.$row_goleador['id_club'].'/'.$row_goleador['logo_club'].'" width="30" />
								  '.$row_goleador['nombre_equipo'].'
							</td>
							
							
							<td>'.$cero.$row_goleador['favor'].'</td>
						</tr>
					
					';
				
				}
			?>

					</tbody>
				</table>
										
			</div>