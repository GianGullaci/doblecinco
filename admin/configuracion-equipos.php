<div class="row-fluid sortable">
	<div class="box span12">
	
		<div class="box-header" data-original-title id="nuevo">
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Configuraciones Equipos</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-down"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content" style="display:none;">
			<form class="form-horizontal">
			  <fieldset>
			  
				
				<div class="control-group">
					<label class="control-label">Configurac&oacute;n <?=$nombre_local?></label>
					<div class="controls">
						<label style="float:left;margin-top: 10px">
							<input type="radio" name="configuracion_local" id="configuracion_local1" value="0" <?php if ($configuracion_local==0){ echo 'checked=""'; } ?> >
							Ninguna
						</label>
						<label style="float:left;">
							<input type="radio" name="configuracion_local" id="configuracion_local2" value="1" <?php if ($configuracion_local==1){ echo 'checked=""'; } ?> >
							<img src="img/esquema1.jpg" width="80px">
						</label>
						<label style="float:left;">
							<input type="radio" name="configuracion_local" id="configuracion_local3" value="2" <?php if ($configuracion_local==2){ echo 'checked=""'; } ?> >
							<img src="img/esquema2.jpg" width="80px">
						</label>
						<label style="float:left;">
							<input type="radio" name="configuracion_local" id="configuracion_local4" value="3" <?php if ($configuracion_local==3){ echo 'checked=""'; } ?> >
							<img src="img/esquema3.jpg" width="80px">
						</label>
						<label style="float:left;">
							<input type="radio" name="configuracion_local" id="configuracion_local" value="4" <?php if ($configuracion_local==4){ echo 'checked=""'; } ?> >
							<img src="img/esquema4.jpg" width="80px">
						</label>
					</div>
				  </div>
				<div class="control-group">
					<label class="control-label">Configurac&oacute;n <?=$nombre_visitante?></label>
					<div class="controls">
						<label style="float:left;margin-top: 10px">
							<input type="radio" name="configuracion_visitante" id="configuracion_visitante1" value="0" <?php if ($configuracion_visitante==0){ echo 'checked=""'; } ?> >
							Ninguna
						</label>
						<label style="float:left;">
							<input type="radio" name="configuracion_visitante" id="configuracion_visitante2" value="1"  <?php if ($configuracion_visitante==1){ echo 'checked=""'; } ?> >
							<img src="img/esquema1.jpg" width="80px">
						</label>
						<label style="float:left;">
							<input type="radio" name="configuracion_visitante" id="configuracion_visitante3" value="2" <?php if ($configuracion_visitante==2){ echo 'checked=""'; } ?> >
							<img src="img/esquema2.jpg" width="80px">
						</label>
						<label style="float:left;">
							<input type="radio" name="configuracion_visitante" id="configuracion_visitante4" value="3" <?php if ($configuracion_visitante==3){ echo 'checked=""'; } ?> >
							<img src="img/esquema3.jpg" width="80px">
						</label>
						<label style="float:left;">
							<input type="radio" name="configuracion_visitante" id="configuracion_visitante5" value="4" <?php if ($configuracion_visitante==4){ echo 'checked=""'; } ?> >
							<img src="img/esquema4.jpg" width="80px">
						</label>
					</div>
				  </div>
				  <div class="alert alert-error" id="error_conf" style="display:none;">
					<strong>Error en la carga</strong> <span id="texto-error_conf"></span>
				</div>
				<div class="alert alert-success" id="guardado_conf" style="display:none;">
					<strong>Guardado!</strong>La configuracion ha sido guardada con éxito
				</div>
				<div class="form-actions">
				  <button type="submit" name="guardarconf" id="guardarconf" class="btn btn-primary">Guardar Confguraciones</button>
				</div>
			  </fieldset>
			</form>  						

		</div>
	</div>
</div>