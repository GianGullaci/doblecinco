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
				<li><a href="#">Notas</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Notas</h2>
						<div class="box-icon">
							<!--<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>-->
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-notas">
						  <thead>
							  <tr>
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
								left join autores on autores.id_autor=notas.autores_id_autor" ;
								
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_nota']."'>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".ucfirst($row['titulo_nota'])."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo "<td>".ucfirst($row['nombre_autor'])."</td>";
									echo '<td class="center">
											<a class="btn btn-success" href="ver-comentario.php?id='.$row['id_nota'].'">
												<i class="halflings-icon white zoom-in"></i>  
											</a>
											<a class="btn btn-info" href="editar-nota.php?id='.$row['id_nota'].'">
												<i class="halflings-icon white edit"></i> 
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
	<div class="modal hide fade" id="myModal">
		<form>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
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
// 		$('a.btn-danger').click(function(e) {
		$( '#tabla-notas' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
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
	});
	</script>
	
</body>
</html>
