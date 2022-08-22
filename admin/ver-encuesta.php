<?php 		include("head.php"); 

	(isset($_GET['id'])) ? : die('id sin setear');
	$id_encuesta = $_GET['id'];
	
	$query = "SELECT * FROM encuestas 
	where id_encuesta=".$id_encuesta;
	$result = $mysqli->query($query); 
	if($row = mysqli_fetch_array($result)) {
		$pregunta = $row['pregunta'];
	}
	else{
		die('id no encontrado');
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
					<a href="listado-encuestas.php">Encuestas</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Encuesta</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="?" name="form_nueva_enc" id="form_nueva_enc">
						  <fieldset>
							
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Pregunta</label>
							  <div class="controls">
								<!--<textarea cols="80" disabled id="pregunta" name="pregunta" rows="10"><?//=base64_decode($pregunta)?></textarea>-->
								<?=base64_decode($pregunta)?>
							  </div>
							</div>
							
							<div id="fieldset_encuestas">
							
							  <?php
								$query = "SELECT * FROM opciones_encuesta 
								WHERE encuestas_id_encuesta=".$id_encuesta;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
									echo '<div class="control-group">
										<label class="control-label" for="focusedInput">Opci&oacute;n #'.$i.'</label>
										<div class="controls">
										  <label class="control-label" style="text-align: left;" for="focusedInput">'.$row['texto_opcion'].'</label>
										</div>
										
									  </div>';
									  $i++;
								}
							?>
							
							  
							 <!-- <div class="control-group" id="pregunta1">
								<label class="control-label" for="focusedInput">Opci&oacute;n #1</label>
								<div class="controls">
								  <input class="input-xlarge focused"  type="text" value="">
								</div>
								
							  </div>-->
							  
						
							
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
