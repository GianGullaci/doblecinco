<div class="row-fluid sortable">
	<div class="box span12">
	<div class="box span6">
		<div class="box-header" data-original-title id="nuevo">
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Amonestaci&oacute;n</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon <?=$chevron_amonestaciones?>"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content" style="margin-left: 0; <?=$display_amonestaciones?>">
			<form class="form-horizontal" id="form_amonestaciones">
			  <fieldset>
				  <div class="control-group">
					<label class="control-label" for="selectError">Equipo</label>
					<div class="controls">
					  <select id="equipo_amonestacion" name="equipo_amonestacion" data-rel="chosen">
						<option value="<?=$id_equipo_local?>"><?=$nombre_local?></option>
						<option value="<?=$id_equipo_visitante?>"><?=$nombre_visitante?></option>
					  </select>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label" for="selectError">Jugador</label>
					<div class="controls">
					  <select id="jugador_amonestacion" name="jugador_amonestacion" data-rel="chosen" required>
					  </select>
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label">Amonestaci&oacute;n</label>
					<div class="controls">
					  <label class="radio">
						<input type="radio" name="tarjeta" id="amarilla" value="0" checked="">
						Tarjeta Amarilla
					  </label>
					  <div style="clear:both"></div>
					  <label class="radio">
						<input type="radio" name="tarjeta" id="roja" value="1">
						Tarjeta Roja
					  </label>
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
					<div class="controls">
					  <input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
					</div>
				  </div>
				   
				  <div class="alert alert-error" id="error_amonestacion" style="display:none;">
					<strong>Error en la carga</strong> <span id="texto-error_amonestacion"></span>
				</div>
				<div class="alert alert-success" id="guardado_amonestacion" style="display:none;">
					<strong>Guardada!</strong>La amonestacion ha sido guardada con éxito
				</div>
				<div class="form-actions">
				  <input type="submit" name="guardaramonestacion" id="guardaramonestacion" class="btn btn-primary" value="Guardar Amonestaci&oacute;n" />
				</div>
			  </fieldset>
			</form>   

		</div>
	</div>
		
	<div class="box span6">
		<div class="box-header" data-original-title id="nuevo">
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Amonestaciones ya cargadas</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon <?=$chevron_amonestaciones?>"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content" style="margin-left: 0; <?=$display_amonestaciones?>">
			<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-amonestaciones">
			  <thead>
				  <tr>
					  <th>Jugador</th>
					  <th>Equipo</th>
					  <th>Hora</th>
					  <th>Amonestaci&oacute;n</th>
					  <th>Acciones</th>
				  </tr>
			  </thead>   
			  <tbody>
			  
				<?php
					$query = "SELECT id_amonestaciones_partidos as id_amonestcion, amonestaciones_partidos.hora as hora, nombre_jugador, nombre_club, tarjeta_roja
					FROM amonestaciones_partidos
					left join jugadores on jugadores.id_jugador=amonestaciones_partidos.jugadores_id_jugador
					left join equipos on equipos.id_equipo=amonestaciones_partidos.equipos_id_equipo
					left join clubes on clubes.id_club=equipos.clubes_id_club
					where partidos_id_partido=".$id_partido;
					// echo $query;
					$result = $mysqli->query($query); 
					while($row = mysqli_fetch_array($result)) {
						echo "<tr id='record-".$row['id_amonestcion']."'>";
						echo "<td>".$row['nombre_jugador']."</td>";
						echo "<td>".$row['nombre_club']."</td>";
						echo "<td>".$row['hora']."</td>";
						if ($row['tarjeta_roja']==1){
							echo '<td class="center">Roja</td>';
						}
						else{
							echo '<td class="center">Amarilla</td>';
						}
						echo 
							'<td class="center">
								<a class="btn btn-danger delete-amonestacion" href="#">
								<i class="halflings-icon white trash"></i> 
								</a>
							</td>';
						echo "</tr>";
					}
				?>
				
			  </tbody>
		  </table>  
		</div>
	</div><!--/span-->

</div><!--/row-->