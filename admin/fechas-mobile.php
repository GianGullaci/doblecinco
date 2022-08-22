<?php 		include("head.php"); ?>

<?php

	include_once("includes/coneccion.php");
	
	if (isset($_POST['fecha_infantiles_mobile'])){

		
		$consulta = "UPDATE configuracion_home SET
		fecha_infantiles_mobile=".$_POST['fecha_infantiles_mobile'].",
		fecha_menores_mobile=".$_POST['fecha_menores_mobile'];
		  echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
	}
	
	
	$query = "SELECT *
		  FROM configuracion_home";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$torneo1 = $row['id_torneo_menores'];
		$torneo2 = $row['id_torneo_infantiles'];
		$fecha_infantiles_mobile = $row['fecha_infantiles_mobile'];
		$fecha_menores_mobile = $row['fecha_menores_mobile'];
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
					<a href="">Fechas Mobile</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Fechas a mostrar en Mobile</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							
							<div class="control-group">
								<label class="control-label" for="fecha_menores_mobile">Fecha Juveniles Mobile</label>
								<div class="controls">
								  <select id="fecha_menores_mobile" name="fecha_menores_mobile" data-rel="chosen">
									<?php
									    select_fechas_torneo($mysqli,$torneo1,$fecha_menores_mobile);
									?>
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="fecha_infantiles_mobile">Fecha Menores Mobile</label>
								<div class="controls">
								  <select id="fecha_infantiles_mobile" name="fecha_infantiles_mobile" data-rel="chosen">
									<?php
									    select_fechas_torneo($mysqli,$torneo2,$fecha_infantiles_mobile);
									?>
								  </select>
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
