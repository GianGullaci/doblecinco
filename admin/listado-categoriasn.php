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
				<li><a href="#">Categor&iacute;as Notas</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<a class="btn btn-primary" type="button" href="nueva-categorian.php">Nueva Categor&iacute;a</a>
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Categor&iacute;as Notas</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-categorian">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Categor&iacute;a Padre</th>
								  <th>Estado</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php
								$query = "SELECT cat.nombre_categoria AS nombre_categoria, cat.id_categoria_notas AS id_categoria, cat_padre.nombre_categoria AS nombre_categoria_padre, 
								cat_padre.id_categoria_notas AS id_categoria_padre, cat.activa as activa
								FROM categorias_notas as cat
								LEFT JOIN categorias_notas AS cat_padre ON cat_padre.id_categoria_notas = cat.categorias_notas_id_categoria_notas
								order by cat.nombre_categoria" ;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_categoria']."'>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo "<td>".ucfirst($row['nombre_categoria_padre'])."</td>";
									if ($row['activa']==1){
									  echo '<td class="center">';
									    echo '<span class="label label-success">Activa</span>';
									  echo '</td>';
									}
									else{
									  echo '<td class="center">';
									    echo '<span class="label label-important">Inactiva</span>';
									  echo '</td>';
									}
									echo "
									<td class='center'>
									<a class='btn btn-warning' href='editar-publicidades-categoria.php?id=".$row['id_categoria']."'>
									<i class='halflings-icon white usd'></i>
									</a>
									<a class='btn btn-danger' href='?delete=".$row['id_categoria']."'>
									<i class='halflings-icon white trash'></i>
									</a>";
									
									if ($row['id_categoria_padre']!=0 and $row['id_categoria']!=21 and $row['id_categoria']!=23 and $row['id_categoria']!=24){
									
										echo "
										<a class='btn btn-info' href='editar-categorian.php?id=".$row['id_categoria']."'>
										<i class='halflings-icon white edit'></i> 
										</a>";
									}
									
									echo "
									</td>
									</tr>";
								}
							?>
							
							<!--<tr>
								<td>Home</td>
								<td>-</td>
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>-->
							<!--<tr>
								<td>Nuestros Pibes</td>
								<td>-</td>
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Columnas</td>
								<td>-</td>
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
								</td>
							</tr>
							<tr>
								<td>La figura que asoma</td>
								<td>Nuestros Pibes</td>
								
								
								<td class="center">
									<span class="label label-important">Inactiva</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Así lo veo yo</td>
								<td>Nuestros Pibes</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>No paran de crecer</td>
								<td>Por los clubes</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>El dirigente</td>
								<td>Por los clubes</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Para imitar</td>
								<td>Fuera de juego</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>La jornada que pasó</td>
								<td>En la cancha</td>
								
								
								<td class="center">
									<span class="label label-important">Inactiva</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Multimedia</td>
								<td>-</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Deporte y Salud</td>
								<td>Columnas</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Mi heredero</td>
								<td>Nuestros Pibes</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>La fecha que viene</td>
								<td>En la cancha</td>
								
								
								<td class="center">
									<span class="label label-success">Activa</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-categorian.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>-->
							
						  </tbody>
					  </table>            
					</div>
					<a class="btn btn-primary" type="button" href="nueva-categorian.php">Nueva Categor&iacute;a</a>
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
	
	<script>
	$(document).ready(function() {
// 		$('a.btn-danger').click(function(e) {
		$( '#tabla-categorian' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-categorian').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-categorian.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted==true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
	});
	</script>
	
</body>
</html>
