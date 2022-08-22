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
				<li><a href="#">Pierna H&aacute;bil</a></li>
			</ul>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<a class="btn btn-primary" type="button" href="#nuevo">Agregar Otro</a>
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Pierna H&aacute;bil</h2>
						
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-piernas">
						  <thead>
							  <tr>
								  <th>Detalle</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
							<?php
								$query = "SELECT * FROM pierna_habil order by nombre_pierna" or die("Error in the consult.." . mysqli_error($mysqli));
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_pierna_habil']."'>";
									echo "<td>".ucfirst($row['nombre_pierna'])."</td>";
									echo "<td class='center'>";
									echo "<a class='btn btn-danger' href='?delete=".$row['id_pierna_habil']."'>";
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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Nuevo Dato</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="form-piernas">
						  <fieldset>
							
							  <div class="control-group">
								<label class="control-label" for="detalle">Detalle</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="detalle" required="required" type="text" value=""  />
								  <!--<input class="input-xlarge focused" id="detalle" required="required" type="text" value="" oninvalid="setCustomValidity('El detalle es requerido')" />-->
								</div>
							  </div>

							<div class="form-actions">
							  <!--<button type="submit" class="btn btn-primary nueva-pierna" id="nueva-pierna">Guardar</button>-->
							  <input type="submit" class="btn btn-primary nueva-pierna" id="nueva-pierna" value="Guardar" />
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
		$( '#tabla-piernas' ).on( 'click', 'a', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-piernas').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-pierna-habil.php',
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
		
		$('input.nueva-pierna').click(function(e) {
			var f = document.getElementById('form-piernas');
			f.checkValidity();
			if (f.checkValidity()){
				e.preventDefault();
				var texto = $('#detalle').val();
				var t = $('#tabla-piernas').DataTable();
				$.ajax({
					type: 'get',
					url: 'add-pierna-habil.php',
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
