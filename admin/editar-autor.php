<?php 		include("head.php"); ?>

<?php
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	include_once("includes/coneccion.php");
	
	if (isset($_POST['nombre'])){

		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		$consulta = 'UPDATE autores SET
		nombre_autor= "'.$_POST['nombre'].'", 
		titulo_autor= "'.$_POST['titulo'].'", 
		email= "'.$_POST['email'].'", 
		descripcion="'.base64_encode($txt).'"
		WHERE id_autor='.$_GET['id'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = $_GET['id'];
		
		$target_dir = "../img/autores/";
		if (!file_exists($target_dir.$id)){
		  mkdir($target_dir.$id, 0777, true);
		  chmod($target_dir.$id, 0777);
		  $index = fopen($target_dir.$id."/index.php", "w");
		}
		
		
		
		if(isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"])){
			$target_dir=$target_dir.$id."/";
			
			foreach (glob($target_dir . 'autor.' . '*') as $filename) {
			    unlink(realpath($filename));
			}
			
			$target_file = $target_dir . basename($_FILES["foto"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["foto"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto del autor no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["foto"]["size"] > 5000000) {
				$msj = "El archivo de la foto del autor es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto del autor inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto del autor no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir."autor.".$imageFileType)) {
					$consulta = 'UPDATE autores SET foto= "autor.'.$imageFileType.'" WHERE id_autor='.$id;
					 //echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen del jugador";
				}
			}
		}
	}
	
	
	$query = "SELECT * FROM autores where id_autor=".$_GET['id'];
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$id_autor = $row['id_autor'];
		$nombre_autor = ucfirst($row['nombre_autor']);
		$titulo_autor = ucfirst($row['titulo_autor']);
		$email = $row['email'];
		$descripcion = $row['descripcion'];
		$foto = $row['foto'];
	}
	else{
	  die("id incorrecto");
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
					<a href="listado-autores.php">Autores</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Autor</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="nombre" name="nombre" required type="text" value="<?=$nombre_autor?>">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="email">E-mail</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="email" name="email" type="email" value="<?=$email?>">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="titulo">T&iacute;tulo</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="titulo" name="titulo" required type="text" value="<?=$titulo_autor?>">
								</div>
							  </div>
							

							<div class="control-group">
							  <label class="control-label" for="foto">Foto</label>
							  <div class="controls">
								<?php
								  if (file_exists("../img/autores/".$id_autor."/".$foto)){
								?>
								  <img class="grayscale" src="../img/autores/<?=$id_autor?>/<?=$foto?>" alt="Foto Autor" width="150" style="margin-left: 20px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="foto" name="foto" type="file">
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
