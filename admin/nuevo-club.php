<?php 		include("head.php"); ?>

<?php
	if (isset($_POST['nombre'])){

		include_once("includes/coneccion.php");
		
		$fecha = "NULL";
		if ($_POST['fecha']!="" and $_POST['fecha']!=NULL){
			$dt = DateTime::createFromFormat('d-m-Y', $_POST['fecha']);
			$fecha = $dt->format('Y-m-d');
		}

		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		$consulta = 'INSERT INTO clubes (nombre_club, titulo_galeria, fecha_inauguracion, direccion_sede, direccion_estadio, direccion_predio, telefono_club, facebook, face_album, flickr_album, email,
		galerias_id_galeria, sitio, fe_erratas, nombre_presidente, descripcion) 
		VALUES 
		("'.$_POST['nombre'].'", "'.$_POST['titulo_galeria'].'", "'.$fecha.'", "'.$_POST['sede'].'", "'.$_POST['estadio'].'", "'.$_POST['predio'].'", "'.$_POST['telefono'].'",
		"'.$_POST['face'].'", "'.$_POST['face_album'].'", "'.$_POST['flickr'].'", "'.$_POST['email'].'", '.$_POST['galeria'].', "'.$_POST['sitio'].'","'.$_POST['fe_erratas'].'", 
		"'.$_POST['presi'].'","'.base64_encode($txt).'")';
		 //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		
		
		//inserto los lugares
		$consulta = 'INSERT INTO lugares (clubes_id_club, tipo_lugar, direccion) 
		VALUES 
		('.$id.', "1", "'.$_POST['sede'].'")';
// 		echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		if (isset($_POST['estadio']) and $_POST['estadio']!=""){
			$consulta = 'INSERT INTO lugares (clubes_id_club, tipo_lugar, direccion) 
			VALUES 
			('.$id.', "2", "'.$_POST['estadio'].'")';
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
		}
		
		if (isset($_POST['predio']) and $_POST['predio']!=""){
			$consulta = 'INSERT INTO lugares (clubes_id_club, tipo_lugar, direccion) 
			VALUES 
			('.$id.', "3", "'.$_POST['predio'].'")';
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
		}
		
		$target_dir = "../img/clubes/";
		mkdir($target_dir.$id, 0777, true);
		chmod($target_dir.$id, 0777);
		$index = fopen($target_dir.$id."/index.php", "w");
		
		if(isset($_FILES["logo"]["name"])) {
			$target_dir=$target_dir.$id."/";
			$target_file = $target_dir . basename($_FILES["logo"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["logo"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "El logo no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["logo"]["size"] > 5000000) {
				$msj = "El archivo del logo es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de logo inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo del logo no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_dir."logo.".$imageFileType)) {
					$consulta = 'UPDATE clubes SET logo_club= "logo.'.$imageFileType.'" WHERE id_club='.$id;
					 //echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga del logo";
				}
			}
		}
		
		if(isset($_FILES["logo2"]["name"])) {
			$target_dir2="../img/logos/";
			$target_file = $target_dir2 . basename($_FILES["logo2"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["logo2"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "El logo no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["logo2"]["size"] > 5000000) {
				$msj = "El archivo del logo es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de logo inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo del logo no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["logo2"]["tmp_name"], $target_dir2.$_POST['nombre']."-".$id.".".$imageFileType)) {
// 					$consulta = 'UPDATE clubes SET logo_club= "logo.'.$imageFileType.'" WHERE id_club='.$id;
// 					 //echo $consulta;
// 					$sentencia = $mysqli->prepare($consulta);
// 					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga del logo";
				}
			}
		}
		
		if(isset($_FILES["foto"]["name"])) {
			$target_dir= "../img/clubes/".$id."/";
			$target_file = $target_dir . basename($_FILES["foto"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["foto"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto del presidente no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["foto"]["size"] > 5000000) {
				$msj = "El archivo de la foto del presidente es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto del presidente inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto del presidente no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir."presidente.".$imageFileType)) {
					$consulta = 'UPDATE clubes SET foto_presidente= "presidente.'.$imageFileType.'" WHERE id_club='.$id;
					 //echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen del presidente";
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
					<a href="listado-clubes.php">Clubes</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Club</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="nombre" name="nombre" required type="text" value="">
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="fecha">Fecha de Inauguración</label>
							  <div class="controls">
								<?php
									$hoy=date("d-m-Y");
								?>
								<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}"  class="input-xlarge datepicker" id="fecha" name="fecha" value="">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="sede">Direcci&oacute;n sede</label>
								<div class="controls">
								  <input class="input-xlarge focused"  maxlength="100" required id="sede" name="sede" type="text" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="estadio">Direcci&oacute;n Estadio</label>
								<div class="controls">
								  <input class="input-xlarge focused"  maxlength="100" id="estadio" name="estadio" type="text" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="predio">Direcci&oacute;n Predio Auxiliar</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="predio" name="predio" type="text" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="telefono">Tel&eacute;fono (Formato: 9999-999999999)</label>
								<div class="controls">
								  <input class="input-xlarge focused"  maxlength="45" id="telefono" name="telefono" type="tel" pattern='\d*[\-{0,1}]\d*'  value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="email">E-mail</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="email" name="email" type="email" value="">
								</div>
							  </div>
							  <div class="control-group">
							  <label class="control-label" for="logo">Logo</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="logo" name="logo" type="file">
							  </div>
							   <div class="control-group">
							  <label class="control-label" for="logo2">Logo con fondo</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="logo2" name="logo2" type="file">
							  </div>
							</div>
							  <div class="control-group">
								<label class="control-label" for="sitio">Sitio (Formato: http://www.yyyyy.xxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="sitio" name="sitio" type="url" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="face">Facebook (Formato: http://www.facebook.com/xxxxxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="face" maxlength="100" name="face" type="url" value="">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="presi">Nombre Presidente</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" required id="presi" name="presi" type="text" value="">
								</div>
							  </div>
							

							<div class="control-group">
							  <label class="control-label" for="foto">Foto Presidente</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="foto" name="foto" type="file">
							  </div>
							</div>  
							 <div class="control-group">
								<label class="control-label" for="fe_erratas">Fe de erratas</label>
								<div class="controls">
								  <textarea class="input-xlarge" id="fe_erratas" name="fe_erratas"></textarea>
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="nombre">Titulo Galeria</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="titulo_galeria" name="titulo_galeria" required type="text" value="">
								</div>
							  </div>

							<div class="control-group">
								<label class="control-label" for="galeria">Galer&iacute;a</label>
								<div class="controls">
								  <select id="galeria" name="galeria" data-rel="chosen">
									<option value="0">Ninguna</option>
									<?php
										select_galerias($mysqli);
									?>
								  </select>
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
								  <input class="input-xlarge focused" id="flickr" maxlength="100" name="flickr" type="url" value="">
								</div>
							  </div>
							  
							<div class="control-group hidden-phone">
							  <label class="control-label" for="descripcion">Descripci&oacute;n</label>
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
