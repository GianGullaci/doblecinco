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
		}

		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		$consulta = 'UPDATE clubes SET nombre_club= "'.$_POST['nombre'].'",
		fecha_inauguracion= "'.$fecha.'",
		direccion_sede= "'.$_POST['sede'].'",
		direccion_estadio= "'.$_POST['estadio'].'", 
		direccion_predio= "'.$_POST['predio'].'", 
		titulo_galeria= "'.$_POST['titulo_galeria'].'",
		telefono_club= "'.$_POST['telefono'].'", 
		facebook= "'.$_POST['face'].'", 
		face_album= "'.$_POST['face_album'].'", 
		flickr_album= "'.$_POST['flickr_album'].'", 
		email = "'.$_POST['email'].'",
		sitio= "'.$_POST['sitio'].'",
		fe_erratas= "'.$_POST['fe_erratas'].'", 
		galerias_id_galeria = '.$_POST['galeria'].',
		nombre_presidente= "'.$_POST['presi'].'", 
		descripcion=  "'.base64_encode($txt).'"
		WHERE id_club='.$_GET['id'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = $_GET['id'];
		
		
		$query ="SELECT * FROM lugares where clubes_id_club=".$_GET['id']." AND tipo_lugar=1" ;
		$result = $mysqli->query($query); 
		if ($row = mysqli_fetch_array($result)) {
		      //lo encontre es un update
		      $consulta = "UPDATE lugares SET direccion='".$_POST['sede']."' WHERE id_lugar=".$row['id_lugar'];
		}
		else{
		      $consulta = "INSERT INTO lugares (clubes_id_club, direccion, tipo_lugar) VALUES (".$id.", '".$_POST['sede']."', '1') ";
		}
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
		if (isset($_POST['estadio']) and $_POST['estadio']!=""){
			$query ="SELECT * FROM lugares where clubes_id_club=".$_GET['id']." AND tipo_lugar=2" ;
			$result = $mysqli->query($query); 
			if ($row = mysqli_fetch_array($result)) {
			      //lo encontre es un update
			      $consulta = "UPDATE lugares SET direccion='".$_POST['estadio']."' WHERE id_lugar=".$row['id_lugar'];
			}
			else{
			      $consulta = "INSERT INTO lugares (clubes_id_club, direccion, tipo_lugar) VALUES (".$id.", '".$_POST['estadio']."', '2') ";
			}
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
		}
		
		if (isset($_POST['predio']) and $_POST['predio']!=""){
			$query ="SELECT * FROM lugares where clubes_id_club=".$_GET['id']." AND tipo_lugar=3" ;
			$result = $mysqli->query($query); 
			if ($row = mysqli_fetch_array($result)) {
			      //lo encontre es un update
			      $consulta = "UPDATE lugares SET direccion='".$_POST['predio']."' WHERE id_lugar=".$row['id_lugar'];
			}
			else{
			      $consulta = "INSERT INTO lugares (clubes_id_club, direccion, tipo_lugar) VALUES (".$id.", '".$_POST['predio']."', '3') ";
			}
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
		}
		
		$target_dir = "../img/clubes/";
		if (!file_exists($target_dir.$id)){
		  mkdir($target_dir.$id, 0777, true);
		  chmod($target_dir.$id, 0777);
		  $index = fopen($target_dir.$id."/index.php", "w");
		}
		
		if(isset($_FILES["logo"]) && !empty($_FILES["logo"]["name"])){
			$target_dir=$target_dir.$id."/";
			
			foreach (glob($target_dir . 'logo.' . '*') as $filename) {
			    unlink(realpath($filename));
			}
			
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
		
		if(isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"])){
			$target_dir= "../img/clubes/".$id."/";
			
			foreach (glob($target_dir . 'presidente.' . '*') as $filename) {
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
		
		
		//PUBLICIDADES DEL CLUB
		
		//1. publicidades de las notas
		
		//las eliminamos todas y luego insertamos lo que hay
		$consulta = 'DELETE FROM publicidades_posicionadas WHERE clubes_id_club= '.$id.' AND 
		(ubicaciones_id_ubicacion=20 or ubicaciones_id_ubicacion=21 or ubicaciones_id_ubicacion=23)';
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
	
		//1.1 publicidades en E1: con id=20 en ubicaciones_publicidades
		$param_name = 'publicidadE1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, clubes_id_club) 
				VALUES 
				('.$value.', 20, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//1.2 publicidades en H1: con id=23 en ubicaciones_publicidades
			
		$param_name = 'publicidadH1';
		foreach($_POST as $key => $value) {
			if(substr($key, 0, strlen($param_name)) == $param_name and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, clubes_id_club) 
				VALUES 
				('.$value.', 23, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//1.3 publicidades en F1: con id=21 en ubicaciones_publicidades
			
		$param_name = 'publicidadF1';
		foreach($_POST as $key => $value) {
			if(substr($key, 0, strlen($param_name)) == $param_name and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, clubes_id_club) 
				VALUES 
				('.$value.', 21, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2. publicidades del propio club
		
		//las eliminamos todas y luego insertamos lo que hay
		$consulta = 'DELETE FROM publicidades_posicionadas WHERE clubes_id_club= '.$id.' AND 
		(ubicaciones_id_ubicacion=16 or ubicaciones_id_ubicacion=17 or ubicaciones_id_ubicacion=18 or ubicaciones_id_ubicacion=19)';
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
	
		//2.1 publicidades en clubE1: con id=16 en ubicaciones_publicidades
		$param_name = 'publicidadclubE1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, clubes_id_club) 
				VALUES 
				('.$value.', 16, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2.2 publicidades en clubH1: con id=19 en ubicaciones_publicidades
		$param_name = 'publicidadclubH1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, clubes_id_club) 
				VALUES 
				('.$value.', 19, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2.3 publicidades en clubF1: con id=17 en ubicaciones_publicidades
		$param_name = 'publicidadclubF1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, clubes_id_club) 
				VALUES 
				('.$value.', 17, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2.4 publicidades en clubG1: con id=18 en ubicaciones_publicidades
		$param_name = 'publicidadclubG1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, clubes_id_club) 
				VALUES 
				('.$value.', 18, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
	}
	
	
	$query = "SELECT * FROM clubes where id_club=".$_GET['id'] or die("Error in the consult.." . mysqli_error($mysqli));
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$id_club = $row['id_club'];
		$nombre_club = ucfirst($row['nombre_club']);
		$nombre_presidente = ucfirst($row['nombre_presidente']);
		
		$fecha_inauguracion ="";
		if ($row['fecha_inauguracion']!="0000-00-00 00:00:00"){
		  $fecha_inauguracion  = $row['fecha_inauguracion'];
		  $time = strtotime($fecha_inauguracion );
		  $fecha_inauguracion  = date("d-m-Y", $time);
		}
		
		$sede = $row['direccion_sede'];
		$estadio = $row['direccion_estadio'];
		$predio = $row['direccion_predio'];
		$telefono = $row['telefono_club'];
		$email = $row['email'];
		$sitio = $row['sitio'];
		$fe_erratas = $row['fe_erratas'];
		$facebook = $row['facebook'];
		$flickr_album = $row['flickr_album'];
		$face_album = $row['face_album'];
		$descripcion = $row['descripcion'];
		$logo = $row['logo_club'];
		$foto = $row['foto_presidente'];
		$galeria = $row['galerias_id_galeria'];
		$titulo_galeria = $row['titulo_galeria'];
		
	}
	else{
	  die("id incorrecto");
	}
?>

<body>

	<script type="text/javascript">
	   
		function crearFilaE1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countE1.value = parseInt(document.forms['form_gen'].resp_countE1.value) + 1;
			var num = document.forms['form_gen'].resp_countE1.value;
			var fieldset_publisE1 = document.getElementById('fieldset_publisE1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publisE1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad E1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadE1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadE1"+num+"' name='publicidadE1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilaH1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countH1.value = parseInt(document.forms['form_gen'].resp_countH1.value) + 1;
			var num = document.forms['form_gen'].resp_countH1.value;
			var fieldset_publisH1 = document.getElementById('fieldset_publisH1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publisH1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad H1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadH1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadH1"+num+"' name='publicidadH1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilaF1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countF1.value = parseInt(document.forms['form_gen'].resp_countF1.value) + 1;
			var num = document.forms['form_gen'].resp_countF1.value;
			var fieldset_publisF1 = document.getElementById('fieldset_publisF1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publisF1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad F1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadF1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadF1"+num+"' name='publicidadF1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilaclubE1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countclubE1.value = parseInt(document.forms['form_gen'].resp_countclubE1.value) + 1;
			var num = document.forms['form_gen'].resp_countclubE1.value;
			var fieldset_publisclubE1 = document.getElementById('fieldset_publisclubE1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publisclubE1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad E1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadclubE1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadclubE1"+num+"' name='publicidadclubE1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilaclubH1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countclubH1.value = parseInt(document.forms['form_gen'].resp_countclubH1.value) + 1;
			var num = document.forms['form_gen'].resp_countclubH1.value;
			var fieldset_publisclubH1 = document.getElementById('fieldset_publisclubH1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publisclubH1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad H1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadclubH1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadclubH1"+num+"' name='publicidadclubH1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilaclubF1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countclubF1.value = parseInt(document.forms['form_gen'].resp_countclubF1.value) + 1;
			var num = document.forms['form_gen'].resp_countclubF1.value;
			var fieldset_publisclubF1 = document.getElementById('fieldset_publisclubF1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publisclubF1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad F1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadclubF1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadclubF1"+num+"' name='publicidadclubF1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilaclubG1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countclubG1.value = parseInt(document.forms['form_gen'].resp_countclubG1.value) + 1;
			var num = document.forms['form_gen'].resp_countclubG1.value;
			var fieldset_publisclubG1 = document.getElementById('fieldset_publisclubG1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publisclubG1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad G1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadclubG1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadclubG1"+num+"' name='publicidadclubG1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		
	</script>

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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Club</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="form_gen" id="form_gen" action="?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="nombre" name="nombre" required type="text" value="<?=$nombre_club?>">
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="fecha">Fecha de Inauguración</label>
							  <div class="controls">
								<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" class="input-xlarge datepicker" id="fecha" name="fecha" value="<?=$fecha_inauguracion?>">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="sede">Direcci&oacute;n sede</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" required id="sede" name="sede" type="text" value="<?=$sede?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="estadio">Direcci&oacute;n Estadio</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="estadio" name="estadio" type="text" value="<?=$estadio?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="predio">Direcci&oacute;n Predio Auxiliar</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="predio" name="predio" type="text" value="<?=$predio?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="telefono">Tel&eacute;fono (Formato: 9999-999999999)</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="45" id="telefono" name="telefono" type="tel" pattern='\d*[\-{0,1}]\d*'  value="<?=$telefono?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="email">E-mail</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="email" name="email" type="email" value="<?=$email?>">
								</div>
							  </div>
							  <div class="control-group">
							  <label class="control-label" for="logo">Logo</label>
							  <div class="controls">
								<?php
								  if (file_exists("../img/clubes/".$id_club."/".$logo)){
								?>
								  <img class="grayscale" src="../img/clubes/<?=$id_club?>/<?=$logo?>" alt="Logo" style="margin-left: 20px;max-width: 150px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="logo" name="logo" type="file">
							  </div>
							</div>
							  <div class="control-group">
								<label class="control-label" for="sitio">Sitio (Formato: http://www.yyyyy.xxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="sitio" name="sitio" type="url" value="<?=$sitio?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="face">Facebook (Formato: http://www.facebook.com/xxxxxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="face" name="face" type="url" value="<?=$facebook?>">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="presi">Nombre Presidente</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" required id="presi" name="presi" type="text" value="<?=$nombre_presidente?>">
								</div>
							  </div>
							

							<div class="control-group">
							  <label class="control-label" for="foto">Foto Presidente</label>
							  <div class="controls">
								<?php
								  if (file_exists("../img/clubes/".$id_club."/".$foto)){
								?>
								  <img class="grayscale" src="../img/clubes/<?=$id_club?>/<?=$foto?>" alt="Foto Presidente" width="150" style="margin-left: 20px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="foto" name="foto" type="file">
							  </div>
							</div>   
							<div class="control-group">
								<label class="control-label" for="sitio">Fe de erratas</label>
								<div class="controls">
								  <textarea class="input-xlarge" id="fe_erratas" name="fe_erratas"><?=$fe_erratas?></textarea>
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="nombre">Titulo Galeria</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="100" id="titulo_galeria" name="titulo_galeria" required type="text" value="<?=$titulo_galeria?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="galeria">Galer&iacute;a</label>
								<div class="controls">
								  <select id="galeria" name="galeria" data-rel="chosen">
									<option value="0">Ninguna</option>
									<?php
										select_galerias($mysqli,$galeria);
									?>
								  </select>
								</div>
							  </div>	
							  
							  <div class="control-group">
								<label class="control-label" for="face_album">Album de Facebook (Formato: http://www.facebook.com/xxxxxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="face_album" maxlength="100" name="face_album" type="url" value="<?=$face_album?>">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="flickr_album">Album de Flickr (Formato: https://www.flickr.com/xxxxxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="flickr_album" maxlength="100" name="flickr_album" type="url" value="<?=$flickr_album?>">
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
							
							<br><br>
							<h2>Publicidades Notas</h2>
							<br/>
							
							<!--E1-->
							<h3>E1</h3>
							<div class="fieldset_publis" id="fieldset_publisE1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=20 and clubes_id_club=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad E1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadE1<?=$i?>" name="publicidadE1<?=$i?>" >
									  <?php
										  select_publicidades_no_archivadas($mysqli,$row['publicidades_id_publicidad']);
									  ?>
								  </select>
								  <a href="" class="delete-publi" id="<?=$row['publicidades_id_publicidad']?>">Eliminar</a>
								</div>
								
							  </div>
							  
							  <?php
							  
								}
								if ($i==0){
								      $i=1;
							  
							  ?>
							  
								  <div class="control-group" id="pregunta1">
									<label class="control-label" for="focusedInput">Asociar Publicidad E1</label>
									<div class="controls">
									  <select class="input-xlarge focused" id="publicidadE11" name="publicidadE11" >
										  <option value="0">Seleccionar</opion>
										  <?php
											  select_publicidades_no_archivadas($mysqli,0);
										  ?>
									  </select>
									</div>
									
								  </div>
							 <?php
							 
								}
							 
							 ?>
							  
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFilaE1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countE1" id="resp_countE1" value="<?=$i?>" />
							<!--END E1-->
							
							<!--H1-->
							<h3>H1</h3>
							<div class="fieldset_publis"  id="fieldset_publisH1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=23 and clubes_id_club=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad H1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadH1<?=$i?>" name="publicidadH1<?=$i?>" >
									  <?php
										  select_publicidades_no_archivadas($mysqli,$row['publicidades_id_publicidad']);
									  ?>
								  </select>
								  <a href="" class="delete-publi" id="<?=$row['publicidades_id_publicidad']?>">Eliminar</a>
								</div>
								
							  </div>
							  
							  <?php
							  
								}
								if ($i==0){
								      $i=1;
							  
							  ?>
							  
								  <div class="control-group" id="pregunta1">
									<label class="control-label" for="focusedInput">Asociar Publicidad H1</label>
									<div class="controls">
									  <select class="input-xlarge focused" id="publicidadH11" name="publicidadH11" >
										  <option value="0">Seleccionar</opion>
										  <?php
											  
											  select_publicidades_no_archivadas($mysqli,0);
										  ?>
									  </select>
									</div>
									
								  </div>
							 <?php
							 
								}
							 
							 ?>
							  
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFilaH1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countH1" id="resp_countH1" value="<?=$i?>" />
							<!--END H1-->
							
							<!--F1-->
							<h3>F1</h3>
							<div class="fieldset_publis"  id="fieldset_publisF1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=21 and clubes_id_club=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad F1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadF1<?=$i?>" name="publicidadF1<?=$i?>" >
									  <?php
										  select_publicidades_no_archivadas($mysqli,$row['publicidades_id_publicidad']);
									  ?>
								  </select>
								  <a href="" class="delete-publi" id="<?=$row['publicidades_id_publicidad']?>">Eliminar</a>
								</div>
								
							  </div>
							  
							  <?php
							  
								}
								if ($i==0){
								      $i=1;
							  
							  ?>
							  
								  <div class="control-group" id="pregunta1">
									<label class="control-label" for="focusedInput">Asociar Publicidad F1</label>
									<div class="controls">
									  <select class="input-xlarge focused" id="publicidadF11" name="publicidadF11" >
										  <option value="0">Seleccionar</opion>
										  <?php
											  
											  select_publicidades_no_archivadas($mysqli,0);
										  ?>
									  </select>
									</div>
									
								  </div>
							 <?php
							 
								}
							 
							 ?>
							  
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFilaF1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countF1" id="resp_countF1" value="<?=$i?>" />
							<!--END F1-->
							
							<br><br>
							<h2>Publicidades Club</h2>
							<br/>
							
							<!--clubE1-->
							<h3>E1</h3>
							<div class="fieldset_publis"  id="fieldset_publisclubE1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=16 and clubes_id_club=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad E1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadclubE1<?=$i?>" name="publicidadclubE1<?=$i?>" >
									  <?php
										  select_publicidades_no_archivadas($mysqli,$row['publicidades_id_publicidad']);
									  ?>
								  </select>
								  <a href="" class="delete-publi" id="<?=$row['publicidades_id_publicidad']?>">Eliminar</a>
								</div>
								
							  </div>
							  
							  <?php
							  
								}
								if ($i==0){
								      $i=1;
							  
							  ?>
							  
								  <div class="control-group" id="pregunta1">
									<label class="control-label" for="focusedInput">Asociar Publicidad E1</label>
									<div class="controls">
									  <select class="input-xlarge focused" id="publicidadclubE11" name="publicidadclubE11" >
										  <option value="0">Seleccionar</opion>
										  <?php
											  
											  select_publicidades_no_archivadas($mysqli,0);
										  ?>
									  </select>
									</div>
									
								  </div>
							 <?php
							 
								}
							 
							 ?>
							  
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFilaclubE1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countclubE1" id="resp_countclubE1" value="<?=$i?>" />
							<!--END clubE1-->
							
							<!--clubH1-->
							<h3>H1</h3>
							<div class="fieldset_publis"  id="fieldset_publisclubH1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=19 and clubes_id_club=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad H1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadclubH1<?=$i?>" name="publicidadclubH1<?=$i?>" >
									  <?php
										  select_publicidades_no_archivadas($mysqli,$row['publicidades_id_publicidad']);
									  ?>
								  </select>
								  <a href="" class="delete-publi" id="<?=$row['publicidades_id_publicidad']?>">Eliminar</a>
								</div>
								
							  </div>
							  
							  <?php
							  
								}
								if ($i==0){
								      $i=1;
							  
							  ?>
							  
								  <div class="control-group" id="pregunta1">
									<label class="control-label" for="focusedInput">Asociar Publicidad H1</label>
									<div class="controls">
									  <select class="input-xlarge focused" id="publicidadclubH11" name="publicidadclubH11" >
										  <option value="0">Seleccionar</opion>
										  <?php
											  
											  select_publicidades_no_archivadas($mysqli,0);
										  ?>
									  </select>
									</div>
									
								  </div>
							 <?php
							 
								}
							 
							 ?>
							  
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFilaclubH1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countclubH1" id="resp_countclubH1" value="<?=$i?>" />
							<!--END clubH1-->
							
							<!--clubF1-->
							<h3>F1</h3>
							<div class="fieldset_publis"  id="fieldset_publisclubF1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=17 and clubes_id_club=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad F1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadclubF1<?=$i?>" name="publicidadclubF1<?=$i?>" >
									  <?php
										  select_publicidades_no_archivadas($mysqli,$row['publicidades_id_publicidad']);
									  ?>
								  </select>
								  <a href="" class="delete-publi" id="<?=$row['publicidades_id_publicidad']?>">Eliminar</a>
								</div>
								
							  </div>
							  
							  <?php
							  
								}
								if ($i==0){
								      $i=1;
							  
							  ?>
							  
								  <div class="control-group" id="pregunta1">
									<label class="control-label" for="focusedInput">Asociar Publicidad F1</label>
									<div class="controls">
									  <select class="input-xlarge focused" id="publicidadclubF11" name="publicidadclubF11" >
										  <option value="0">Seleccionar</opion>
										  <?php
											  
											  select_publicidades_no_archivadas($mysqli,0);
										  ?>
									  </select>
									</div>
									
								  </div>
							 <?php
							 
								}
							 
							 ?>
							  
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFilaclubF1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countclubF1" id="resp_countclubF1" value="<?=$i?>" />
							<!--END clubF1-->
							
							<!--clubG1-->
							<h3>G1</h3>
							<div class="fieldset_publis"  id="fieldset_publisclubG1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=18 and clubes_id_club=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad G1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadclubG1<?=$i?>" name="publicidadclubG1<?=$i?>" >
									  <?php
										  select_publicidades_no_archivadas($mysqli,$row['publicidades_id_publicidad']);
									  ?>
								  </select>
								  <a href="" class="delete-publi" id="<?=$row['publicidades_id_publicidad']?>">Eliminar</a>
								</div>
								
							  </div>
							  
							  <?php
							  
								}
								if ($i==0){
								      $i=1;
							  
							  ?>
							  
								  <div class="control-group" id="pregunta1">
									<label class="control-label" for="focusedInput">Asociar Publicidad G1</label>
									<div class="controls">
									  <select class="input-xlarge focused" id="publicidadclubG11" name="publicidadclubG11" >
										  <option value="0">Seleccionar</opion>
										  <?php
											  
											  select_publicidades_no_archivadas($mysqli,0);
										  ?>
									  </select>
									</div>
									
								  </div>
							 <?php
							 
								}
							 
							 ?>
							  
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFilaclubG1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countclubG1" id="resp_countclubG1" value="<?=$i?>" />
							<!--END clubG1-->
							
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
							  <button type="reset" onClick="location.href='listado-clubes.php'" class="btn">Cancelar</button>
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
	
	
	<script>
	$(document).ready(function() {
		$( '.fieldset_publis' ).on( 'click', 'a.delete-publi', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var padre = $(this).closest("div").parent();
				padre.remove();
			}
		});
	});
	</script>
	
	
</body>
</html>
