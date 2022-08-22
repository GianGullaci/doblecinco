<?php
	if (isset($_POST['guardar'])){

		include_once("includes/coneccion.php");
		
		$dt = DateTime::createFromFormat('d/m/Y', date("d/m/Y"));
		$fecha = $dt->format('Y-m-d');
		
		
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['pregunta']);
		
		$consulta = 'INSERT INTO encuestas (pregunta, fecha_encuesta) 
		VALUES 
		("'.base64_encode($txt).'", "'.$fecha.'")';
		 //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		
		$param_name = 'respuesta';
		foreach($_POST as $key => $value) {
			if(substr($key, 0, strlen($param_name)) == $param_name) {
				$consulta = 'INSERT INTO opciones_encuesta (texto_opcion, encuestas_id_encuesta) 
				VALUES 
				("'.$value.'", '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}

		
		header("Location: listado-encuestas.php");
		
	}
	include("head.php");
	

?>

	

<body>

		<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
		<script src="../editor/sample.js" type="text/javascript"></script>
		<link href="../editor/sample.css" rel="stylesheet" type="text/css" />
		
		
		<script type="text/javascript">
	   
			function crearFila() { //donde num = al i que le corresponde
				document.forms['form_nueva_enc'].resp_count.value = parseInt(document.forms['form_nueva_enc'].resp_count.value) + 1;
				var num = document.forms['form_nueva_enc'].resp_count.value;
				var fieldset_encuestas = document.getElementById('fieldset_encuestas');

				
					  
				var div = document.createElement('div');
				div.setAttribute('class', 'control-group');
				fieldset_encuestas.appendChild(div);
				var label = document.createElement('label');
				label.setAttribute('class', 'control-label');
				label.innerHTML="Opcion #"+num;
				div.appendChild(label);
				var div_ctrl = document.createElement('div');
				div_ctrl.setAttribute('class', 'controls');
				div.appendChild(div_ctrl);
										
				//campo nueva
				var unic = 'respuesta'+num;
				var respuestaInput = document.createElement('input');
				respuestaInput.type = 'text';
				respuestaInput.setAttribute("name", unic);
				respuestaInput.setAttribute("id", unic);
				respuestaInput.setAttribute('class', 'input-xlarge focused');
				div_ctrl.appendChild(respuestaInput);
				
				
				  
			}
		</script>
		
		
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
					<a href="#">Encuestas</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Encuesta</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="?" name="form_nueva_enc" id="form_nueva_enc">
						  <fieldset>
							
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Elaborar Pregunta</label>
							  <div class="controls">
								<textarea cols="80" id="pregunta" name="pregunta" rows="10"></textarea>
								<script type="text/javascript">
								//<![CDATA[

									CKEDITOR.replace( 'pregunta',
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
							
							<div id="fieldset_encuestas">
							<div class="control-group" id="pregunta1">
								<label class="control-label" for="focusedInput">Opci&oacute;n #1</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="respuesta1" name="respuesta1" type="text" value="">
								</div>
								
							  </div>
							  <div class="control-group" id="pregunta2">
								<label class="control-label" for="focusedInput">Opci&oacute;n #2</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="respuesta2" name="respuesta2" type="text" value="">
								</div>
							  </div>
							  <!--<p>
								<div id="fieldset_encuestas">								<p>
								<label>Fechas:</label><input type="text" name="fecha_esp1" id="fecha_esp1" class="text-medium" /> <a href="javascript:crearFila();">Otra Fecha</a><br>								</p>
								</div>
							</p>-->
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFila();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_count" id="resp_count" value="2" />
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
