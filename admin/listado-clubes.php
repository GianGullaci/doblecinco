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
				<li><a href="#">Clubes</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Clubes</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-clubes">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Presiente</th>
								  <th>Estado Actual</th>
								  <!--<th>Estado</th>-->
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$query = "SELECT * FROM clubes order by nombre_club" or die("Error in the consult.." . mysqli_error($mysqli));
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_club']."'>";
									echo "<td>".ucfirst($row['nombre_club'])."</td>";
									echo "<td>".ucfirst($row['nombre_presidente'])."</td>";
									
									if ($row['club_activo']==1){
										echo '<td class="make-inactivo club-'.$row['id_club'].'"><span style="display:none;">SI</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a></td>';
									}
									else{
										echo '<td class="make-activo club-'.$row['id_club'].'"><span style="display:none;">NO</span><a class="btn btn-danger  "><i class="halflings-icon white remove"></i></a></td>';
									}
									
									echo "<td class='center'>
										<a class='btn btn-info' href='editar-club.php?id=".$row['id_club']."'>
									<i class='halflings-icon white edit'></i> 
									</a>
									<a class='btn btn-danger eliminar-btn' href='?delete=".$row['id_club']."'>
									<i class='halflings-icon white trash'></i>
									</a>
									</td>
									</tr>";
								}
							?>
							<!--
							<tr>
								<td>Club 0505</td>
								<td class="center">Jos&eacute; Perez</td>
								
								<td class="center">
									<span class="label label-success">Activo</span>
								</td>
								<td class="center">
									
									<a class="btn btn-info" href="editar-club.php?id=">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>-->
							
						  </tbody>
					  </table>            
					  <div class="alert alert-error" id="error_clubes" style="display:none;">
						  <strong>Error en la carga</strong> <span id="texto-error_clubes"></span>
					  </div>
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
		$( '#tabla-clubes' ).on( 'click', 'a.eliminar-btn', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-clubes').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-club.php',
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
		
		$('#tabla-clubes tbody').on( 'click', 'td.make-activo', function (e) {
				e.preventDefault();
				
				
				var parent = $(this).closest('tr');
				var td = $(this).closest('td');
				var table = $('#tabla-clubes').DataTable();
				var cell = table.cell( this );
				
				
 				$.ajax({
 					type: 'get',
 					url: 'includes/make-activo.php',
 					data: 'ajax=1&id_club=' + parent.attr('id').replace('record-',''),
 					success: function(data) {
 						var res = $.parseJSON(data);
 						if (res.modificado==true){
							cell.data('<span style="display:none;">SI</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a>').draw();
							td.removeClass("make-activo");
							td.addClass("make-inactivo");
							//como cambio la titularidad debo cambiar el id
// 							var nuevo_id = datos[0] + '-' + datos[1] + '-' + datos[2] + '-1-' + datos[4];
// 							parent.attr('id',nuevo_id);
 						}
 						else{	
							$('#texto-error_clubes').text("El registro no puede ser modificado. "+res.razon);
							$('#error_clubes').show().delay(5000).fadeOut();
 						}
 					}
 				});
			});
			
			$('#tabla-clubes tbody').on( 'click', 'td.make-inactivo', function (e) {
				e.preventDefault();
				
				
				
				var parent = $(this).closest('tr');
				var td = $(this).closest('td');
				var table = $('#tabla-clubes').DataTable();
				var cell = table.cell( this );
				
				
 				$.ajax({
 					type: 'get',
 					url: 'includes/make-inactivo.php',
 					data: 'ajax=1&id_club=' + parent.attr('id').replace('record-',''),
 					success: function(data) {
 						var res = $.parseJSON(data);
 						if (res.modificado==true){
							cell.data('<span style="display:none;">NO</span><a class="btn btn-danger"><i class="halflings-icon white remove"></i></a>').draw();
							
							td.removeClass("make-inactivo");
							td.addClass("make-activo");
							//como cambio la titularidad debo cambiar el id
// 							var nuevo_id = datos[0] + '-' + datos[1] + '-' + datos[2] + '-0-' + datos[4];
// 							parent.attr('id',nuevo_id);
							
 						}
 						else{	
 							$('#texto-error_clubes').text("El registro no pudo ser modificado");
							$('#error_clubes').show().delay(5000).fadeOut();
 						}
 					}
 				});
			});
	});
	</script>
	
</body>
</html>
