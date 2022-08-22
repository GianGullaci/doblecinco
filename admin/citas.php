<?php 		include("head.php"); ?>

<?php

	include_once("includes/coneccion.php");
	
	if (isset($_POST['guardar'])){
	      
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['contenido_cita_fixture']);
		$txt2 = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['contenido_cita_fixture2']);
// 		$txt2 = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['contenido_cita_posiciones']);
		
		$consulta = "UPDATE configuracion_home SET
		texto_cita_fixture='".$_POST['texto_cita_fixture']."',
		contenido_cita_fixture='".base64_encode($txt)."',
		texto_cita_fixture2='".$_POST['texto_cita_fixture2']."',
		contenido_cita_fixture2='".base64_encode($txt2)."'";
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
	}
	
	
	$query = "SELECT *
		  FROM configuracion_home";
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$texto_cita_fixture = $row['texto_cita_fixture'];
		$contenido_cita_fixture = $row['contenido_cita_fixture'];
// 		$texto_cita_posiciones = $row['texto_cita_posiciones'];
// 		$contenido_cita_posiciones = $row['contenido_cita_posiciones'];
		$texto_cita_fixture2 = $row['texto_cita_fixture2'];
		$contenido_cita_fixture2 = $row['contenido_cita_fixture2'];
	}
	else{
	  die("error");
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
					<a href="">Citas</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Citas</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							
							<div class="control-group">
								<label class="control-label" for="texto_cita_fixture">Texto Link en Fixture</label>
								<div class="controls">
								  <input  class="input-xlarge focused"  name="texto_cita_fixture" id="texto_cita_fixture" value="<?=$texto_cita_fixture?>" />
								</div>
							  </div>
							  
							 <div class="control-group hidden-phone">
							  <label class="control-label" for="contenido_cita_fixture">Conenido Link en Fixture</label>
							  <div class="controls">
								<textarea cols="80" id="contenido_cita_fixture" name="contenido_cita_fixture" rows="10"><?=base64_decode($contenido_cita_fixture)?></textarea>
								<script type="text/javascript">
								//<![CDATA[

									CKEDITOR.replace( 'contenido_cita_fixture',
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
							
							  <!--<div class="control-group">
								<label class="control-label" for="texto_cita_posiciones">Texto Link en Posiciones</label>
								<div class="controls">
								  <input  class="input-xlarge focused"  name="texto_cita_posiciones" id="texto_cita_posiciones" value="<?=$texto_cita_posiciones?>" />
								</div>
							  </div>
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="contenido_cita_posiciones">Contenido Link en Posiciones</label>
							  <div class="controls">
								<textarea cols="80" id="contenido_cita_posiciones" name="contenido_cita_posiciones" rows="10"><?=base64_decode($contenido_cita_posiciones)?></textarea>
								<script type="text/javascript">
								//<![CDATA[

									CKEDITOR.replace( 'contenido_cita_posiciones',
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
							    filebrowserBrowseUrl :'../editor/js/ckeditor/filemanager/browser/default/browser.html?Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
							    filebrowserImageBrowseUrl : '../editor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
							    filebrowserFlashBrowseUrl :'../editor/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
										filebrowserUploadUrl  :'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
										filebrowserImageUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
										filebrowserFlashUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
										
									});

								//]]>
								</script>
							  </div>
							</div>-->
							<h3>Segundo renglon</h3>
							<div class="control-group">
								<label class="control-label" for="texto_cita_fixture2">Texto Link en Fixture</label>
								<div class="controls">
								  <input  class="input-xlarge focused"  name="texto_cita_fixture2" id="texto_cita_fixture2" value="<?=$texto_cita_fixture2?>" />
								</div>
							  </div>
							  
							 <div class="control-group hidden-phone">
							  <label class="control-label" for="contenido_cita_fixture2">Conenido Link en Fixture</label>
							  <div class="controls">
								<textarea cols="80" id="contenido_cita_fixture2" name="contenido_cita_fixture2" rows="10"><?=base64_decode($contenido_cita_fixture2)?></textarea>
								<script type="text/javascript">
								//<![CDATA[

									CKEDITOR.replace( 'contenido_cita_fixture2',
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
							    filebrowserBrowseUrl :'../editor/js/ckeditor/filemanager/browser/default/browser.html?Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
							    filebrowserImageBrowseUrl : '../editor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
							    filebrowserFlashBrowseUrl :'../editor/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
										filebrowserUploadUrl  :'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
										filebrowserImageUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
										filebrowserFlashUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
										
									});

								//]]>
								</script>
							  </div>
							</div>
							  
							 
							
							<div class="form-actions">
							  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
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
