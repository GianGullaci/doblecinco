<?php
		include("head.php");
?>

<?php
	if (isset($_POST['nombre_a_mostrar'])){

		include_once("includes/coneccion.php");
		
		

		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		$consulta = 'INSERT INTO campeones_infantiles2 (clubes_id_club, categorias_id_categoria, torneos_id_torneo, nombre_a_mostrar, zona, texto) 
		VALUES 
		('.$_POST['club'].','.$_POST['categoria'].','.$_POST['torneo'].',"'.$_POST['nombre_a_mostrar'].'","'.$_POST['zona'].'","'.base64_encode($txt).'")';
		 //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		
	}
?>

<body>

		<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
		<script src="../editor/sample.js" type="text/javascript"></script>
		<link href="../editor/sample.css" rel="stylesheet" type="text/css" />
		
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
					<a href="listado-campeones-infantiles2.php">Campeones Menores</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Campeones</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="club">Club</label>
								<div class="controls">
								  <select id="club" name="club" data-rel="chosen">
									<?php
										select_clubes($mysqli);
									?>
								  </select>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="categoria">Categor&iacute;a Deportiva</label>
								<div class="controls">
								  <select id="categoria" name="categoria" data-rel="chosen">
									<?php
									    select_categorias_de_padre($mysqli,2);
									?>
								  </select>
								</div>
							  </div>  
							  <div class="control-group">
								<label class="control-label" for="categoria">Torneo</label>
								<div class="controls">
								  <select id="torneo" name="torneo" data-rel="chosen">
									<?php
									    select_torneos($mysqli);
									?>
								  </select>
								</div>
							  </div>  
							
							<div class="control-group">
								<label class="control-label" for="nombre_a_mostrar">Nombre a mostrar</label>
								<div class="controls">
									<input class="input-xlarge focused" required id="nombre_a_mostrar" name="nombre_a_mostrar" type="text" value="">
								</div>
							  </div>
							

							 <div class="control-group">
								<label class="control-label">Zona</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="zona" id="optionsRadios1" value="A" checked >
									Zona A
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="zona" id="optionsRadios2" value="B"  >
									Zona B
								  </label>
								</div>
							  </div>
							

							
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Descripci&oacute;n</label>
							  <div class="controls">
								<textarea cols="80" id="descripcion" name="descripcion" rows="10"></textarea>
								<script type="text/javascript">
								//<![CDATA[

									CKEDITOR.replace( 'descripcion',
							{
								
							
							    toolbar: [
							    [ 'Source', '-', 'Print', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
							    [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ],
							    [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ],
							    [ 'Link', 'Unlink' ],
							    [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ],
							    [ 'Styles', 'Format', 'Font', 'FontSize' ],
							    [ 'TextColor', 'BGColor' ],
								['Youtube'],['Mp3Player']
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
	
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
	
	
</body>
</html>
