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
				<li><a href="#">Torneos</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Torneos</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-torneos">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Fecha Inicio</th>
								  <th>Estado</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$query = "SELECT id_torneo, nombre_torneo, fecha_fin, fecha_inicio,
								DATEDIFF(fecha_inicio,CURDATE()) as ini, DATEDIFF(fecha_fin,CURDATE()) as fin 
								FROM torneos order by nombre_torneo" ;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_torneo']."'>";
									echo "<td>".ucfirst($row['nombre_torneo'])."</td>";
									$inicio="-";
									$comparar=true;
									$fin="-";
									if (isset($row['fecha_inicio']) and $row['fecha_inicio']!="" and $row['fecha_inicio']!="NULL" and $row['fecha_inicio']!="0000-00-00 00:00:00"){
										$inicio = date("d-m-Y", strtotime($row['fecha_inicio']));
									}
									else{
										$comparar =false;
									}
									
									if (isset($row['fecha_fin']) and $row['fecha_fin']!="" and $row['fecha_fin']!="NULL" and $row['fecha_fin']!="0000-00-00 00:00:00"){
										$fin = date("d-m-Y", strtotime($row['fecha_fin']));
									}
									else{
										$comparar =false;
									}
									
									echo "<td>".$inicio."</td>";
									$hoy = date_create("now");
									if ($comparar){
										
										if ($row['ini']<=0 and $row['fin']>=0){
 										  echo '<td class="center">';
 											echo '<span class="label label-success">En curso</span>';
 										  echo '</td>';
 										}
 										else if ($row['fin']<0){
 										  echo '<td class="center">';
 											echo '<span class="label label-important">Finalizado</span>';
 										  echo '</td>';
 										}
 										else{
 											echo '<td class="center">';
 												echo '<span class="label label-info">No iniciado</span>';
 											echo '</td>';
 										}
										
									}
									else{
										echo '<td class="center">';
												echo '<span class="label label-warning">Sin datos</span>';
											echo '</td>';
									}
									
									echo "<td class='center'>
									<a class='btn btn-success' href='listado-fechas.php?torneo=".$row['id_torneo']."'>
									<i class='halflings-icon white barcode'></i>
									</a>
									<a class='btn btn-info' href='editar-torneo.php?id=".$row['id_torneo']."'>
									<i class='halflings-icon white edit'></i> 
									</a>
									<a class='btn btn-danger' href='?delete=".$row['id_torneo']."'>
									<i class='halflings-icon white trash'></i>
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
		$( '#tabla-torneos' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-torneos').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-torneo.php',
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
