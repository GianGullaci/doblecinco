<?php 		include("head.php"); ?>

<?php
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	include_once("includes/coneccion.php");
	
	if (isset($_POST['nombre'])){
		$fecha = "NULL";
		if ($_POST['fecha']!="" and $_POST['fecha']!=NULL){
			$dt = DateTime::createFromFormat('d-m-Y', $_POST['fecha']);
			$fecha = $dt->format('Y-m-d');
			$anio = substr($_POST['fecha'], -4);
		}
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		
		$consulta = 'UPDATE jugadores SET
		nombre_jugador= "'.$_POST['nombre'].'", 
		fecha_nacimiento="'.$fecha.'" , 
		anio= "'.$anio.'", 
		altura= "'.$_POST['altura'].'", 
		peso= "'.$_POST['peso'].'", 
		video= "'.$_POST['video'].'", 
		puesto_id_puesto= '.$_POST['puesto'].',
		equipo_club= '.$_POST['equipo'].', 
		pierna_habil_id_pierna_habil= '.$_POST['pierna_habil'].', 
		ciudades_id_ciudad= '.$_POST['ciudad'].',
		clubes_id_club= '.$_POST['club'].', 
		descripcion="'.base64_encode($txt).'"
		WHERE id_jugador='.$_GET['id'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = $_GET['id'];
		
		$target_dir = "../img/jugadores/";
		if (!file_exists($target_dir.$id)){
		  mkdir($target_dir.$id, 0777, true);
		  chmod($target_dir.$id, 0777);
		  $index = fopen($target_dir.$id."/index.php", "w");
		}
		
		
		
		if(isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"])){
			$target_dir=$target_dir.$id."/";
			
			foreach (glob($target_dir . 'jugador.' . '*') as $filename) {
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
					$msj = "La foto del jugador no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["foto"]["size"] > 5000000) {
				$msj = "El archivo de la foto del jugador es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto del jugador inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto del jugador no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir."jugador.".$imageFileType)) {
					$consulta = 'UPDATE jugadores SET foto= "jugador.'.$imageFileType.'" WHERE id_jugador='.$id;
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
	
	
	$query = "SELECT * FROM jugadores where id_jugador=".$_GET['id'] or die("Error in the consult.." . mysqli_error($mysqli));
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$id_jugador = $row['id_jugador'];
		$nombre_jugador = ucfirst($row['nombre_jugador']);
		$fecha_nacimiento ="";
		if ($row['fecha_nacimiento']!="0000-00-00 00:00:00"){
		  $fecha_nacimiento  = $row['fecha_nacimiento'];
		  $time = strtotime($fecha_nacimiento );
		  $fecha_nacimiento  = date("d-m-Y", $time);
		}
		$peso = $row['peso'];
		$altura = $row['altura'];
		$video = $row['video'];
		$pierna_habil = $row['pierna_habil_id_pierna_habil'];
		$club = $row['clubes_id_club'];
		$puesto = $row['puesto_id_puesto'];
		$ciudad = $row['ciudades_id_ciudad'];
		$descripcion = $row['descripcion'];
		$equipo = $row['equipo_club'];
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
					<a href="listado-jugadores.php">Jugadores</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Jugador</h2>
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
								  <input class="input-xlarge focused" maxlength="100" id="nombre" name="nombre" required type="text" value="<?=$nombre_jugador?>">
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="fecha">Fecha de Nacimiento</label>
							  <div class="controls">
								<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required class="input-xlarge datepicker" id="fecha" name="fecha" value="<?=$fecha_nacimiento?>">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="ciudad">Nacido en</label>
								<div class="controls">
								  <select id="ciudad" name="ciudad" data-rel="chosen">
									<option value="0">Ciudades</option>
									<?php
										select_ciudades($mysqli,$ciudad);
									?>
								  </select>
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="puesto">Puesto</label>
								<div class="controls">
								  <select id="puesto" name="puesto" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
										select_puesto($mysqli,$puesto);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="pierna_habil">Pierna Hábil</label>
								<div class="controls">
								  <select id="pierna_habil" name="pierna_habil" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
										select_pierna_habil($mysqli,$pierna_habil);
									?>
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="club">Club</label>
								<div class="controls">
								  <select id="club" name="club" data-rel="chosen">
									<?php
										select_clubes($mysqli,$club);
									?>
								  </select>
								</div>
							  </div>
							  

							<div class="control-group">
							  <label class="control-label" for="fileInput">Foto</label>
							  <div class="controls">
							      <?php
								  if (file_exists("../img/jugadores/".$id_jugador."/".$foto) and $foto!=""){
								?>
								  <img class="grayscale" src="../img/jugadores/<?=$id_jugador?>/<?=$foto?>" alt="Foto" width="150" style="margin-left: 20px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="foto" name="foto" type="file">
							  </div>
							</div> 
							<div class="control-group">
								<label class="control-label" for="video">Video</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="video" name="video" type="url" value="<?=$video?>">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="peso">Peso. (Formato: 00.000)</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="10" pattern="(\d{1,3})([\,\.]){0,1}(\d{0,3}){0,1}" id="peso" name="peso" type="text" value="<?=$peso?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="altura">Altura. (Formato: 0.00)</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="10" pattern="(\d{1})([\,\.]){0,1}(\d{0,2}){0,1}" id="altura" name="altura" type="text" value="<?=$altura?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="equipo">Equipo</label>
								<div class="controls">
								  <select id="equipo" name="equipo" data-rel="chosen">
									<option value="0" <? if ($equipo==0){ echo "selected"; } ?>>A</option>
									<option value="1" <? if ($equipo==1){ echo "selected"; } ?>>B</option>
								  </select>
								</div>
							  </div>
							  <!--<div class="control-group">
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
							  </div>-->
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
