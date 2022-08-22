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
				$id_fecha=0;
				if (isset($_GET['id-fecha'])){
					$id_fecha= $_GET['id-fecha'];
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
				<li><a href="?">Partidos</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Partidos</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-partidos">
						  <thead>
							  <tr>
								  <th>Fecha</th>
								  <th>Zona</th>
								  <th>D&iacute;a</th>
								  <th>Hora</th>
								  <th>Categor&iacute;a</th>
								  <th>Local</th>
								  <th>Visitante</th>
								  <th>Estado</th>
								  <!--<th>Ausente</th>-->
								  <th>Lugar</th>
								  <th>Torneo</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
							<?php
								$where = " ";
								if (isset($_GET['id-fecha'])){
									$where = " WHERE partidos.fechas_id_fecha=".$_GET['id-fecha'];
								}
								$query = "SELECT id_partido, fecha_partido, hora_partido,lugares.direccion as lugar, tipo_lugar, zona, 
									  club_juega.nombre_club as nombre_juega, club_local.nombre_club as nombre_local, 
									  club_visitante.nombre_club as nombre_visitante, nombre_categoria,  fechas.nombre as nombre_fecha, 
									  nombre_torneo, DATEDIFF(fecha_partido,CURDATE()) as dif,
									  equipo_local.nombre_equipo as nombre_equipo_local,
									  equipo_visitante.nombre_equipo as nombre_equipo_visitante,
									  equipo_ausente.nombre_equipo as nombre_equipo_ausente, partidos.id_equipo_ausente as id_equipo_ausente,
									  equipo_local.id_equipo as id_equipo_local, equipo_visitante.id_equipo as id_equipo_visitante
									  FROM partidos 
									  left join equipos as equipo_local on equipo_local.id_equipo=partidos.equipos_id_equipo
									  left join clubes as club_local on club_local.id_club=equipo_local.clubes_id_club
									  left join equipos as equipo_visitante on equipo_visitante.id_equipo=partidos.equipos_id_equipo1
									  left join clubes as club_visitante on club_visitante.id_club=equipo_visitante.clubes_id_club
									  left join categorias on categorias.id_categoria=equipo_visitante.categorias_id_categoria
									  left join fechas on fechas.id_fecha=partidos.fechas_id_fecha
									  left join torneos on fechas.torneos_id_torneo1=torneos.id_torneo
									  left join lugares on partidos.lugares_id_lugar=lugares.id_lugar
									  left join clubes as club_juega on club_juega.id_club=lugares.clubes_id_club 
									  left join equipos as equipo_ausente on equipo_ausente.id_equipo=partidos.id_equipo_ausente
									  ".$where." 
									  order by fecha_partido" ;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_partido']."'>";
									echo "<td>".ucfirst($row['nombre_fecha'])."</td>";
									echo "<td>".$row['zona']."</td>";
									echo "<td class='center'>".date("d-m-Y", strtotime($row['fecha_partido']))."</td>";
									echo "<td>".$row['hora_partido']."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo "<td>".ucfirst($row['nombre_equipo_local']);
									
									if ($row['id_equipo_ausente']==0 and ($row['dif']==0 or ($row['dif']<0 and $row['dif']>-7)) ){
										echo '<br/><a style="margin-bottom: 4px;" class="btn btn-warning" href="'.$row['id_equipo_local'].'" title="Equipo local ausente">
												Ausente
											</a>';
									}
									else{
										if ($row['id_equipo_ausente']==$row['id_equipo_local']){
											echo '<br/><label class="label label-info">Ausente</label>';
										}
									}
									
									echo "</td>";
									echo "<td>".ucfirst($row['nombre_equipo_visitante']);
									
									if ($row['id_equipo_ausente']==0 and ($row['dif']==0 or ($row['dif']<0 and $row['dif']>-7)) ){
										echo '<br/><a style="margin-bottom: 4px;" class="btn btn-warning" href="'.$row['id_equipo_visitante'].'" title="Equipo local ausente">
												Ausente
											</a>';
									}
									else{
										if ($row['id_equipo_ausente']==$row['id_equipo_visitante']){
											echo '<br/><label class="label label-info">Ausente</label>';
										}
									}
									
									echo "</td>";
									$estado = "Juega Hoy";
									if ($row['dif']>0){
									    echo '<td class="center">';
										    echo '<span class="label label-info">No Jugado</span>';
									    echo '</td>';
									}
									else if($row['dif']<0){
									    echo '<td class="center">';
										  echo '<span class="label label-important">Finalizado</span>';
									    echo '</td>';
									}
									else{
									     echo '<td class="center">';
										    echo '<span class="label label-success">Juega Hoy</span>';
									      echo '</td>';
									}
									if ($row['tipo_lugar']==1){
									  $tipo="Sede ";
									}
									else if ($row['tipo_lugar']==2){
									  $tipo="Estadio ";
									}
									else if ($row['tipo_lugar']==3){
									  $tipo="Predio ";
									}
									else{
									  $tipo=" Sin definir";
									}
									
									echo "<td>".$tipo.$row['nombre_juega']."</td>";
									echo "<td>".ucfirst($row['nombre_torneo'])."</td>";
									
									echo 
										'<td class="center">
											<a style="margin-bottom: 4px;" class="btn btn-info" href="editar-partido.php?datos=1&jugadores=0&goles=0&amonestaciones=0&posiciones=0&id='.$row['id_partido'].'" title="Datos de este partido">
												<i class="halflings-icon white pencil"></i>  
											</a>
											<a style="margin-bottom: 4px;"  class="btn btn-info" href="editar-partido.php?datos=0&jugadores=1&goles=0&amonestaciones=0&posiciones=0&id='.$row['id_partido'].'" title="Jugadores de este partido">
												<i class="halflings-icon white user"></i>  
											</a>
											<a style="margin-bottom: 4px;"  class="btn btn-info" href="editar-partido.php?datos=0&jugadores=0&goles=1&amonestaciones=0&posiciones=0&id='.$row['id_partido'].'" title="Goles de este partido">
												<i class="halflings-icon white globe"></i>  
											</a><br/>
											<a class="btn btn-info" href="editar-partido.php?datos=0&jugadores=0&goles=0&amonestaciones=1&posiciones=0&id='.$row['id_partido'].'" title="Amonestaciones de este partido">
												<i class="halflings-icon white stop"></i>  
											</a>
											<a class="btn btn-info" href="editar-partido.php?datos=0&jugadores=0&goles=0&amonestaciones=0&posiciones=1&id='.$row['id_partido'].'" title="Posiciones en la cancha de este partido">
												<i class="halflings-icon white pushpin"></i>  
											</a>
											<a class="btn btn-danger" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
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
		$( '#tabla-partidos' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			var eliminar=false;
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-partidos').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-partido.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&test=1',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.candelete==true){
							eliminar=true;
						}
						else{
							if (confirm(res.razon + ". Eliminar de cualquier manera?")){
								eliminar=true;
							}
						}
						
						if (eliminar==true){
						
							$.ajax({
								type: 'get',
								url: 'delete-partido.php',
								data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&test=0',
								success: function(data) {
									var res = $.parseJSON(data);
									if (res.deleted==true){
										table.row('.selected').remove().draw( false );
									}
									else{
										alert(res.razon);
									}
									
									
								}
							});
							
						}
					}
				});
			}
		});
		$( '#tabla-partidos' ).on( 'click', 'a.btn-warning', function(e) {
		      e.preventDefault();
		      var parent = $(this).closest('td');
		      var this_btn = $(this);
		      var tr = $(this).closest('tr');
		      var id_partido = tr.attr('id').replace('record-','');
		      var id_equipo = $(this).attr('href');
		      $.ajax({
				type: 'get',
				url: 'includes/make-ausente.php',
				data: 'ajax=1&partido=' + id_partido + '&equipo=' + id_equipo,
				success: function(data) {
					var res = $.parseJSON(data);
					if (res.error==false){
						parent.append('<label class="label label-important">Ausente</label>');
						parent.next('td').find('a').hide();
						this_btn.hide();
					}
					else{
						alert(res.razon);
					}
					
					
				}
			});
		      
		});
	});
	</script>
	
</body>
</html>