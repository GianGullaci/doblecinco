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
				<li><a href="#">Campeones Menores</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<a class="btn btn-primary" type="button" href="nuevos-campeones-infantiles2.php">Agregar Nuevo</a>
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Campeones Menores</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-campeon">
						  <thead>
							  <tr>
								  <th>Nombre a mostrar</th>
								  <th>Club</th>
								  <th>Torneo</th>
								  <th>Categoría</th>
								  <th>Zona</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php
								$query = "SELECT * FROM campeones_infantiles2 
								left join clubes on clubes.id_club=campeones_infantiles2.clubes_id_club
								left join torneos on id_torneo=campeones_infantiles2.torneos_id_torneo
								left join categorias on categorias.id_categoria=campeones_infantiles2.categorias_id_categoria
								order by nombre_a_mostrar" ;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_campeon']."'>";
									echo "<td>".$row['nombre_a_mostrar']."</td>";
									echo "<td>".ucfirst($row['nombre_club'])."</td>";
									echo "<td>".ucfirst($row['nombre_torneo'])."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo "<td>".ucfirst($row['zona'])."</td>";
									
									echo "<td class='center'>
									<a class='btn btn-info' href='editar-campeones-infantiles2.php?id=".$row['id_campeon']."'>
									<i class='halflings-icon white edit'></i> 
									</a>
									<a class='btn btn-danger' href='?delete=".$row['id_campeon']."'>
									<i class='halflings-icon white trash'></i>
									</a>
									</td>
									</tr>";
								}
							?>
							
						  </tbody>
					  </table>            
					</div>
					<a class="btn btn-primary" type="button" href="nuevos-campeones-infantiles2.php">Agregar Nuevo</a>
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
		$( '#tabla-campeon' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-campeon').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-campeon-infantiles2.php',
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
