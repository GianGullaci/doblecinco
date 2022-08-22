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
			<li><a href="#">Publicidades</a></li>
		</ul>

		<div class="row-fluid sortable">		
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon user"></i><span class="break"></span>Publicidades</h2>
					<div class="box-icon">
						<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
						<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-fechas">
					  <thead>
						  <tr>
							  <th>Sección</th>
							  <th>Nombre Ubicación</th>
							  <th>Acciones</th>
						  </tr>
					  </thead>   
					  <tbody>
						<?php
							$query = "SELECT *
							FROM ubicaciones_publicidades
							WHERE seccion='home' 
							order by seccion, nombre_ubicacion";
							$result = $mysqli->query($query); 
							while($row = mysqli_fetch_array($result)) {
								echo "<tr id='record-".$row['id_ubicacion']."'>";
								echo "<td>".ucfirst($row['seccion'])."</td>";
								echo "<td>".ucfirst($row['nombre_ubicacion'])."</td>";
								
								echo "<td class='center'>
								<a class='btn btn-info' href='editar-publicidades.php?id=".$row['id_ubicacion']."'>
								<i class='halflings-icon white edit'></i> 
								</a>
								</td>
								</tr>";
							}
						?>
						
						
						
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
		$( '#tabla-fechas' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-fechas').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-fecha.php',
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
