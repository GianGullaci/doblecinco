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
				<li><a href="#">Sanciones</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Sanciones</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-sanciones">
						  <thead>
							  <tr>
								  <th>Club</th>
								  <th>Categoría</th>
								  <th>Equipo</th>
								  <th>Torneo</th>
								  <th>Fase</th>
								  <th>Puntos</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$query = "SELECT id_sancion, torneos.nombre_torneo, sanciones_equipos_torneo.sanciones_id_fase,
								sanciones_equipos_torneo.puntos_sancion, clubes.nombre_club, categorias.nombre_categoria, equipos.nombre_equipo
								FROM sanciones_equipos_torneo 
								left join torneos on torneos.id_torneo=sanciones_equipos_torneo.sanciones_id_torneo
								left join clubes on clubes.id_club=sanciones_equipos_torneo.sanciones_id_club
								left join categorias on categorias.id_categoria=sanciones_equipos_torneo.sanciones_id_categoria
								left join equipos on equipos.id_equipo=sanciones_equipos_torneo.sanciones_id_equipo
								".$wheresql ." 
								order by id_sancion desc";
 								//echo $query;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_sancion']."'>";
									echo "<td>".ucfirst($row['nombre_club'])."</td>";
									echo "<td>".$row['nombre_categoria']."</td>";
									echo "<td>".ucfirst($row['nombre_equipo'])."</td>";
									echo "<td>".$row['nombre_torneo']."</td>";
									$fase= $row['fase'];
									if ($fase==1 or $fase==6){
										$fase= "Fase 1";
									}
									else if ($fase==2){
										$fase= "Fase 2 Juveniles";
									}
									else if ($fase==3){
										$fase= "Semifinal Juveniles (Fase 3)";
									}
									else if ($fase==4){
										$fase= "Final Juveniles";
									}
									else if ($fase==5){
										$fase= "Finalisima Juveniles";
									}
									else if ($fase==7){
										$fase= "Torneo Apertura Menores";
									}
									else if ($fase==8){
										$fase= "Torneo Clausura Menores";
									}
									else if ($fase==9){
										$fase= "Final Menores";
									}
									
									echo "<td>".$fase."</td>";
									echo "<td>".$row['puntos_sancion']."</td>";
									
									echo "<td class='center'>
									<a class='btn btn-info' href='editar-sancion.php?id=".$row['id_sancion']."'>
									<i class='halflings-icon white edit'></i> 
									</a>
									<a class='btn btn-danger' href='?delete=".$row['id_sancion']."'>
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
		$( '#tabla-sanciones' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-sanciones').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-sancion.php',
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
