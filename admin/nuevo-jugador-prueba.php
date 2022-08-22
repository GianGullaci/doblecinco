<?php 		include("head.php"); 

  if (isset($_POST['editor1'])){
    /* Preparar una sentencia INSERT */
    $dt = DateTime::createFromFormat('d/m/Y', $_POST['fecha_nacimiento']);
    $txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['editor1']);
    $fecha_nacimiento = $dt->format('Y-m-d');
    $consulta = "INSERT INTO jugadores (nombre_jugador, fecha_nacimiento, altura, peso, descripcion) VALUES ('".$_POST['nombre']."','".$fecha_nacimiento."','".$_POST['altura']."','".$_POST['peso']."','".base64_encode($txt)."')";
    $sentencia = $mysqli->prepare($consulta);
//     echo $consulta;
//     exit;

    /* Ejecutar la sentencia */
    $sentencia->execute();

    /* cerrar la sentencia */
    $sentencia->close();
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
					<a href="listado-jugadores.php">Jugadores</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Jugador</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="?">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" value="" name="nombre">
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="date01">Fecha de Nacimiento</label>
							  <div class="controls">
								<?php
									$hoy=date("d/m/Y");
								?>
								<input type="text" name="fecha_nacimiento" class="input-xlarge datepicker" id="date01" value="<?=$hoy?>">
							  </div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="selectError">Puesto</label>
								<div class="controls">
								  <select id="selectError2" data-rel="chosen">
									<option>Delantero</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Pierna Hábil</label>
								<div class="controls">
								  <select id="selectError4" data-rel="chosen">
									<option>Derecha</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="selectError">Club</label>
								<div class="controls">
								  <select id="selectError3" data-rel="chosen">
									<option>Club YY</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  

							<div class="control-group">
							  <label class="control-label" for="fileInput">Foto</label>
							  <div class="controls">
								<img class="grayscale" src="http://invixion.com/jl/admin/img/gallery/photo2.jpg" alt="Sample Image 2" width="150" style="margin-left: 20px">
								<p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<input class="input-file uniform_on" id="fileInput" type="file">
							  </div>
							</div>   
							<div class="control-group">
								<label class="control-label" for="focusedInput">Peso</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" value="" name="peso">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Altura</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" value="" name="altura">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Estado</label>
								<div class="controls">
								  <select id="selectError" data-rel="chosen">
									<option>Activo</option>
									<option>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Descripci&oacute;n</label>
							  <div class="controls">
								<textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
								<script type="text/javascript">
								//<![CDATA[

									CKEDITOR.replace( 'editor1',
							{
							
							    toolbar: [
							    [ 'Source', '-', 'Print', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
							    [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ],
							    [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ],
							    [ 'Link', 'Unlink' ],
							    [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ],
							    [ 'Styles', 'Format', 'Font', 'FontSize' ],
							    [ 'TextColor', 'BGColor' ]
						],
						filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                        filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',});

								//]]>
								</script>
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
	<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
	<script src="../editor/sample.js" type="text/javascript"></script>
	<link href="../editor/sample.css" rel="stylesheet" type="text/css" />
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
	
	
</body>
</html>
