<?php
	//recordemos estas variables:
	// $nombre_local=$row['nombre_local'];
	// $nombre_visitante=$row['nombre_visitante'];
	// $id_equipo_local=$row['id_equipo_local'];
	// $id_equipo_visitante=$row['id_equipo_visitante'];
	
	$query = "SELECT jugadores_partidos.equipos_id_equipo as id_equipo, nombre_jugador, puntaje, posicion, anio, titular, jugadores.id_jugador as id_jugador
	    FROM jugadores_partidos
	    left join partidos on partidos.id_partido=jugadores_partidos.partidos_id_partido
	    left join jugadores on jugadores.id_jugador=jugadores_partidos.jugadores_id_jugador
	    where jugadores_partidos.partidos_id_partido=".$id_partido ;
// 	    echo $query;
	    $result = $mysqli->query($query); 
	    
	    
?>

<div class="row-fluid sortable">
			
	<div class="box span12">
		<div class="box-header" data-original-title id="nuevo">
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Jugadores ya cargados</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-down"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content" style="display:none;">
			<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-jugadores-partido">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>A&ntilde;o</th>
						<th>Club</th>
						<th>Titular</th>
						<th>Puntaje</th>
						<th>Posici&oacute;n <a href="#" class="ver-cancha">(ver cancha)</a></th>
						<th>Acciones</th>
					</tr>
				</thead>   
				<tbody>
				
				<?php
			  
					while ($row = mysqli_fetch_array($result)) {
						$nombre_jugador=$row['nombre_jugador'];
						$anio = $row['anio'];
						$equipo_donde_juega = $row['id_equipo'];
						$titular=$row['titular'];
						$puntaje=$row['puntaje'];
						$posicion=$row['posicion'];
						$id_jugador=$row['id_jugador'];
						
						echo "<tr id='record-".$row['id_jugador']."-".$equipo_donde_juega."-".$titular."-".$posicion."'>";
							echo '<td>'.$nombre_jugador.'</td>';
							echo '<td class="center">'.$anio.'</td>';
							if ($equipo_donde_juega==$id_equipo_local){
								echo '<td class="center">'.$nombre_local.'</td>';
							}
							else{
								echo '<td class="center">'.$nombre_visitante.'</td>';
							}
							if ($row['titular']==1){
								echo '<td class="make-suplente equipo-'.$equipo_donde_juega.'"><span style="display:none;">SI</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a></td>';
							}
							else{
								echo '<td class="make-titular equipo-'.$equipo_donde_juega.'"><span style="display:none;">NO</span><a class="btn btn-danger  "><i class="halflings-icon white remove"></i></a></td>';
							}
							echo '<td>							
 								  <input type="number" id="puntaje-'.$id_jugador.'" class="input-mini focused" min=0 max=10 value="'.$puntaje.'">
								  <span style="display:none;">SI</span><a class="btn btn-info change-puntaje"><i class="halflings-icon white check"></i></a>
							      </td>';
							echo '<td>
								  <input type="number" id="posicion-'.$id_jugador.'" class="input-mini focused '.$equipo_donde_juega.'" min=0 max=11 value="'.$posicion.'">
								  <span style="display:none;">SI</span><a class="btn btn-info change-posicion"><i class="halflings-icon white check"></i></a>
							      </td>';
							echo '<td class="center">
									<a class="btn btn-info" target="_blank" href="editar-jugador.php?id='.$id_jugador.'">
										<i class="halflings-icon white pencil"></i>  
									</a>
									<a class="btn btn-danger del-jugador" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>';
						echo '</tr>';
					}
				?>
				
				</tbody>
			</table>     
		
			<div class="alert alert-error" id="error_jugadores" style="display:none;">
				<strong>Error en la carga</strong> <span id="texto-error_jugadores"></span>
			</div>
			<div class="alert alert-success" id="guardado_jugadores" style="display:none;">
				<strong>Guardado!</strong><span id="texto-jugadores"></span>
			</div>
		</div>
	</div>
</div>


<script>
	
</script>