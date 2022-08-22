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
				<li><a href="#">Categor&iacute;as Deportivas</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Categor&iacute;as Deportivas</h2>
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
								  <th>Categor&iacute;a Padre</th>
								  <th>Estado</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<tr>
								<td>Menores</td>
								<td>-</td>
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Juveniles</td>
								<td>-</td>
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Solo Menores</td>
								<td>-</td>
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
								</td>
							</tr>
							<tr>
								<td>CAT 00</td>
								<td>Menores</td>
								
								
								<td class="center">
									<span class="label label-important">Inactiva</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 01</td>
								<td>Menores</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 02</td>
								<td>Menores</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 03</td>
								<td>Menores</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 04</td>
								<td>Menores</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 96</td>
								<td>Juveniles</td>
								
								
								<td class="center">
									<span class="label label-important">Inactiva</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 97</td>
								<td>Juveniles</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 98</td>
								<td>Juveniles</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 99</td>
								<td>Juveniles</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>CAT 00</td>
								<td>Juveniles</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categoriad.php?id=">
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
		
	
	
	<div class="clearfix"></div>
	
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
</body>
</html>
