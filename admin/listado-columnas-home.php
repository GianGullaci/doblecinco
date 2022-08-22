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
					<i class="icon-columna_home"></i>
					<a href="index.php">inicio</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Notas</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Notas columna_home</h2>
						<div class="box-icon">
							<!--<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>-->
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas">
						  <thead>
							  <tr>
								  <th>columna_home</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Autor</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where categorias_notas.categorias_notas_id_categoria_notas=2 
								order by columna_home desc, orden_columna_home asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_nota']."'>";
									
									if ($row['columna_home']==1){
										//echo '<td class="remove-columna-home"><span style="display:none;">0'.$row['orden_columna_home'].'</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a></td>';
										echo '<td class="remove-columna-home"><span style="display:none;">'.$i.'</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a></td>';
										$i.="0";
									}
									else{
										echo '<td class="add-columna-home"><span style="display:none;">a</span><a class="btn btn-danger  "><i class="halflings-icon white remove"></i></a></td>';
									}
									
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo "<td>".ucfirst($row['nombre_autor'])."</td>";
									echo '<td class="center">
											<a class="btn btn-success" target="_blank" href="../sitio/nota.php?id='.$row['id_nota'].'">
												<i class="halflings-icon white zoom-in"></i>  
											</a>
											<a class="btn btn-info" href="editar-nota.php?id='.$row['id_nota'].'">
												<i class="halflings-icon white edit"></i> 
											</a>
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
							
						  </tbody>
					  </table>            
					</div>
					<div id="debugArea"></div>
				</div><!--/span-->
			
			</div><!--/row-->

			
			
			
			
			
    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
	<div class="clearfix"></div>
	<div class="modal hide fade" id="myModal">
		<form>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">�</button>
			<h3>Eliminar Comentario</h3>
		</div>
		<div class="modal-body">
			<p>Ingrese razon de eliminacion del comentario</p>
			<textarea rows=2></textarea>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
			<a href="#" class="btn btn-primary">Eliminar y Aclarar</a>
		</div>
		</form>
	</div>
	
	<div class="clearfix"></div>
	
	
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
	<script>
	
	
	
	$(document).ready(function() {
	
		$('#tabla-notas').dataTable({
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
 		
// 		$('a.btn-danger').click(function(e) {
		$( '#tabla-notas' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?\nSe eliminara permanentemente de la base de datos")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-nota.php',
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
		
		
		$("#tabla-notas tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-columna-home.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_columna_home=' + orden,
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado==true){
							    if (res.columna_home==0){
								  //tengo que convertirlo en una cruz
								  
 								  td.removeClass("remove-columna-home");
 								  td.addClass("add-columna-home");
 								  $("#record-"+id_nota+" td.add-columna-home a").removeClass("btn-success");
 								  $("#record-"+id_nota+" td.add-columna-home a").addClass("btn-danger");
 								  $("#record-"+id_nota+" td.add-columna-home a i").removeClass("ok");
 								  $("#record-"+id_nota+" td.add-columna-home a i").addClass("remove");
							    }
							    else if (res.columna_home==1){
								  //tengo que convertirlo en un tilde

 								  td.removeClass("add-columna-home");
 								  td.addClass("remove-columna-home");
								  $("#record-"+id_nota+" td.remove-columna-home a").removeClass("btn-danger");
 								  $("#record-"+id_nota+" td.remove-columna-home a").addClass("btn-success");
 								  $("#record-"+id_nota+" td.remove-columna-home a i").removeClass("remove");
 								  $("#record-"+id_nota+" td.remove-columna-home a i").addClass("ok");
								  
							    }
							}
							else{	
							  alert("Error");
							}
						}
				});
			  
			}
		});
		
		$('#tabla-notas tbody').on( 'click', 'td.remove-columna-home', function (e) {
				e.preventDefault();
				
				
				var parent = $(this).closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var td = $(this).closest('td');
				var table = $('#tabla-notas').DataTable();
				var cell = table.cell( this );

				
 				$.ajax({
 					type: 'get',
 					url: 'includes/remove-columna-home.php',
 					data: 'ajax=1&id_nota=' + id_nota,
 					success: function(data) {
 						var res = $.parseJSON(data);
 						if (res.modificado==true){
							cell.data('<span style="display:none;">10</span><a class="btn btn-danger  "><i class="halflings-icon white remove"></i></a>').draw();
							td.removeClass("remove-columna-home");
							td.addClass("add-columna-home");

 						}
 					}
 				});
			});
			
			$('#tabla-notas tbody').on( 'click', 'td.add-columna-home', function (e) {
				e.preventDefault();
				
				
				var parent = $(this).closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var td = $(this).closest('td');
				var table = $('#tabla-notas').DataTable();
				var cell = table.cell( this );

				
 				$.ajax({
 					type: 'get',
 					url: 'includes/add-columna-home.php',
 					data: 'ajax=1&id_nota=' + id_nota,
 					success: function(data) {
 						var res = $.parseJSON(data);
 						if (res.modificado==true){
							cell.data('<span style="display:none;">0'+res.orden_columna_home+'</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a>').draw();
							td.removeClass("add-columna-home");
							td.addClass("remove-columna-home");
							
 						}
 					}
 				});
			});
		
	});
	</script>
	
</body>
</html>
 