<?php 		include("head.php"); ?>

<?php
	include_once("includes/coneccion.php");
	
	$partido_cubierto=0;
	if (isset($_GET['id-partido'])){
		$partido_cubierto=$_GET['id-partido'];
	}
  
	if (isset($_POST['editor1'])){
	  
		$dt = DateTime::createFromFormat('d/m/Y', date("d/m/Y"));
		$fecha = $dt->format('Y-m-d');
		
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['editor1']);
		
		$consulta = "INSERT INTO notas (titulo_nota, titulo_galeria, fecha_nota, copete, bajada, epigrafe, face_album, flickr_album, autores_id_autor, id_partido_cubierto, galerias_id_galeria,encuestas_id_encuesta,
		categorias_notas_id_categoria_notas, texto_nota) 
		VALUES 
		('".$_POST['titulo']."','".$_POST['titulo_galeria']."','".$fecha."','".$_POST['copete']."','".$_POST['bajada']."','".$_POST['epigrafe']."','".$_POST['face_album']."','".$_POST['flickr_album']."', 
		".$_POST['autor'].",".$_POST['partido_cubierto'].",".$_POST['galeria'].",".$_POST['encuesta'].",".$_POST['categoria_nota'].",'".base64_encode($txt)."')";
		
//		echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		
		//asocio las categorias
		if (isset($_POST['categorias'])){
			foreach($_POST['categorias'] as $cat){
				$consulta = "INSERT INTO categorias_deportivas_notas (notas_id_nota, categorias_id_categoria) 
				VALUES 
				(".$id.",".$cat.")";
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//asocio los clubes
		if (isset($_POST['clubes'])){
			foreach($_POST['clubes'] as $club){
				$consulta = "INSERT INTO clubes_notas (notas_id_nota, clubes_id_club) 
				VALUES 
				(".$id.",".$club.")";
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//asocio los torneos
		if (isset($_POST['torneos'])){
			foreach($_POST['torneos'] as $torneo){
				$consulta = "INSERT INTO torneos_notas (notas_id_nota, torneos_id_torneo) 
				VALUES 
				(".$id.",".$torneo.")";
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		
		$target_dir = "../img/notas/";
		mkdir($target_dir.$id, 0777, true);
		chmod($target_dir.$id, 0777);
		$index = fopen($target_dir.$id."/index.php", "w");
		
		if(isset($_FILES["foto"]["name"])) {
// 			echo "set";
			$target_dir= "../img/notas/".$id."/";
			$target_file = $target_dir . basename($_FILES["foto"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["foto"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto principal no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["foto"]["size"] > 5000000) {
				$msj = "El archivo de la foto principal es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto principal inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto principal no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir."principal.".$imageFileType)) {
					$consulta = 'UPDATE notas SET imagen_principal= "principal.'.$imageFileType.'" WHERE id_nota='.$id;
// 					 echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen principal";
// 					echo $msj;
				}
			}
		}
		
		if(isset($_FILES["home"]["name"])) {
// 			echo "set";
			$target_dir= "../img/notas/".$id."/";
			$target_file = $target_dir . basename($_FILES["home"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["home"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto de la home no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["home"]["size"] > 5000000) {
				$msj = "El archivo de la foto de la home es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto de la home inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto de la home no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["home"]["tmp_name"], $target_dir."home.".$imageFileType)) {
					$consulta = 'UPDATE notas SET imagen_home= "home.'.$imageFileType.'" WHERE id_nota='.$id;
// 					 echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen de la home";
// 					echo $msj;
				}
			}
		}
		
		if(isset($_FILES["celular"]["name"])) {
// 			echo "set";
			$target_dir= "../img/notas/".$id."/";
			$target_file = $target_dir . basename($_FILES["celular"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["celular"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto de la celular no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["celular"]["size"] > 5000000) {
				$msj = "El archivo de la foto de la celular es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto de la celular inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto de la celular no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["celular"]["tmp_name"], $target_dir."celular.".$imageFileType)) {
					$consulta = 'UPDATE notas SET imagen_celular= "celular.'.$imageFileType.'" WHERE id_nota='.$id;
// 					 echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen de la celular";
// 					echo $msj;
				}
			}
		}
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
					<a href="listado-notas.php">Notas</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Nota</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="?" enctype="multipart/form-data">
						  <fieldset>
							<input id="partido_cubierto" type="hidden" value="<?=$partido_cubierto?>" name="partido_cubierto">
							<div class="control-group">
								<label class="control-label" for="focusedInput">Copete</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" value="" name="copete">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">T&iacute;tulo</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" value="" name="titulo">
								</div>
							  </div>
							
							
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Bajada</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" value="" name="bajada">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="selectError">Autor</label>
								<div class="controls">
								  <select id="autor" name="autor" data-rel="chosen">
									<option value="0">Ninguno</option>
									<?php
										select_autores($mysqli);
									?>
								  </select>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="categoria_nota">Categor&iacute;a</label>
								<div class="controls">
								  <select id="categoria_nota" name="categoria_nota" data-rel="chosen">
									<?php
										select_categorias_notas_group($mysqli);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="clubes">Clubes involucrados</label>
								<div class="controls">
								  <select id="clubes" name="clubes[]" multiple data-rel="chosen">
									<?php
										select_clubes($mysqli);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="categorias">Categor&iacute;as deportivas involucradas</label>
								<div class="controls">
								  <select id="categorias" name="categorias[]" multiple data-rel="chosen">
									<?php
										select_categorias($mysqli);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="torneos">Torneos involucrados</label>
								<div class="controls">
								  <select id="torneos" name="torneos[]" multiple data-rel="chosen">
									<?php
										select_torneos($mysqli);
									?>
								  </select>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="foto">Imagen Principal</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="foto" name="foto" type="file">
								<p style="color: #8e8e8e;font-size: 12px;">Esta imagen ser&aacute; utilizada al comienzo de la nota como header</p>
							  </div>
							</div>   
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Epigrafe</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="epigrafe" type="text" value="" name="epigrafe">
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="home">Imagen Home</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="home" name="home" type="file">
								<p style="color: #8e8e8e;font-size: 12px;">Esta imagen podr&aacute; ser utilizada como fondo de la nota en la home de sitio</p>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="home">Imagen Celular</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="celular" name="celular" type="file">
								<p style="color: #8e8e8e;font-size: 12px;">Esta imagen podr&aacute; ser utilizada en la home de celulares</p>
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="encuesta">Asociar Encuesta</label>
								<div class="controls">
								  <select id="encuesta" name="encuesta" data-rel="chosen">
									<option value="0">Sin encuesta</option>
									<?php
									    select_encuestas($mysqli);
									?>
								  </select>
								  
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Titulo Galeria</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="titulo_galeria" type="text" value="" name="titulo_galeria">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="galeria">Asociar Galeria</label>
								<div class="controls">
								  <select id="galeria" name="galeria" data-rel="chosen">
									<option value="0">Sin galeria</option>
									<?php
									    select_galerias($mysqli);
									?>
								  </select>
								  <p style="color: #8e8e8e;font-size: 12px;">Seleccionando un directorio se crear&aacute; una galer&iacute;a con las im&aacute;genes que contenga</p>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="face_album">Album de Facebook (Formato: http://www.facebook.com/xxxxxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="face_album" maxlength="100" name="face_album" type="url" value="">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="flickr">Album de Flickr (Formato: https://www.flickr.com/xxxxxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="flickr_album" maxlength="100" name="flickr_album" type="url" value="">
								</div>
							  </div>
							
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Texto</label>
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
