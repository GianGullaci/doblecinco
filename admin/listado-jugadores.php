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
				<li><a href="#">Jugadores</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Jugadores</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-jugadores">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Nacimiento</th>
								  <th>Club</th>
								  <th>Posici&oacute;n</th>
								  <th>Link</th>
								  <th>Estado</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$query = "SELECT jugadores.nombre_jugador as nombre_jugador, jugadores.fecha_nacimiento as fecha_nacimiento,
								jugadores.id_jugador as id_jugador, ciudades.nombre as nombre_ciudad, jugadores.activo as activo,
								puesto.nombre_puesto as puesto, clubes.nombre_club as nombre_club
								FROM jugadores 
								left join ciudades on ciudades.id_ciudad=jugadores.ciudades_id_ciudad
								left join puesto on puesto.id_puesto=jugadores.puesto_id_puesto
								left join clubes on clubes.id_club=jugadores.clubes_id_club
								WHERE activo = 1
								order by nombre_jugador " or die("Error in the consult.." . mysqli_error($mysqli));
								
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_jugador']."'>";
									echo "<td>".ucfirst($row['nombre_jugador'])."</td>";
									echo "<td class='center'>".date("d-m-Y", strtotime($row['fecha_nacimiento']))."</td>";
									echo "<td class='center'>".$row['nombre_club']."</td>";
									echo "<td class='center'>".ucfirst($row['puesto'])."</td>";
									echo "<td class='center'>http://doblecinco.com.ar/sitio/jugadorpu.php?id=".$row['id_jugador']."</td>";
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
									<a class='btn btn-info' href='editar-jugador.php?id=".$row['id_jugador']."'>
									<i class='halflings-icon white edit'></i> 
									</a>
									<a class='btn btn-danger' href='?delete=".$row['id_jugador']."'>
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
		$( '#tabla-jugadores' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-jugadores').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-jugador.php',
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
