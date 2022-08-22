<!--penales-->
			<div class="row-fluid sortable">
				<div class="box span12">
				<div class="box span6">
					<div class="box-header" data-original-title id="nuevo">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Penal</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon <?=$chevron_penales?>"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content" style="margin-left: 0; <?=$display_penales?>" >
						<form class="form-horizontal" id="form_penales">
						  <fieldset>
							  <div class="control-group">
								<label class="control-label" for="selectError">Equipo</label>
								<div class="controls">
								  <select id="equipo_penal" name="equipo_penal" data-rel="chosen">
									<option value="<?=$id_equipo_local?>"><?=$nombre_local?></option>
									<option value="<?=$id_equipo_visitante?>"><?=$nombre_visitante?></option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Jugador</label>
								<div class="controls">
								  <select id="jugador_penal" name="jugador_penal" data-rel="chosen" required>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="hora_penal">Hora (Formato: 99:99)</label>
								<div class="controls">
								  <input class="input-medium focused" id="hora_penal" name="hora_penal" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								</div>
							  </div>
							
							  <div class="alert alert-error" id="error_penal" style="display:none;">
								<strong>Error en la carga</strong> <span id="texto-error_penal"></span>
							</div>
							<div class="alert alert-success" id="guardado_penal" style="display:none;">
								<strong>Guardado!</strong>El penal ha sido guardado con éxito
							</div>
							<div class="form-actions">
							  <input type="submit" name="guardarpenal" id="guardarpenal" class="btn btn-primary" value="Guardar Penal" />
							</div>
						  </fieldset>
						</form>   

					</div>
				</div>
					
				<div class="box span6">
					<div class="box-header" data-original-title id="nuevo">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Penales ya cargados</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon <?=$chevron_penales?>"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content" style="margin-left: 0; <?=$display_penales?>">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-penales">
						  <thead>
							  <tr>
								  <th>Jugador</th>
								  <th>Equipo</th>
								  <th>Hora</th>
								  
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php
								$query = "SELECT id_penales_partidos as id_penal, penales_partidos.hora as hora, nombre_jugador, nombre_club
								FROM penales_partidos
								left join jugadores on jugadores.id_jugador=penales_partidos.jugadores_id_jugador
								left join equipos on equipos.id_equipo=penales_partidos.equipos_id_equipo
								left join clubes on clubes.id_club=equipos.clubes_id_club
								where partidos_id_partido=".$id_partido;
								// echo $query;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_penal']."'>";
									echo "<td>".$row['nombre_jugador']."</td>";
									echo "<td>".$row['nombre_club']."</td>";
									echo "<td>".$row['hora']."</td>";
									
									echo 
										'<td class="center">
											<a class="btn btn-danger delete-penal" href="#">
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

			
    

	</div><!--/.fluid-container-->