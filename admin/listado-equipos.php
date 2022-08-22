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
				<li><a href="#">Equipos</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Equipos</h2>
						<div class="box-icon">
							<!--<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>-->
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-equipos">
						  <thead>
							  <tr>
								  <th>Club</th>
								  <th>Nombre Equipo</th>
								  <th>Categor&iacute;a Deportiva</th>
								  <th>DT</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$query = "SELECT * FROM equipos 
								left join clubes on clubes.id_club=equipos.clubes_id_club
								left join categorias on categorias.id_categoria=equipos.categorias_id_categoria
								left join personal on personal.id_personal=equipos.personal_id_personal" ;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_equipo']."'>";
									echo "<td>".ucfirst($row['nombre_club'])."</td>";
									echo "<td>".ucfirst($row['nombre_equipo'])."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo "<td>".ucfirst($row['nombre'])."</td>";
									echo '<td class="center">
										      <a class="btn btn-info" href="editar-equipo.php?id='.$row['id_equipo'].'">
											      <i class="halflings-icon white edit"></i>  
										      </a>
										      <a class="btn btn-danger" href="#">
											      <i class="halflings-icon white trash"></i> 
										      </a>
									      </td>';
								}
							?>
							<!--<tr>
								<td>1</td>
								<td>Club XX</td>
								<td class="center">Quinta</td>
								<td class="center">Juan Perez</td>
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-equipo.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Club XY</td>
								<td class="center">Cuarta</td>
								<td class="center">Jos&eacute; Perez</td>
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									<a class="btn btn-info" href="editar-equipo.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>Club XX</td>
								<td class="center">Cuarta</td>
								<td class="center">Pedro Perez</td>
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-equipo.php?id=">
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
		$( '#tabla-equipos' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-equipos').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-equipo.php',
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
