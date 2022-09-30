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
			
			<?php
				$id_torneo=0;
				$wheresql = "";
				if (isset($_GET['torneo'])){
					$id_torneo= $_GET['torneo'];
					$wheresql = " WHERE id_torneo=".$id_torneo." ";
				}
			?>
			
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.php">inicio</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Fechas</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Fechas</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-fechas">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Fecha Inicio</th>
								  <th>Fecha Fin</th>
								  <th>Torneo</th>
								  <th>Fase</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$query = "SELECT fechas.id_fecha, fechas.nombre, fechas.fecha_fin as fecha_fin,
								fechas.fecha_inicio as fecha_inicio, torneos.nombre_torneo, fechas.fase 
								FROM fechas 
								left join torneos on torneos.id_torneo=fechas.torneos_id_torneo1 
								".$wheresql ." 
								order by nombre";
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_fecha']."'>";
									echo "<td>".ucfirst($row['nombre'])."</td>";
									$inicio="-";
									if (isset($row['fecha_inicio']) and $row['fecha_inicio']!="" and $row['fecha_inicio']!="NULL" and $row['fecha_inicio']!="0000-00-00 00:00:00"){
										$inicio = date("d-m-Y", strtotime($row['fecha_inicio']));
									}
									$fin="-";
									if (isset($row['fecha_fin']) and $row['fecha_fin']!="" and $row['fecha_fin']!="NULL" and $row['fecha_fin']!="0000-00-00 00:00:00"){
										$fin = date("d-m-Y", strtotime($row['fecha_fin']));
									}
									echo "<td>".$inicio."</td>";
									echo "<td>".$fin."</td>";
									echo "<td>".$row['nombre_torneo']."</td>";
									$fase= $row['fase'];
									if ($fase==1 or $fase==6){
										$fase= "Fase 1";
									}
									else if ($fase==2){
										$fase= "Fase 2 Juveniles";
									}
									else if ($fase==3){
										$fase= "PlayOff Fase 2";
									}
									else if ($fase==4){
										$fase= "Fase 3";
									}
									else if ($fase==5){
										$fase= "PlayOff Fase 3";
									}
									else if ($fase==7){
										$fase= "Fase 2";
									}
									else if ($fase==8){
										$fase= "Torneo Clausura Menores";
									}
									else if ($fase==9){
										$fase= "PlayOff Fase 2";
									}
									else if ($fase==10){
										$fase= "Fase 3";
									}
									else if ($fase==11){
										$fase= "PlayOff Fase 3";
									}
									
									echo "<td>".$fase."</td>";
									
									
									echo "<td class='center'>
									<a class='btn btn-success' href='listado-partidos.php?id-fecha=".$row['id_fecha']."'>
									<i class='halflings-icon white barcode'></i>
									</a>
									<a class='btn btn-info' href='editar-fecha.php?id=".$row['id_fecha']."'>
									<i class='halflings-icon white edit'></i> 
									</a>
									<a class='btn btn-danger' href='?delete=".$row['id_fecha']."'>
									<i class='halflings-icon white trash'></i>
									</a>
									</td>
									</tr>";
								}
							?>
							
							<!--<tr>
								<td>Fecha 1</td>
								<td>02-03-2015</td>
								<td>05-03-2015</td>
								<td>Torneo YY</td>
								<td>Fase 1</td>
								<td class="center">
								
									<a class="btn btn-success" href="listado-partidos.php?id-fecha=1">
										<i class="halflings-icon white barcode"></i>  
									</a>
									<a class="btn btn-info" href="editar-fecha.php?id=">
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
