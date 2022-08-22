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
				<li><a href="#">Comentarios</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Comentarios</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable" id="tabla-comentarios">
						  <thead>
								<tr>
									<th>Activo</th>
									<th>Fecha</th>
									<th>Nota (T&iacute;tulo)</th>
									<th>Usuario</th>
									<th>Comentario</th>
									<th>Acciones</th>
								</tr>
						  </thead>   
						  <tbody>
							
							<?php
								$query = "SELECT id_comentario, comentarios.activo as activo,
								fecha_comentario, titulo_nota, nombre, email, texto_comentario
								FROM comentarios 
								left join notas on notas.id_nota=comentarios.notas_id_nota
								left join usuarios on usuarios.id_usuario=comentarios.usuarios_id_usuario" ;
								
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_comentario']."'>";

									if ($row['activo']==0){
										echo '<td class="activar"><span style="display:none;">NO</span><a class="btn btn-danger"><i class="halflings-icon white remove"></i></a></td>';
									}
									else{
										echo '<td class="desactivar"><span style="display:none;">SI</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a></td>';
									}
									$fecha = date("d-m-Y", strtotime($row['fecha_comentario']));
									echo "<td>".$fecha."</td>";
									echo '<td>'.$row['titulo_nota'].'</td>';
									echo '<td class="center">'.$row['nombre'].' ('.$row['email'].')</td>';
									echo '<td class="center" style="width: 30%;">'.$row['texto_comentario'].'</td>';
									
// 									<a class="btn btn-success popvercomm" href="ver-comentario.php?id='.$row['id_comentario'].'">
// 												<i class="halflings-icon white zoom-in"></i>  
// 											</a>
									echo '<td class="center">
											
											<a class="btn btn-warning ban" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
											<a class="btn btn-danger delete" href="#">
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
	
		$('#tabla-comentarios').dataTable({
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
 		      { "orderable": false},
			  { "orderable": false},
			  { "orderable": false},
			  { "orderable": false},
			  { "orderable": false}
 		    ]
		} );
 		
		$( '#tabla-comentarios' ).on( 'click', 'a.delete', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?\nSe eliminara permanentemente de la base de datos")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-comentarios').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-comentario.php',
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
		
		$( '#tabla-comentarios' ).on( 'click', 'a.ban', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea reemplazar el registro?\nEl comentario será modificado por el texto predefinido")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-comentarios').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'ban-comentario.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.baned==true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser baneado "+res.razon);
						}
					}
				});
			}
		});
		
		
		$('#tabla-comentarios tbody').on( 'click', 'td.activar', function (e) {
				e.preventDefault();
				
				
				var parent = $(this).closest('tr');
				var id_comentario = parent.attr('id').replace('record-','');
				var td = $(this).closest('td');
				var table = $('#tabla-comentarios').DataTable();
				var cell = table.cell( this );

				
 				$.ajax({
 					type: 'get',
 					url: 'includes/activar-comentario.php',
 					data: 'ajax=1&id_comentario=' + id_comentario,
 					success: function(data) {
 						var res = $.parseJSON(data);
 						if (res.modificado==true){
							cell.data('<span style="display:none;">SI</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a>').draw();
							td.removeClass("activar");
							td.addClass("desactivar");

 						}
 					}
 				});
			});
			
			$('#tabla-comentarios tbody').on( 'click', 'td.desactivar', function (e) {
				e.preventDefault();
				
				
				var parent = $(this).closest('tr');
				var id_comentario = parent.attr('id').replace('record-','');
				var td = $(this).closest('td');
				var table = $('#tabla-comentarios').DataTable();
				var cell = table.cell( this );

				
 				$.ajax({
 					type: 'get',
 					url: 'includes/desactivar-comentario.php',
 					data: 'ajax=1&id_comentario=' + id_comentario,
 					success: function(data) {
 						var res = $.parseJSON(data);
 						if (res.modificado==true){
							cell.data('<span style="display:none;">NO</span><a class="btn btn-danger"><i class="halflings-icon white remove"></i></a>').draw();
							td.removeClass("desactivar");
							td.addClass("activar");

 						}
 					}
 				});
			});
		
	});
	</script>
	
	
</body>
</html>
