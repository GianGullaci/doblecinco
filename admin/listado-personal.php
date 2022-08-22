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
				<li><a href="#">Personal</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Personal</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-personal">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Club</th>
								  <th>Estado</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php
								$query = "SELECT * FROM personal 
								left join clubes on clubes.id_club=personal.clubes_id_club
								order by nombre" ;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_personal']."'>";
									echo "<td>".ucfirst($row['nombre'])."</td>";
									echo "<td>".ucfirst($row['nombre_club'])."</td>";
									if ($row['activo']==1){
									  echo '<td class="center">';
									    echo '<span class="label label-success">Activo</span>';
									  echo '</td>';
									}
									else{
									  echo '<td class="center">';
									    echo '<span class="label label-important">Inactivo</span>';
									  echo '</td>';
									}
									echo "<td class='center'>
									<a class='btn btn-info' href='editar-personal.php?id=".$row['id_personal']."'>
									<i class='halflings-icon white edit'></i> 
									</a>
									<a class='btn btn-danger' href='?delete=".$row['id_personal']."'>
									<i class='halflings-icon white trash'></i>
									</a>
									</td>
									</tr>";
								}
							?>
							
							<!--<tr>
								<td>Juan Perez</td>
								
								<td class="center">Club 00</td>
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-personal.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
							<tr>
								<td>Juan Fernandez</td>
								
								<td class="center">Club 00</td>
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-personal.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
								</td>
							</tr>
							<tr>
								<td>Pedro Perez</td>
								
								<td class="center">Club 02</td>
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-personal.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Pedro Rodriguez</td>
								
								<td class="center">Club 02</td>
								<td class="center">
									<span class="label label-important">Inactivo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-personal.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>Jose Perez</td>
								
								<td class="center">Club 01</td>
								<td class="center">
									<span class="label label-important">Inactivo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-personal.php?id=">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
							<tr>
								<td>Juan Manuel</td>
								
								<td class="center">Club 04</td>
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-personal.php?id=">
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
		$( '#tabla-personal' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-personal').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-personal.php',
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