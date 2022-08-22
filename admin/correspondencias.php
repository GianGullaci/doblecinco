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
				<li><a href="#">Correspondencias entre A&ntilde;os y Caegor&iacute;as</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<a class="btn btn-primary" type="button" href="#nuevo">Agregar Otra</a>
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>A&ntilde;os y Categor&iacute;as</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-correspondencia">
						  <thead>
							  <tr>
								  <th>Categor&iacute;a</th>
								  <th>Padre</th>
								  <th>A&ntilde;o</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>

						  
							<?php
								$anio_actual=date("Y");
								$query = "SELECT cat.id_categoria AS id_hijo, cat.categorias_id_categoria AS id_padre, cat.nombre_categoria AS nombre_hijo, 
								cat2.nombre_categoria AS nombre_padre, cat.anios_involucrados AS anio, cat.diferencia AS dif 
								FROM  categorias AS cat 
								LEFT JOIN categorias AS cat2 ON cat.categorias_id_categoria = cat2.id_categoria" or die("Error in the consult.." . mysqli_error($mysqli));
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_hijo']."'>";
									echo "<td>".ucfirst($row['nombre_hijo'])."</td>";
									echo "<td>".ucfirst($row['nombre_padre'])."</td>";
									
									$anios = $anio_actual - $row['dif'];
									if ($row['anio']==2){
										$anios2 = $anios + 1;
										$texto = $anios." - ".$anios2;
									}
									else if ($row['anio']==0){
										$texto = "desde ".$anios;
									}
									else{
										$texto = $anios;
									}
									echo "<td>".$texto."</td>";
									echo "<td class='center'>";
									echo "<a class='btn btn-danger' href='?delete=".$row['id_hijo']."'>";
									echo "<i class='halflings-icon white trash'></i>";
									echo "</a>";
									echo "</td>";
									echo "</tr>";
								}
							
						    
						     $cuarta1 = $anio_actual-19;
						     $cuarta2 = $anio_actual-18;
						    // $quinta = $anio_actual-17;
						    // $sexta = $anio_actual-16;
						    // $septima = $anio_actual-15;
						    
						    // $octava = $anio_actual-14;
						    // $novena = $anio_actual-13;
						    // $decima = $anio_actual-12;
						    // $predecima = $anio_actual-11;
						    
						  ?>
							<!--<tr>
								<td>1</td>
								<td>Juveniles</td>
								<td>-</td>
								<td><?php //echo "desde ".$cuarta1; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Cuarta</td>
								<td>Juveniles</td>
								<td><?php //echo $cuarta1." - ".$cuarta2; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Quinta</td>
								<td>Juveniles</td>
								<td><?php //echo $quinta; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Sexta</td>
								<td>Juveniles</td>
								<td><?php //echo $sexta; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>S&eacute;ptima</td>
								<td>Juveniles</td>
								<td><?php //echo $septima; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>Menores</td>
								<td>-</td>
								<td><?php //echo "desde ".$octava; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td>Octava</td>
								<td>Menores</td>
								<td><?php //echo $octava; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>8</td>
								<td>Novena</td>
								<td>Menores</td>
								<td><?php //echo $novena; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>9</td>
								<td>D&eacute;cima</td>
								<td>Menores</td>
								<td><?php //echo $decima; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<tr>
								<td>10</td>
								<td>Pred&eacute;cima</td>
								<td>Menores</td>
								<td><?php //echo "desde ".$predecima; ?></td>
								<td class="center">
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>-->
							
							
						  </tbody>
					  </table>            
					</div>
					
					<div class="box-header" data-original-title id="nuevo">
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Nueva Categor&iacute;a/Correspondencia</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="form-corr">
						  <fieldset>
							
							  <div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
								  <input class="input-medium focused" required id="nombre" type="text" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="padre">Padre</label>
								<div class="controls">
								  <select id="padre" data-rel="chosen">
									<option value="0">-</option>
									<option value="2">Menores</option>
									<option value="1">Juveniles</option>									
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="aniosi">A&ntilde;os Involucrados</label>
								<div class="controls">
								  <input class="input-medium focused" required id="aniosi" type="number" min="0" step="1" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="diferencia">Diferencia</label>
								<div class="controls">
								  <input class="input-medium focused" id="diferencia" type="number" min="0" step="1" value="" required>
								</div>
							  </div>
							  <input type="hidden" value="<?=$anio_actual?>" id="anio_actual">
							<div class="form-actions">
							   <input type="submit" class="btn btn-primary guardar-corr" id="guardar-corr" value="Guardar" />
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
		$( '#tabla-correspondencia' ).on( 'click', 'a', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-correspondencia').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-correspondencia.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
					success: function() {
						table.row('.selected').remove().draw( false );
					}
				});
			}
		});
		
		$('input.guardar-corr').click(function(e) {
		    var f = document.getElementById('form-corr');
		    f.checkValidity();
		    if (f.checkValidity()){
			e.preventDefault();
			var texto = $('#nombre').val();
			var padre = $('#padre :selected').val();
			var padret = $('#padre  :selected').text();
			var aniosi = $('#aniosi').val();
			var diferencia = $('#diferencia').val();
			var anio_actual = $('#anio_actual').val();
			var t = $('#tabla-correspondencia').DataTable();
			$.ajax({
				type: 'get',
				url: 'add-correspondencia.php',
				data: 'ajax=1&add=' + texto + '&padre=' + padre + '&anios=' +aniosi + '&dif=' + diferencia,
				success: function(data) {
					var res = $.parseJSON(data);					
					anios = anio_actual - diferencia;
					if (aniosi==2){
						anios2 = anios + 1;
						valor = anios+" - "+anios2;
					}
					else if (aniosi==0){
						valor = "desde "+anios;
					}
					else{
						valor = anios;
					}
					t.row.add( [
						texto,
						padret,
						valor,
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
