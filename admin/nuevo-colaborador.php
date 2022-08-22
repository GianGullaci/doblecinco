<?php
	if (isset($_POST['guardar'])){

		include_once("includes/coneccion.php");

		$psw=md5($_POST['password']);
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		
		$consulta = 'INSERT INTO colaboradores (nombre_colaborador, email, clave, descripcion) 
		VALUES 
		("'.$_POST['nombre'].'","'.$_POST['email'].'","'.$psw.'", "'.base64_encode($txt).'")';
// 		 echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		if (!$sentencia->execute()){
		  $msj="Email en uso";
		}
		else{
		  $id = mysqli_insert_id($mysqli);
		  header("Location: listado-colaboradores.php");
		}
		
	}
	include("head.php");
	

?>

<body>

	<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
	<script src="../editor/sample.js" type="text/javascript"></script>
	<link href="../editor/sample.css" rel="stylesheet" type="text/css" />
	<script language='javascript' type='text/javascript'>
		function check(input) {
			if (input.value != document.getElementById('password').value) {
				input.setCustomValidity('Las claves no coinciden');
			} 
			else {
				input.setCustomValidity('');
			}
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
					<a href="listado-colaboradores.php">Colaboradores</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Colaborador</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" >
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="nombre" name="nombre" type="text" value="<?=$_POST['nombre']?>">
								  
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="email">E-mail</label>
								<div class="controls">
								  <input class="input-xlarge focused" required maxlength="100" id="email" name="email" type="email" value="<?=$_POST['email']?>">
								  <?=$msj?>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="password">Clave</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="password" name="password" type="text" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="password2">Repetir Clave</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="password2" name="password2" type="text" value="" oninput="check(this)">
								</div>
							  </div>
							  
							
							  
							<div class="control-group hidden-phone">
							  <label class="control-label" for="descripcion">Descripci&oacute;n</label>
							  <div class="controls">
								<textarea cols="80" id="descripcion" name="descripcion" rows="10"><?=base64_decode($descripcion)?></textarea>
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
