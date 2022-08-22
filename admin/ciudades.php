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
				<li><a href="#">Ciudades </a></li>
			</ul>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<a class="btn btn-primary" type="button" href="#nuevo">Agregar Otra</a>
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Ciudades</h2>
						
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-ciudades">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
							<?php
								$query = "SELECT * FROM ciudades order by nombre" or die("Error in the consult.." . mysqli_error($mysqli));
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_ciudad']."'>";
									echo "<td>".ucfirst($row['nombre'])."</td>";
									echo "<td class='center'>";
									echo "<a class='btn btn-danger' href='?delete=".$row['id_ciudad']."'>";
									echo "<i class='halflings-icon white trash'></i>";
									echo "</a>";
									echo "</td>";
									echo "</tr>";
								}
							?>
							
						  </tbody>
					  </table>            
					</div>
					
					<div class="box-header" data-original-title id="nuevo">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Nueva Ciudad</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="form-ciudades">
						  <fieldset>
							
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="nombre" type="text" value="">
								</div>
							  </div>

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary nueva-ciudad">Guardar</button>
							  <button type="reset" class="btn">Cancelar</button>
							</div>
						  </fieldset>
						</form>   

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
		$( '#tabla-ciudades' ).on( 'click', 'a', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-ciudades').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-ciudad.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted==true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado (posee jugadores asociados)");
						}
					}
				});
			}
		});
		
		$('button.nueva-ciudad').click(function(e) {
		    var f = document.getElementById('form-ciudades');
		    f.checkValidity();
		    if (f.checkValidity()){
			e.preventDefault();
			var texto = $('#nombre').val();
			var t = $('#tabla-ciudades').DataTable();
			$.ajax({
				type: 'get',
				url: 'add-ciudad.php',
				data: 'ajax=1&add=' + texto,
				success: function(data) {
					var res = $.parseJSON(data);					
					t.row.add( [
						texto,
						'<a class="btn btn-danger" id="new" href="?delete='+res.id+'"><i class="halflings-icon white trash"></i></a>'
					] ).draw();
					//obtengo el link con el id new
					var link = $('#new');
					//obtengo su tr
					var tr = link.closest('tr');
					//le asigno el id
					tr.attr('id', 'record-'+res.id);
					//le quito el id al link
					link.attr('id', '');
				}
			});
		    }
		});
	});
</script>
	
</body>
</html>
