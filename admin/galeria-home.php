<?php 		include("head.php"); ?>

<?php

	include_once("includes/coneccion.php");
	
	if (isset($_POST['galeria'])){

		
		$consulta = "UPDATE configuracion_home SET
		galerias_id_galeria=".$_POST['galeria'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
	}
	
	
	$query = "SELECT *
		  FROM configuracion_home";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$galeria = $row['galerias_id_galeria'];	   
	}
	else{
	  die("error");
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
					<a href="">Galeria Home</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Galeria Home</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							
							<div class="control-group">
								<label class="control-label" for="selectError">Asociar Galeria</label>
								<div class="controls">
								  <select id="galeria" name="galeria" data-rel="chosen">
									<option value="0">Sin galeria</option>
									<?php
									    select_galerias($mysqli,$galeria);
									?>
								  </select>
								  <p style="color: #8e8e8e;font-size: 12px;">Seleccionando un directorio se crear&aacute; una galer&iacute;a con las im&aacute;genes que contenga</p>
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
