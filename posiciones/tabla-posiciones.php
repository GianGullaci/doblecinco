<?php

echo '<div class="col-lg-6 col-12">
	<h4 class="">'.$titulo.'. '.$subtitulo1.'</h4>
	<table class="table table-bordered">
		<thead>
		<tr>
			<th colspan="2">'.$entidad.'</th>
			<th>Pts</th>
			<th>PJ</th>
			<th>G</th>
			<th>E</th>
			<th>P</th>
			<th>Gf</th>
			<th>Gc</th>
		</tr>
		</thead>
		<tbody>
';
			

		$query_resultado = 
			"select id_torneo, ".$select_equipos." todos1.clubes_id_club, todos1.logo_club, todos1.categorias_id_categoria, 
		      sum(todos1.ganados) as ganados,
		      sum(todos1.perdidos) as perdidos,
		      sum(todos1.empatados) as empatados,
		      sum(todos1.empatados)+sum(todos1.perdidos)+sum(todos1.ganados) as jugados,
		      ".$puntos.",
		      IFNULL(puntos_sancion, 0) as tiene_sancion, comentarios_sancion,
		      sum(todos1.puntos) - IFNULL(puntos_sancion, 0) as total_puntos_con_sansion
		      from (
			  (select id_torneo, id_equipo, nombre_equipo, clubes_id_club, logo_club, categorias_id_categoria, 
		      sum(case resul_local.id_local when resul_local.id_ganador then 1 else 0 end) as ganados,
		      sum(case resul_local.id_local when resul_local.id_perdedor then 1 else 0 end) as perdidos,
		      sum(case resul_local.id_ganador when 0 then 1 else 0 end) as empatados,
		      (sum(case resul_local.id_local when resul_local.id_ganador then 1 else 0 end) *3 + sum(case resul_local.id_ganador when 0 then 1 else 0 end)) as puntos,
		      puntos_sancion, comentarios_sancion
		      from equipos
		      left join resultados_partidos as resul_local on resul_local.id_local=id_equipo
		      left join sanciones_equipos_torneo as sancion on (sancion.sanciones_id_torneo=resul_local.id_torneo and sancion.sanciones_id_club = clubes_id_club and sancion.sanciones_id_categoria = categorias_id_categoria and sancion.sanciones_id_fase = resul_local.fase and sancion.sanciones_id_equipo = id_equipo)
		      inner join clubes on clubes.id_club=clubes_id_club
		      where (resul_local.id_torneo=".$torneo_menores." or resul_local.id_torneo=".$torneo_infantiles." ) 
		      and resul_local.zona='A' and (resul_local.fase=".$fase." or resul_local.fase=".$fase2." ) 
		      ".$group." ) 
			  
			  union all

		      (select id_torneo, id_equipo, nombre_equipo, clubes_id_club, logo_club, categorias_id_categoria, 
		      sum(case resul_local.id_visitante when resul_local.id_ganador then 1 else 0 end) as ganados,
		      sum(case resul_local.id_visitante when resul_local.id_perdedor then 1 else 0 end) as perdidos,
		      sum(case resul_local.id_ganador when 0 then 1 else 0 end) as empatados,
		      (sum(case resul_local.id_visitante when resul_local.id_ganador then 1 else 0 end) *3 + sum(case resul_local.id_ganador when 0 then 1 else 0 end) ) as puntos,
		      puntos_sancion, comentarios_sancion
		      from equipos
		      left join resultados_partidos as resul_local on resul_local.id_visitante=id_equipo
		      left join sanciones_equipos_torneo as sancion on (sancion.sanciones_id_torneo=resul_local.id_torneo and sancion.sanciones_id_club = clubes_id_club and sancion.sanciones_id_categoria = categorias_id_categoria and sancion.sanciones_id_fase = resul_local.fase and sancion.sanciones_id_equipo = id_equipo)
		      inner join clubes on clubes.id_club=clubes_id_club
		      where (resul_local.id_torneo=".$torneo_menores." or resul_local.id_torneo=".$torneo_infantiles." ) 
		      and resul_local.zona='A'  and (resul_local.fase=".$fase." or resul_local.fase=".$fase2." ) 
		      ".$group.") 
			  ) as todos1 
			  

		      ".$where." 
		      
		      ".$group_todos." 
		      order by total_puntos_con_sansion desc
		";
			
	$result_resultado = $mysqli->query($query_resultado); 
	
	
	$arreglo_renglones=array();
	
	//en este while se mostraran los paneles de cada fecha
	while($row_resultado = mysqli_fetch_array($result_resultado)) {
	
			if ($row_resultado['total_puntos']<10){
				$row_resultado['total_puntos']="0".$row_resultado['total_puntos'];
			}
			if ($row_resultado['jugados']<10){
				$row_resultado['jugados']="0".$row_resultado['jugados'];
			}
			if ($row_resultado['ganados']<10){
				$row_resultado['ganados']="0".$row_resultado['ganados'];
			}
			if ($row_resultado['empatados']<10){
				$row_resultado['empatados']="0".$row_resultado['empatados'];
			}
			if ($row_resultado['perdidos']<10){
				$row_resultado['perdidos']="0".$row_resultado['perdidos'];
			}
			if ($row_resultado['total_puntos_con_sansion']<10){
				$row_resultado['total_puntos_con_sansion']="0".$row_resultado['total_puntos_con_sansion'];
			}
			if ($row_resultado['tiene_sancion']<=0){
				$row_resultado['tiene_sancion']=false;
			}
			else{
			  $row_resultado['tiene_sancion']=true;
			  
			}
			$row_resultado['comentarios_sancion']=$row_resultado['comentarios_sancion'];
			
			$goles_favor="00";
			$goles_contra = "00";
			

			if ($general){
			
			$query_goles = "
				  select count(*) as favor from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.nombre_equipo='".$row_resultado['nombre_equipo']."' 
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.nombre_equipo<>'".$row_resultado['nombre_equipo']."' 
				  and en_contra=1 
				  and (equipo_loc.nombre_equipo='".$row_resultado['nombre_equipo']."' or equipo_vis.nombre_equipo='".$row_resultado['nombre_equipo']."') 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				   ) as tabla
				  ";
			}
			else if  ($id_padre<>0){
				$query_goles = "
				  select count(*) as favor from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join categorias as cat_loc on cat_loc.id_categoria=equipo_loc.categorias_id_categoria
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.clubes_id_club=".$row_resultado['clubes_id_club']." 
				  and cat_loc.categorias_id_categoria=".$id_padre."
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join categorias as cat_loc on cat_loc.id_categoria=equipo_loc.categorias_id_categoria
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.clubes_id_club<>".$row_resultado['clubes_id_club']."  
				  and (equipo_loc.clubes_id_club=".$row_resultado['clubes_id_club']." or equipo_vis.clubes_id_club=".$row_resultado['clubes_id_club'].")  
				  and cat_loc.categorias_id_categoria=".$id_padre."
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  ) as tabla
				  
				  ";
			
			}
			else{
			
				$query_goles = "
				select count(*) as favor from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  where goles_partidos.equipos_id_equipo=".$row_resultado['id_equipo']." 
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  where goles_partidos.equipos_id_equipo<>".$row_resultado['id_equipo']." 
				  and (partidos.equipos_id_equipo=".$row_resultado['id_equipo']." or partidos.equipos_id_equipo1=".$row_resultado['id_equipo'].") 
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  ) as tabla
				  ";
			
			}
			
			
			$result_goles = $mysqli->query($query_goles); 
			
			if($row_goles = mysqli_fetch_array($result_goles)) {
				$goles_favor = $row_goles['favor'];
			}
			
			if ($goles_favor==0 or $goles_favor==null or $goles_favor=="NULL"){
				$goles_favor="00";
			}
			
			if ($goles_favor<10 and $goles_favor>0){
				$goles_favor="0".$goles_favor;
			}

			
			if ($general){
			
			$query_contra = "
				  select count(*) as contra from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.nombre_equipo<>'".$row_resultado['nombre_equipo']."' 
				  and (equipo_loc.nombre_equipo='".$row_resultado['nombre_equipo']."' or equipo_vis.nombre_equipo='".$row_resultado['nombre_equipo']."') 
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.nombre_equipo='".$row_resultado['nombre_equipo']."' 
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				   ) as tabla
				  ";

			}
			else if  ($id_padre<>0){
				$query_contra = "
				  select count(*) as contra from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join categorias as cat_loc on cat_loc.id_categoria=equipo_loc.categorias_id_categoria
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.clubes_id_club<>".$row_resultado['clubes_id_club']." 
				  and (equipo_loc.clubes_id_club=".$row_resultado['clubes_id_club']." or equipo_vis.clubes_id_club=".$row_resultado['clubes_id_club'].")  
				  and cat_loc.categorias_id_categoria=".$id_padre."
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join categorias as cat_loc on cat_loc.id_categoria=equipo_loc.categorias_id_categoria
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.clubes_id_club=".$row_resultado['clubes_id_club']."   
				  and cat_loc.categorias_id_categoria=".$id_padre."
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  ) as tabla
				  
				  ";
			
			}
			else{
			
				$query_contra = "
				select count(*) as contra from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  where goles_partidos.equipos_id_equipo<>".$row_resultado['id_equipo']." 
				  and (partidos.equipos_id_equipo=".$row_resultado['id_equipo']." or partidos.equipos_id_equipo1=".$row_resultado['id_equipo'].") 
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  where goles_partidos.equipos_id_equipo=".$row_resultado['id_equipo']." 
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  ) as tabla
				  ";
			
			}
			
			$result_contra = $mysqli->query($query_contra); 
			
			if($row_contra = mysqli_fetch_array($result_contra)) {
				$goles_contra = $row_contra['contra'];
			}
			if ($goles_contra==0 or $goles_contra==null or $goles_contra=="NULL"){
				$goles_contra="00";
			}
			
			if ($goles_contra<10 and $goles_contra>0){
				$goles_contra="0".$goles_contra;
			}
			
			$diferencia_de_goles= abs($goles_contra-$goles_favor);
			
			$arreglo_renglones[$row_resultado['nombre_equipo']]['clubes_id_club'] = $row_resultado['clubes_id_club'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['logo_club'] = $row_resultado['logo_club'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['nombre_equipo'] = $row_resultado['nombre_equipo'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['total_puntos'] = $row_resultado['total_puntos'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['jugados'] = $row_resultado['jugados'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['ganados'] = $row_resultado['ganados'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['empatados'] = $row_resultado['empatados'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['perdidos'] = $row_resultado['perdidos'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['goles_favor'] = $goles_favor;
			$arreglo_renglones[$row_resultado['nombre_equipo']]['goles_contra'] = $goles_contra;
			$arreglo_renglones[$row_resultado['nombre_equipo']]['diferencia_de_goles'] = $diferencia_de_goles;
			$arreglo_renglones[$row_resultado['nombre_equipo']]['total_puntos_con_sansion'] = $row_resultado['total_puntos_con_sansion'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['tiene_sancion'] = $row_resultado['tiene_sancion'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['comentarios_sancion'] = $row_resultado['comentarios_sancion'];
			
		}
		
		
		if (!empty($arreglo_renglones)){
			//ahora ordenamos el array
			$sort = array();
			foreach($arreglo_renglones as $k=>$v) {
			    $sort['total_puntos_con_sansion'][$k] = $v['total_puntos_con_sansion'];
			    $sort['diferencia_de_goles'][$k] = $v['diferencia_de_goles'];
			    $sort['goles_favor'][$k] = $v['goles_favor'];
			    $sort['ganados'][$k] = $v['ganados'];
			}
			# sort by event_type desc and then title asc
			array_multisort($sort['total_puntos_con_sansion'], SORT_DESC, $sort['diferencia_de_goles'], SORT_DESC,$sort['goles_favor'], SORT_DESC, $sort['ganados'], SORT_DESC, $arreglo_renglones);
			
			$id_sancion=0;
			$sanciones= array();
			foreach ($arreglo_renglones as $renglon){
				
				
				

				if ($general or $id_padre<>0){
				
					echo '
					
						<tr>
							<td>
								  <img src="img/clubes/'.$renglon['clubes_id_club'].'/'.$renglon['logo_club'].'" width="24" /></td><td>
								  '.$renglon['nombre_equipo'];
					if ($renglon['tiene_sancion']){
					  $id_sancion++;
					  $sanciones[$id_sancion]=$renglon['comentarios_sancion'];
					  echo "<sup>(".$id_sancion.")</sup>";
					  
					}
								 
					echo 		'</td>
							<td>'.$renglon['total_puntos_con_sansion'].'</td>
							<td>'. $renglon['jugados'].'</td>
							<td>'.$renglon['ganados'].'</td>
							<td>'. $renglon['empatados'].'</td>
							<td>'.$renglon['perdidos'].'</td>
							<td>'.$renglon['goles_favor'].'</td>
							<td>'.$renglon['goles_contra'].'</td>
						</tr>
					
					';
				}
				else{
			
					echo '
					
						<tr>
							<td>
								  <img src="img/clubes/'.$renglon['clubes_id_club'].'/'.$renglon['logo_club'].'" width="24" /></td><td>
								  '.$renglon['nombre_equipo'];
					if ($renglon['tiene_sancion']){
					  $id_sancion++;
					  $sanciones[$id_sancion]=$renglon['comentarios_sancion'];
					  echo "<sup>(".$id_sancion.")</sup>";
					}
					echo		'</td>
							<td>'.$renglon['total_puntos_con_sansion'].'</td>
							<td>'. $renglon['jugados'].' </td>
							<td>'.$renglon['ganados'].' </td>
							<td>'. $renglon['empatados'].' </td>
							<td>'.$renglon['perdidos'].' </td>
							<td>'.$renglon['goles_favor'].' </td>
							<td>'.$renglon['goles_contra'].'</td>
						</tr>
					
					';

				}
			
			}
 			if ($id_sancion>=1){
 			  foreach ($sanciones as $ind=>$valor){
 			    echo "<tr><td colspan='9'><sup>(".$ind.")</sup> ".$valor."</td></tr>";
 			  }
  			}
  			$sanciones=array();
  			$id_sancion=0;
			
		}
		$arreglo_renglones=array();
	?>

			</tbody>
		</table>
	</div>
	<?php
	
	echo '<div class="col-lg-6 col-12">
		<h4 class="">'.$titulo.'. '.$subtitulo2.'</h4>
		<table class="table table-bordered">
			<thead>
			<tr>
				<th colspan="2">'.$entidad.'</th>
				<th>Pts</th>
				<th>PJ</th>
				<th>G</th>
				<th>E</th>
				<th>P</th>
				<th>Gf</th>
				<th>Gc</th>
			</tr>
			</thead>
			<tbody>
	';
	

	$query_resultado = 
			"select ".$select_equipos." todos1.clubes_id_club, todos1.logo_club, todos1.categorias_id_categoria, 
		      sum(todos1.ganados) as ganados,
		      sum(todos1.perdidos) as perdidos,
		      sum(todos1.empatados) as empatados,
		      sum(todos1.empatados)+sum(todos1.perdidos)+sum(todos1.ganados) as jugados,
		      ".$puntos.",
		      IFNULL(puntos_sancion, 0) as tiene_sancion, comentarios_sancion,
		      sum(todos1.puntos) - IFNULL(puntos_sancion, 0) as total_puntos_con_sansion
		      from (
			  (select id_equipo, nombre_equipo, clubes_id_club, logo_club, categorias_id_categoria, 
		      sum(case resul_local.id_local when resul_local.id_ganador then 1 else 0 end) as ganados,
		      sum(case resul_local.id_local when resul_local.id_perdedor then 1 else 0 end) as perdidos,
		      sum(case resul_local.id_ganador when 0 then 1 else 0 end) as empatados,
		      (sum(case resul_local.id_local when resul_local.id_ganador then 1 else 0 end) *3 + sum(case resul_local.id_ganador when 0 then 1 else 0 end)) as puntos,
		      puntos_sancion, comentarios_sancion
		      from equipos
		      left join resultados_partidos as resul_local on resul_local.id_local=id_equipo
		      left join sanciones_equipos_torneo as sancion on (sancion.sanciones_id_torneo=resul_local.id_torneo and sancion.sanciones_id_club = clubes_id_club and sancion.sanciones_id_categoria = categorias_id_categoria and sancion.sanciones_id_fase = resul_local.fase and sancion.sanciones_id_equipo = id_equipo)
		      inner join clubes on clubes.id_club=clubes_id_club
		      where (resul_local.id_torneo=".$torneo_menores." or resul_local.id_torneo=".$torneo_infantiles." ) 
		      and resul_local.zona='B' and (resul_local.fase=".$fase." or resul_local.fase=".$fase2." ) 
		      ".$group.") 
			  
			  union all

		      (select id_equipo, nombre_equipo, clubes_id_club, logo_club, categorias_id_categoria, 
		      sum(case resul_local.id_visitante when resul_local.id_ganador then 1 else 0 end) as ganados,
		      sum(case resul_local.id_visitante when resul_local.id_perdedor then 1 else 0 end) as perdidos,
		      sum(case resul_local.id_ganador when 0 then 1 else 0 end) as empatados,
		      (sum(case resul_local.id_visitante when resul_local.id_ganador then 1 else 0 end) *3 + sum(case resul_local.id_ganador when 0 then 1 else 0 end) ) as puntos,
		      puntos_sancion, comentarios_sancion
		      from equipos
		      left join resultados_partidos as resul_local on resul_local.id_visitante=id_equipo
		      left join sanciones_equipos_torneo as sancion on (sancion.sanciones_id_torneo=resul_local.id_torneo and sancion.sanciones_id_club = clubes_id_club and sancion.sanciones_id_categoria = categorias_id_categoria and sancion.sanciones_id_fase = resul_local.fase and sancion.sanciones_id_equipo = id_equipo)
		      inner join clubes on clubes.id_club=clubes_id_club
		      where (resul_local.id_torneo=".$torneo_menores." or resul_local.id_torneo=".$torneo_infantiles." ) 
		      and resul_local.zona='B'  and (resul_local.fase=".$fase." or resul_local.fase=".$fase2." ) 
		      ".$group.") 
			  ) as todos1 
			  

		      ".$where." 
		      
		      ".$group_todos." 
		      order by total_puntos_con_sansion desc
		";
	$result_resultado = $mysqli->query($query_resultado); 
	$arreglo_renglones=array();
	
	//en este while se mostraran los paneles de cada fecha
	while($row_resultado = mysqli_fetch_array($result_resultado)) {
	
			if ($row_resultado['total_puntos']<10){
				$row_resultado['total_puntos']="0".$row_resultado['total_puntos'];
			}
			if ($row_resultado['jugados']<10){
				$row_resultado['jugados']="0".$row_resultado['jugados'];
			}
			if ($row_resultado['ganados']<10){
				$row_resultado['ganados']="0".$row_resultado['ganados'];
			}
			if ($row_resultado['empatados']<10){
				$row_resultado['empatados']="0".$row_resultado['empatados'];
			}
			if ($row_resultado['perdidos']<10){
				$row_resultado['perdidos']="0".$row_resultado['perdidos'];
			}
			
			if ($row_resultado['total_puntos_con_sansion']<10){
				$row_resultado['total_puntos_con_sansion']="0".$row_resultado['total_puntos_con_sansion'];
			}
			if ($row_resultado['tiene_sancion']<=0){
				$row_resultado['tiene_sancion']=false;
			}
			else{
			  $row_resultado['tiene_sancion']=true;
			  
			}
			$row_resultado['comentarios_sancion']=$row_resultado['comentarios_sancion'];
			
			$goles_favor="00";
			$goles_contra = "00";
			


		      if ($general){
			
			$query_goles = "
				  select count(*) as favor from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.nombre_equipo='".$row_resultado['nombre_equipo']."' 
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.nombre_equipo<>'".$row_resultado['nombre_equipo']."' 
				  and en_contra=1 
				  and (equipo_loc.nombre_equipo='".$row_resultado['nombre_equipo']."' or equipo_vis.nombre_equipo='".$row_resultado['nombre_equipo']."') 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				   ) as tabla
				  ";
			}
			else if  ($id_padre<>0){
				$query_goles = "
				  select count(*) as favor from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join categorias as cat_loc on cat_loc.id_categoria=equipo_loc.categorias_id_categoria
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.clubes_id_club=".$row_resultado['clubes_id_club']." 
				  and cat_loc.categorias_id_categoria=".$id_padre."
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join categorias as cat_loc on cat_loc.id_categoria=equipo_loc.categorias_id_categoria
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.clubes_id_club<>".$row_resultado['clubes_id_club']."  
				  and (equipo_loc.clubes_id_club=".$row_resultado['clubes_id_club']." or equipo_vis.clubes_id_club=".$row_resultado['clubes_id_club'].")  
				  and cat_loc.categorias_id_categoria=".$id_padre."
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  ) as tabla
				  
				  ";
			
			}
			else{
			
				$query_goles = "
				select count(*) as favor from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  where goles_partidos.equipos_id_equipo=".$row_resultado['id_equipo']." 
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  where goles_partidos.equipos_id_equipo<>".$row_resultado['id_equipo']." 
				  and (partidos.equipos_id_equipo=".$row_resultado['id_equipo']." or partidos.equipos_id_equipo1=".$row_resultado['id_equipo'].") 
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  ) as tabla
				  ";
			
			}
			
			
			$result_goles = $mysqli->query($query_goles); 
			
			if($row_goles = mysqli_fetch_array($result_goles)) {
				$goles_favor = $row_goles['favor'];
			}
			
			if ($goles_favor==0 or $goles_favor==null or $goles_favor=="NULL"){
				$goles_favor="00";
			}
			
			if ($goles_favor<10 and $goles_favor>0){
				$goles_favor="0".$goles_favor;
			}

			


			if ($general){
			
			$query_contra = "
				  select count(*) as contra from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.nombre_equipo<>'".$row_resultado['nombre_equipo']."' 
				  and (equipo_loc.nombre_equipo='".$row_resultado['nombre_equipo']."' or equipo_vis.nombre_equipo='".$row_resultado['nombre_equipo']."') 
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.nombre_equipo='".$row_resultado['nombre_equipo']."' 
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				   ) as tabla
				  ";
			}
			else if  ($id_padre<>0){
				$query_contra = "
				  select count(*) as contra from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join categorias as cat_loc on cat_loc.id_categoria=equipo_loc.categorias_id_categoria
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.clubes_id_club<>".$row_resultado['clubes_id_club']." 
				  and (equipo_loc.clubes_id_club=".$row_resultado['clubes_id_club']." or equipo_vis.clubes_id_club=".$row_resultado['clubes_id_club'].")  
				  and cat_loc.categorias_id_categoria=".$id_padre."
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  left join equipos as equipo_gol on equipo_gol.id_equipo=goles_partidos.equipos_id_equipo
				  left join equipos as equipo_loc on equipo_loc.id_equipo=partidos.equipos_id_equipo
				  left join categorias as cat_loc on cat_loc.id_categoria=equipo_loc.categorias_id_categoria
				  left join equipos as equipo_vis on equipo_vis.id_equipo=partidos.equipos_id_equipo1
				  where equipo_gol.clubes_id_club=".$row_resultado['clubes_id_club']."   
				  and cat_loc.categorias_id_categoria=".$id_padre."
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  ) as tabla
				  
				  ";
			
			}
			else{
			
				$query_contra = "
				select count(*) as contra from 
				  
				  (
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  where goles_partidos.equipos_id_equipo<>".$row_resultado['id_equipo']." 
				  and (partidos.equipos_id_equipo=".$row_resultado['id_equipo']." or partidos.equipos_id_equipo1=".$row_resultado['id_equipo'].") 
				  and en_contra=0 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  
				  union all
				  
				  (select id_goles_partidos from goles_partidos
				  left join partidos on id_partido=goles_partidos.partidos_id_partido
				  left join fechas on id_fecha=partidos.fechas_id_fecha
				  where goles_partidos.equipos_id_equipo=".$row_resultado['id_equipo']." 
				  and en_contra=1 
				  and (torneos_id_torneo1=".$torneo_menores."  or torneos_id_torneo1=".$torneo_infantiles.")
				  and (fase=".$fase." or fase=".$fase2."))
				  ) as tabla
				  ";
			
			}
			
			$result_contra = $mysqli->query($query_contra); 
			
			if($row_contra = mysqli_fetch_array($result_contra)) {
				$goles_contra = $row_contra['contra'];
			}
			if ($goles_contra==0 or $goles_contra==null or $goles_contra=="NULL"){
				$goles_contra="00";
			}
			
			if ($goles_contra<10 and $goles_contra>0){
				$goles_contra="0".$goles_contra;
			}
			
			$diferencia_de_goles= abs($goles_contra-$goles_favor);
			
			$arreglo_renglones[$row_resultado['nombre_equipo']]['nombre_equipo'] = $row_resultado['nombre_equipo'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['clubes_id_club'] = $row_resultado['clubes_id_club'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['logo_club'] = $row_resultado['logo_club'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['total_puntos'] = $row_resultado['total_puntos'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['jugados'] = $row_resultado['jugados'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['ganados'] = $row_resultado['ganados'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['empatados'] = $row_resultado['empatados'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['perdidos'] = $row_resultado['perdidos'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['goles_favor'] = $goles_favor;
			$arreglo_renglones[$row_resultado['nombre_equipo']]['goles_contra'] = $goles_contra;
			$arreglo_renglones[$row_resultado['nombre_equipo']]['diferencia_de_goles'] = $diferencia_de_goles;
			$arreglo_renglones[$row_resultado['nombre_equipo']]['total_puntos_con_sansion'] = $row_resultado['total_puntos_con_sansion'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['tiene_sancion'] = $row_resultado['tiene_sancion'];
			$arreglo_renglones[$row_resultado['nombre_equipo']]['comentarios_sancion'] = $row_resultado['comentarios_sancion'];
			
		}
		
		if (!empty($arreglo_renglones)){
			
			//ahora ordenamos el array
			$sort = array();
			
			foreach($arreglo_renglones as $k=>$v) {
			    $sort['total_puntos_con_sansion'][$k] = $v['total_puntos_con_sansion'];
			    $sort['diferencia_de_goles'][$k] = $v['diferencia_de_goles'];
			    $sort['goles_favor'][$k] = $v['goles_favor'];
			    $sort['ganados'][$k] = $v['ganados'];
			}
		
		
		
			array_multisort($sort['total_puntos_con_sansion'], SORT_DESC, $sort['diferencia_de_goles'], SORT_DESC,$sort['goles_favor'], SORT_DESC, $sort['ganados'], SORT_DESC, $arreglo_renglones);
			
			$id_sancion=0;
			$sanciones= array();
			
			
			foreach ($arreglo_renglones as $renglon){
				
				if ($general or $id_padre<>0){
				
					echo '
					
						<tr>
							<td>
								  <img src="img/clubes/'.$renglon['clubes_id_club'].'/'.$renglon['logo_club'].'" width="24" /></td><td>
								  '.$renglon['nombre_equipo'];
							if ($renglon['tiene_sancion']){
							  
							  $id_sancion++;
							  $sanciones[$id_sancion]=$renglon['comentarios_sancion'];
							  echo "<sup>(".$id_sancion.")</sup>";
							  
							}
					echo '		</td>
							<td>'.$renglon['total_puntos_con_sansion'].'</td>
							<td>'. $renglon['jugados'].'</td>
							<td>'.$renglon['ganados'].'</td>
							<td>'. $renglon['empatados'].'</td>
							<td>'.$renglon['perdidos'].'</td>
							<td>'.$renglon['goles_favor'].'</td>
							<td>'.$renglon['goles_contra'].'</td>
						</tr>
					
					';
				}
				else{
			
					echo '
					
						<tr>
							<td>
								  <img src="img/clubes/'.$renglon['clubes_id_club'].'/'.$renglon['logo_club'].'" width="24" /></td><td>
								  '.$renglon['nombre_equipo'];
							if ($renglon['tiene_sancion']){
							  
							  $id_sancion++;
							  $sanciones[$id_sancion]=$renglon['comentarios_sancion'];
							  echo "<sup>(".$id_sancion.")</sup>";
							  
							}
					echo '		</td>
							<td>'.$renglon['total_puntos_con_sansion'].'</td>
							<td>'. $renglon['jugados'].' </td>
							<td>'.$renglon['ganados'].' </td>
							<td>'. $renglon['empatados'].' </td>
							<td>'.$renglon['perdidos'].' </td>
							<td>'.$renglon['goles_favor'].' </td>
							<td>'.$renglon['goles_contra'].'</td>
						</tr>
					
					';
				}
			
			}
			
			if ($id_sancion>=1){
 			  foreach ($sanciones as $ind=>$valor){
 			    echo "<tr><td colspan='9'><sup>(".$ind.")</sup> ".$valor."</td></tr>";
 			  }
  			}
  			$sanciones=array();
  			$id_sancion=0;
		}
		$arreglo_renglones=array();
	?>

			</tbody>
		</table>
	</div>