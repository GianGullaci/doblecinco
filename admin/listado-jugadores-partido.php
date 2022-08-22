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
				<li><a href="#">Jugadores del Partido</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Jugadores del Partido</h2>
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
							</tr>
							</tbody>
						</table>
					</div>
					<div class="box-header" data-original-title id="nuevo">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Agregar Jugadores</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Olimpo</label>
								<div class="controls">
								  <select id="selectError1" multiple data-rel="chosen">
									<option>Ramiro Perez</option>
									<option selected>Juan Sebastian Perez</option>
									<option selected>Alberto Perez</option>
									<option>Guillermo Perez</option>
									<option>Mauro Perez</option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Liniers</label>
								<div class="controls">
								  <select id="selectError2" multiple data-rel="chosen">
									<option>Franco Perez</option>
									<option selected>Lucas Perez</option>
									<option selected>Matias Perez</option>
									<option>Carlos Perez</option>
									<option>Luis Perez</option>
								  </select>
								</div>
							  </div>

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Nacimiento</th>
								  <th>Club</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<tr>
								<td>Juan Perez</td>
								<td class="center">10-01-1992</td>
								<td class="center">Olimpo</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Martin Perez</td>
								<td class="center">07-09-1990</td>
								<td class="center">Liniers</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Rodriguez</td>
								<td class="center">09-03-1992</td>
								<td class="center">Liniers</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Pedro Perez</td>
								<td class="center">05-11-1990</td>
								<td class="center">Olimpo</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Gomez</td>
								<td class="center">05-11-1990</td>
								<td class="center">Liniers</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Martinez</td>
								<td class="center">01-06-1993</td>
								<td class="center">Olimpo</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
										
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Jose Perez</td>
								<td class="center">01-06-1993</td>
								<td class="center">Olimpo</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
										
									</a>
								</td>
							</tr>
							<tr>
								<td>Pablo Perez</td>
								<td class="center">01-06-1993</td>
								<td class="center">Olimpo</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
										
									</a>
								</td>
							</tr>
							<tr>
								<td>Diego Perez</td>
								<td class="center">10-01-1992</td>
								<td class="center">Olimpo</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
										
									</a>
								</td>
							</tr>
							<tr>
								<td>Sebastian Perez</td>
								<td class="center">07-09-1990</td>
								<td class="center">Liniers</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
										
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Ramirez</td>
								<td class="center">07-09-1990</td>
								<td class="center">Liniers</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
										
									</a>
								</td>
							</tr>
							<tr>
								<td>Pedro Juan Perez</td>
								<td class="center">07-09-1990</td>
								<td class="center">Olimpo</td>
								
								<td class="center">
									
									<a class="btn btn-info" href="editar-jugador.php?id=">
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
