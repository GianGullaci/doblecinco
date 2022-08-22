<!--goles-->
			<div class="row-fluid sortable">
				<div class="box span12">
				<div class="box span6">
					<div class="box-header" data-original-title id="nuevo">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Gol</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon <?=$chevron_goles?>"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content" style="margin-left: 0; <?=$display_goles?>" >
						<form class="form-horizontal" id="form_goles">
						  <fieldset>
							  <div class="control-group">
								<label class="control-label" for="selectError">Equipo</label>
								<div class="controls">
								  <select id="equipo_gol" name="equipo_gol" data-rel="chosen">
									<option value="<?=$id_equipo_local?>"><?=$nombre_local?></option>
									<option value="<?=$id_equipo_visitante?>"><?=$nombre_visitante?></option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Jugador</label>
								<div class="controls">
								  <select id="jugador_gol" name="jugador_gol" data-rel="chosen" required>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="hora_gol">Hora (Formato: 99:99)</label>
								<div class="controls">
								  <input class="input-medium focused" id="hora_gol" name="hora_gol" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								</div>
							  </div>
							<div class="control-group">
									<label class="control-label">En contra</label>
									<div class="controls">
									  <label class="checkbox inline">
										<div class="checker" id="uniform-inlineCheckbox1"><span class=""><input type="checkbox" value="1" id="contra" name="contra"></span></div>
									  </label>
									</div>
							</div>
							  <div class="alert alert-error" id="error_gol" style="display:none;">
								<strong>Error en la carga</strong> <span id="texto-error_gol"></span>
							</div>
							<div class="alert alert-success" id="guardado_gol" style="display:none;">
								<strong>Guardado!</strong>El gol ha sido guardado con éxito
							</div>
							<div class="form-actions">
							  <input type="submit" name="guardargol" id="guardargol" class="btn btn-primary" value="Guardar Gol" />
							</div>
						  </fieldset>
						</form>   

					</div>
				</div>
					
				<div class="box span6">
					<div class="box-header" data-original-title id="nuevo">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Goles ya cargados</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon <?=$chevron_goles?>"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content" style="margin-left: 0; <?=$display_goles?>">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-goles">
						  <thead>
							  <tr>
								  <th>Jugador</th>
								  <th>Equipo</th>
								  <th>Hora</th>
								  <th>En Contra</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php
								$query = "SELECT id_goles_partidos as id_gol, goles_partidos.hora as hora, nombre_jugador, nombre_club, en_contra
								FROM goles_partidos
								left join jugadores on jugadores.id_jugador=goles_partidos.jugadores_id_jugador
								left join equipos on equipos.id_equipo=goles_partidos.equipos_id_equipo
								left join clubes on clubes.id_club=equipos.clubes_id_club
								where partidos_id_partido=".$id_partido;
								// echo $query;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_gol']."'>";
									echo "<td>".$row['nombre_jugador']."</td>";
									echo "<td>".$row['nombre_club']."</td>";
									echo "<td>".$row['hora']."</td>";
									if ($row['en_contra']==1){
										echo "<td><span class='label label-important'>SI</span></td>";
									}
									else{
										echo "<td>NO</td>";
									}
									echo 
										'<td class="center">
											<a class="btn btn-danger delete-gol" href="#">
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