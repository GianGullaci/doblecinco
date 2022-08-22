<?php
		include("head.php");
?>

<?php
	if (isset($_POST['nombre_neutral'])){

		include_once("includes/coneccion.php");
		

		$consulta = 'INSERT INTO lugares (nombre_neutral, direccion, neutral) 
		VALUES 
		("'.$_POST['nombre_neutral'].'","'.$_POST['direccion'].'", 1)';
		 //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		
		
		
	}
?>

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
				<li>
					<i class="icon-edit"></i>
					<a href="listado-lugares.php">Lugares Neutrales</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Lugares Neutrales</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="nombre_neutral">Nombre</label>
								<div class="controls">
									<input class="input-xlarge focused" required id="nombre_neutral" name="nombre_neutral" type="text" value="">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="direccion">Direcci&oacute;n</label>
								<div class="controls">
								  <input class="input-xlarge focused"  maxlength="100" required id="direccion" name="direccion" type="text" value="">
								</div>
							  </div>
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
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
	
	
	
</body>
</html>
