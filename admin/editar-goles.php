<?php 		include("head.php"); ?>


<body>
		<?php
			include("header.php");
		?>
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<?php
				include("menu-left.php");
			?>
			
			
			
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.php">inicio</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Goles del Partido</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Informaci&oacute;n del Partido</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable">
						  <thead>
							  <tr>
								  <th>Torneo</th>
								  <th>Fecha</th>
								  <th>Día</th>
								  <th>Hora</th>
								  <th>Lugar</th>
								  <th>Categoría</th>
								  <th>Equipo Local</th>
								  <th>Equipo Visitante</th>
							  </tr>
						  </thead>   
						  <tbody>
							<tr>
								<td>Torneo XX</td>
								<td class="center">Fecha YY</td>
								<td class="center">21-03-2015</td>
								<td class="center">15:40</td>
								<td class="center">Civechi</td>
								<td class="center">Cuarta</td>
								<td class="center">Liniers: 1 gol(es)</td>
								<td class="center">Olimpo: 2 gol(es)</td>
							</tr>
							</tbody>
						</table>
					</div>
					<div class="box-header" data-original-title id="nuevo">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Agregar Gol</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							  <div class="control-group">
								<label class="control-label" for="selectError">Equipo</label>
								<div class="controls">
								  <select id="selectError3" data-rel="chosen">
									<option>Olimpo</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Jugador</label>
								<div class="controls">
								  <select id="selectError2" data-rel="chosen">
									<option>Juan Perez</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Hora</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" value="">
								</div>
							  </div>
							  

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Cargar</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
					<br>
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Goles Actuales</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Jugador</th>
								  <th>Equipo</th>
								  <th>Hora</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<tr>
								<td>Juan Perez</td>
								<td class="center">Olimpo</td>
								<td class="center">15:49</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-gol.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Martin Perez</td>
								<td class="center">Liniers</td>
								<td class="center">16:01</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-gol.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Rodriguez</td>
								<td class="center">Olimpo</td>
								<td class="center">16:09</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-gol.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
						  </tbody>
					  </table>            
					</div>
					
					
					
				</div><!--/span-->
			
			</div><!--/row-->

			
			
			
			
			
    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
</body>
</html>
