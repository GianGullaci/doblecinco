<?php 		include("head.php"); ?>

<?php

	include_once("includes/coneccion.php");
	
	if (isset($_POST['torneo1'])){

		
		$consulta = "UPDATE configuracion_home SET
		id_torneo_menores=".$_POST['torneo1'].",
		titulo_torneo='".$_POST['titulo']."',
		id_torneo_infantiles=".$_POST['torneo2'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
	}
	
	
	$query = "SELECT *
		  FROM configuracion_home";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$torneo1 = $row['id_torneo_menores'];
		$torneo2 = $row['id_torneo_infantiles'];
		$titulo = $row['titulo_torneo'];
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
					<a href="">Torneos del sitio</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Torneos del sitio</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							
							<div class="control-group">
								<label class="control-label" for="torneo1">Torneo Juveniles</label>
								<div class="controls">
								  <select id="torneo1" name="torneo1" data-rel="chosen">
									<?php
									    select_torneos($mysqli,$torneo1);
									?>
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="torneo2">Torneo Menores</label>
								<div class="controls">
								  <select id="torneo2" name="torneo2" data-rel="chosen">
									<?php
									    select_torneos($mysqli,$torneo2);
									?>
								  </select>
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="titulo">Titulo Torneo</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="150" id="titulo" name="titulo" required type="text" value="<?=$titulo?>">
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
