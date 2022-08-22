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
				<li><a href="#">Usuarios</a></li>
			</ul>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<a class="btn btn-primary" type="button" href="nuevo-usuario.php">Nuevo Usuario</a>
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Usuarios</h2>
						
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>E-mail</th>
								  <th>Estado</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<tr>
								<td>Juan Perez</td>
								<td>juanperez@gmail.com</td>
								
								
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
								
									<a class="btn btn-success" href="editar-claveu.php?id=">
										<i class="halflings-icon white barcode"></i>  
									</a>
									<a class="btn btn-info" href="editar-usuario.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn yellow" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Rodriguez</td>
								<td>juanrodriguez@gmail.com</td>
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									 
									<a class="btn btn-success" href="editar-claveu.php?id=">
										<i class="halflings-icon white barcode"></i>  
									</a>
									<a class="btn btn-info" href="editar-usuario.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn yellow" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juan Fernandez</td>
								<td>juanfernandez@gmail.com</td>
								
								
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="editar-claveu.php?id=">
										<i class="halflings-icon white barcode"></i>  
									</a>
									<a class="btn btn-info" href="editar-usuario.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn yellow" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
								</td>
							</tr>
							<tr>
								<td>Pedro Perez</td>
								<td>pedroperez@gmail.com</td>
								
								
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="editar-claveu.php?id=">
										<i class="halflings-icon white barcode"></i>  
									</a>
									<a class="btn btn-info" href="editar-usuario.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn yellow" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Pedro Rodriguez</td>
								<td>pedrorodriguez@gmail.com</td>
								
								
								<td class="center">
									<span class="label label-important">Inactivo</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="editar-claveu.php?id=">
										<i class="halflings-icon white barcode"></i>  
									</a>
									<a class="btn btn-info" href="editar-usuario.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn yellow" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Jose Perez</td>
								<td>joseperez@gmail.com</td>
								
								
								<td class="center">
									<span class="label label-important">Inactivo</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="editar-claveu.php?id=">
										<i class="halflings-icon white barcode"></i>  
									</a>
									<a class="btn btn-info" href="editar-usuario.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn yellow" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
							<tr>
								<td>Juan Manuel</td>
								<td>juanmanuel@gmail.com</td>
								
								
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="editar-claveu.php?id=">
										<i class="halflings-icon white barcode"></i>  
									</a>
									<a class="btn btn-info" href="editar-usuario.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn yellow" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
						  </tbody>
					  </table>            
					</div>
					<a class="btn btn-primary" type="button" href="nuevo-usuario.php">Nuevo Usuario</a>
				</div><!--/span-->
			
			</div><!--/row-->

			
			
			
			
			
    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
	
	<div class="clearfix"></div>
	
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
</body>
</html>
