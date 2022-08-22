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
				<li><a href="#">Administradores</a></li>
			</ul>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<a class="btn btn-primary" type="button" href="nuevo-administrador.php">Nuevo Administrador</a>
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Administradores</h2>
						
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable" id="tabla-administradores">
						  <thead>
							  <tr>
								  <th>Nombre</th>
								  <th>E-mail</th>
								  <!--<th>Estado</th>-->
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php
								$query = "SELECT * FROM administradores where activo=1 order by nombre" ;
								$result = $mysqli->query($query); 
								while($row = mysqli_fetch_array($result)) {
									echo "<tr id='record-".$row['id_administrador']."'>";
									echo "<td>".$row['nombre']."</td>";
									echo "<td>".$row['nombre_usuario']."</td>";
									
									echo '<td class="center">
									<a class="btn btn-success" href="editar-clavea.php?id='.$row['id_administrador'].'">
									<i class="halflings-icon white barcode"></i>  
									</a>';
// 									echo "<a class='btn btn-info' href='editar-administrador.php?id=".$row['id_administrador']."'>";
// 									echo "<i class='halflings-icon white edit'></i> ";
// 									echo "</a>";
									if ($row['id_administrador']!=$_SESSION['id_admin']){
									  echo "<a class='btn btn-danger' href='?delete=".$row['id_administrador']."'>
									  <i class='halflings-icon white trash'></i>
									  </a>";
									}
									echo "</td>
									</tr>";
								}
							?>
							
						  </tbody>
					  </table>            
					</div>
					<a class="btn btn-primary" type="button" href="nuevo-administrador.php">Nuevo Administrador</a>
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
		$( '#tabla-administradores' ).on( 'click', 'a.btn-danger', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-administradores').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'delete-administrador.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
					success: function() {
						table.row('.selected').remove().draw( false );
					}
				});
			}
		});
	});
	</script>
	
</body>
</html>
