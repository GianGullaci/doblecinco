<?php 		include("head.php"); ?>

<?php
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	include_once("includes/coneccion.php");
	
	if (isset($_POST['nombre'])){
		

		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		$consulta = 'UPDATE categorias_notas SET
		nombre_categoria= "'.$_POST['nombre'].'",
		color_categoria= "'.$_POST['color'].'", 
		categorias_notas_id_categoria_notas= '.$_POST['padre'].',
		activa= '.$_POST['estado'].', 
		descripcion="'.base64_encode($txt).'"
		WHERE id_categoria_notas='.$_GET['id'];
// 		  echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = $_GET['id'];
		
		$target_dir = "../img/categorias_notas/";
		if (!file_exists($target_dir.$id)){
		  mkdir($target_dir.$id, 0777, true);
		  chmod($target_dir.$id, 0777);
		  $index = fopen($target_dir.$id."/index.php", "w");
		}
		
		
		$target_dir=$target_dir.$id."/";
		
		if(isset($_FILES["foto_categoria"]) && !empty($_FILES["foto_categoria"]["name"])){
			
			
			foreach (glob($target_dir . 'foto_categoria.' . '*') as $filename) {
			    unlink(realpath($filename));
			}
			
			$target_file = $target_dir . basename($_FILES["foto_categoria"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["foto_categoria"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto de la categoria no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["foto_categoria"]["size"] > 5000000) {
				$msj = "El archivo de la foto de la categoria es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto de la categoria inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto de la categoria no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["foto_categoria"]["tmp_name"], $target_dir."foto_categoria.".$imageFileType)) {
					$consulta = 'UPDATE categorias_notas SET foto_categoria= "foto_categoria.'.$imageFileType.'" WHERE id_categoria_notas='.$id;
					 //echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen de la categoria";
				}
			}
		}
		
		if(isset($_FILES["foto_columna"]) && !empty($_FILES["foto_columna"]["name"])){
// 			$target_dir=$target_dir.$id."/";
			
			foreach (glob($target_dir . 'foto_columna.' . '*') as $filename) {
			    unlink(realpath($filename));
			}
			
			$target_file = $target_dir . basename($_FILES["foto_columna"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["foto_columna"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto de la columna no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["foto_columna"]["size"] > 5000000) {
				$msj = "El archivo de la foto de la columna es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto de la columna inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto de la columna no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["foto_columna"]["tmp_name"], $target_dir."foto_columna.".$imageFileType)) {
					$consulta = 'UPDATE categorias_notas SET foto_columna= "foto_columna.'.$imageFileType.'" WHERE id_categoria_notas='.$id;
					 //echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen de la columna";
				}
			}
		}
	}
	
	
	$query = "SELECT * FROM categorias_notas where id_categoria_notas=".$_GET['id'] or die("Error in the consult.." . mysqli_error($mysqli));
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$id_categoria = $row['id_categoria_notas'];
		$nombre = ucfirst($row['nombre_categoria']);
		$color = $row['color_categoria'];
		$id_categoria_padre = $row['categorias_notas_id_categoria_notas'];
		$descripcion = $row['descripcion'];
		$foto_categoria = $row['foto_categoria'];
		$foto_columna = $row['foto_columna'];
		$estado = $row['activa'];
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
					<a href="listado-categoriasn.php">Categor&iacute;as Notas</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Categor&iacute;a</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?id=<?=$id_categoria?>" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="nombre" name="nombre" type="text" value="<?=$nombre?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="color">Color</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="color" name="color" type="text" value="<?=$color?>">
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="padre">Categor&iacute;a Padre</label>
								<div class="controls">
								  <select id="padre" name="padre" data-rel="chosen">
									<?php
									    select_categorias_notas_padre($mysqli,$id_categoria_padre);
									?>
								  </select>
								</div>
							  </div>
							   <div class="control-group">
							  <label class="control-label" for="foto_categoria">Logo Categoria</label>
							  <div class="controls">
								<?php
								  if (file_exists("../img/categorias_notas/".$id_categoria."/".$foto_categoria)){
								?>
								  <img class="grayscale" src="../img/categorias_notas/<?=$id_categoria?>/<?=$foto_categoria?>" alt="Foto" width="150" style="margin-left: 20px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="foto_categoria" name="foto_categoria" type="file">
							  </div>
							</div>   
							  <div class="control-group">
							  <label class="control-label" for="foto_columna">Logo Columna</label>
							  <div class="controls">
								<?php
								  if (file_exists("../img/categorias_notas/".$id_categoria."/".$foto_columna)){
								?>
								  <img class="grayscale" src="../img/categorias_notas/<?=$id_categoria?>/<?=$foto_columna?>" alt="Foto" width="150" style="margin-left: 20px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="foto_columna" name="foto_columna" type="file">
							  </div>
							</div>   
							  <div class="control-group">
								<label class="control-label" for="selectError">Estado</label>
								<div class="controls">
									<label>
										<input type="radio" name="estado" id="optionsRadios01" value="1"  <?php if ($estado==1) { echo 'checked=""'; } ?> >
										Activo
									</label>
									<label>
										<input type="radio" name="estado" id="optionsRadios11" value="0"  <?php if ($estado==0) { echo 'checked=""'; } ?> >
										Inactivo
									</label>
								</div>
							  </div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Descripci&oacute;n</label>
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
	<script src='js/spectrum.js'></script>
	<link rel='stylesheet' href='css/spectrum.css' />
	<script>
		$("#color").spectrum({
		    preferredFormat: "hex",
		    allowEmpty:true,
		    showInitial: true,
		    showInput: true,
		    color: "<?=$color?>"
		});
	</script>
	
	
</body>
</html>
