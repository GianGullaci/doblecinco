<div class="row-fluid sortable">
	<div class="box span12">
	
		<div class="box-header" data-original-title id="nuevo">
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Jugadores</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon <?=$chevron_jugadores?>"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content" <?=$display_jugadores?>>
			<form class="form-horizontal span6"  id="form-local">
			  <fieldset>
			  
				<div id="fieldset_jugadores">
					<div class="control-group">
						<label class="control-label"><b><?=$nombre_local?></b></label>
					</div>
				  <div class="control-group">
					<label class="control-label" for="focusedInput">Jugador</label>
					<div class="controls">
					  <select id="jugador_local" required name="jugador_local" data-rel="chosen">
						<?php
						    select_jugadores($mysqli,0,$id_local);
						?>
					  </select>
					</div>
				  </div>
				  <div class="controls" style="margin-bottom: 20px;">
					  <label class="radio">
						<input type="radio" name="titular_local" id="radio_titular_local1" value="1" checked="">
						Titular
					  </label>
					  <div style="clear:both"></div>
					  <label class="radio">
						<input type="radio" name="titular_local" id="radio_titular_local2" value="0">
						Suplente
					  </label>
				</div>
				  <div class="control-group">
					<label class="control-label" for="focusedInput">Posición</label>
					<div class="controls">
					  <select id="posicion_local" name="posicion_local" data-rel="chosen">
						<option value="0">Ninguna</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
					  </select>
					</div>
					
				  </div>
				  <div class="control-group" id="pregunta1">
					<label class="control-label" for="focusedInput">Puntaje</label>
					<div class="controls">
					  <select id="puntaje_local" id="puntaje_local" data-rel="chosen">
						<option value="0">Sin Puntaje</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					  </select>
					</div>
					
				  </div>
				  
				</div>
				
				
				<input type="hidden" name="jugadores_count" id="jugadores_count" value="1" />
				<div class="alert alert-error" id="error_jugador" style="display:none;">
					<!--<button data-dismiss="alert" class="close" type="button">×</button>-->
					<strong>Error en la carga</strong> <span id="texto-error_jugador"></span>
				</div>
				<div class="alert alert-success" id="guardado_jugador" style="display:none;">
					<!--<button data-dismiss="alert" class="close" type="button">×</button>-->
					<strong>Guardado!</strong>El jugador ha sido guardado con éxito
				</div>
				<div class="controls">
				  <button type="submit"  name="guardarjl" id="guardarjl" class="btn btn-primary">Guardar Jugador</button>
				  <!--<button type="reset" class="btn">Cancelar</button>-->
				</div>
			  </fieldset>
			</form>  
			<form class="form-horizontal span6" id="form-visitante">
			  <fieldset>
			  
				<div id="fieldset_jugadores">
					<div class="control-group">
						<label class="control-label"><b><?=$nombre_visitante?></b></label>
					</div>
				  <div class="control-group">
					<label class="control-label" for="focusedInput">Jugador</label>
					<div class="controls">
					  <select id="jugador_visitante" required name="jugador_visitante" data-rel="chosen">
						<?php
						    select_jugadores($mysqli,0,$id_visitante);
						?>
					  </select>
					</div>
				  </div>
				  <div class="controls" style="margin-bottom: 20px;">
					  <label class="radio">
						<input type="radio" name="titular_visitante" id="radio_titular_visitante1" value="1" checked="">
						Titular
					  </label>
					  <div style="clear:both"></div>
					  <label class="radio">
						<input type="radio" name="titular_visitante" id="radio_titular_visitante2" value="0">
						Suplente
					  </label>
				</div>
				  <div class="control-group">
					<label class="control-label" for="focusedInput">Posición</label>
					<div class="controls">
					  <select id="posicion_visitante" id="posicion_visitante"  data-rel="chosen">
						<option value="0">Ninguna</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
					  </select>
					</div>
					
				  </div>
				  <div class="control-group" id="pregunta1">
					<label class="control-label" for="focusedInput">Puntaje</label>
					<div class="controls">
					  <select id="puntaje_visitante" id="puntaje_visitante" data-rel="chosen">
						<option value="0">Sin Puntaje</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					  </select>
					</div>
					
				  </div>
				  
				</div>
				
				<input type="hidden" name="jugadores_count" id="jugadores_count" value="1" />
				<div class="alert alert-error" id="error_jugadorv" style="display:none;">
					<!--<button data-dismiss="alert" class="close" type="button">×</button>-->
					<strong>Error en la carga</strong> <span id="texto-error_jugadorv"></span>
				</div>
				<div class="alert alert-success" id="guardado_jugadorv" style="display:none;">
					<!--<button data-dismiss="alert" class="close" type="button">×</button>-->
					<strong>Guardado!</strong>El jugador ha sido guardado con éxito
				</div>
				<div class="controls">
				  <button type="submit"  name="guardarjv" id="guardarjv" class="btn btn-primary">Guardar Jugador</button>
				  <!--<button type="reset" class="btn">Cancelar</button>-->
				</div>
			  </fieldset>
			</form>  						

		</div>
	</div>
</div>