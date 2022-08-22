<?php 		include("head.php"); ?>

<?php
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	include_once("includes/coneccion.php");
	
	$id_nota = $_GET['id'];
	if (isset($_POST['titulo'])){

		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['editor1']);
		$consulta = "UPDATE notas SET
		titulo_nota='".$_POST['titulo']."', 
		copete='".$_POST['copete']."',
		titulo_galeria='".$_POST['titulo_galeria']."', 
		bajada='".$_POST['bajada']."', 
		epigrafe='".$_POST['epigrafe']."', 
		face_album='".$_POST['face_album']."', 
		flickr_album='".$_POST['flickr_album']."', 
		autores_id_autor=".$_POST['autor'].", 
		galerias_id_galeria=".$_POST['galeria'].",
		encuestas_id_encuesta=".$_POST['encuesta'].",
		categorias_notas_id_categoria_notas=".$_POST['categoria_nota'].", 
		texto_nota='".base64_encode($txt)."' 
		WHERE id_nota=".$_GET['id'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = $_GET['id'];
		
		//eliminamos las categorias deportivas y las volvemos a insertar
		$consulta = "DELETE FROM categorias_deportivas_notas 
		WHERE notas_id_nota=".$_GET['id'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
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
		
		//eliminamos los clubes y los volvemos a insertar
		$consulta = "DELETE FROM clubes_notas 
		WHERE notas_id_nota=".$_GET['id'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
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
		
		//eliminamos los torneos y los volvemos a insertar
		$consulta = "DELETE FROM torneos_notas 
		WHERE notas_id_nota=".$_GET['id'];
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		
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
		if (!file_exists($target_dir.$id)){
		  mkdir($target_dir.$id, 0777, true);
		  chmod($target_dir.$id, 0777);
		  $index = fopen($target_dir.$id."/index.php", "w");
		}
		
		
		
		if(isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"])){
			$target_dir=$target_dir.$id."/";
			
			foreach (glob($target_dir . 'principal.' . '*') as $filename) {
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
					 //echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen principal";
				}
			}
		}
		
		if(isset($_FILES["home"]) && !empty($_FILES["home"]["name"])){
			$target_dir=$target_dir.$id."/";
			
			foreach (glob($target_dir . 'home.' . '*') as $filename) {
			    unlink(realpath($filename));
			}
			
			$target_file = $target_dir . basename($_FILES["home"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["home"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto home no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["home"]["size"] > 5000000) {
				$msj = "El archivo de la foto home es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto home inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto home no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["home"]["tmp_name"], $target_dir."home.".$imageFileType)) {
					$consulta = 'UPDATE notas SET imagen_home= "home.'.$imageFileType.'" WHERE id_nota='.$id;
					 //echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen home";
				}
			}
		}
		
		if(isset($_FILES["celular"]) && !empty($_FILES["celular"]["name"])){
			$target_dir=$target_dir.$id."/";
			
			foreach (glob($target_dir . 'celular.' . '*') as $filename) {
			    unlink(realpath($filename));
			}
			
			$target_file = $target_dir . basename($_FILES["celular"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["celular"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$msj = "La foto celular no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Check file size
			if ($_FILES["celular"]["size"] > 5000000) {
				$msj = "El archivo de la foto celular es demasiado grande";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$msj = "Extensi&oacute;n del archivo de la foto celular inv&aacute;lida";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$msj = $msj."<br>El archivo de la foto celular no ha sido cargado";
			// if everything is ok, try to upload file
			}
			else {
				if (move_uploaded_file($_FILES["celular"]["tmp_name"], $target_dir."celular.".$imageFileType)) {
					$consulta = 'UPDATE notas SET imagen_celular= "celular.'.$imageFileType.'" WHERE id_nota='.$id;
					 //echo $consulta;
					$sentencia = $mysqli->prepare($consulta);
					$sentencia->execute();
					
				}
				else {
					$msj = "Ha habido un error en la carga de la imagen celular";
				}
			}
		}
		
		//PUBLICIDADES DE LA NOTA
		
		
		//las eliminamos todas y luego insertamos lo que hay
		$consulta = 'DELETE FROM publicidades_posicionadas WHERE notas_id_nota= '.$id.' AND 
		(ubicaciones_id_ubicacion=20 or ubicaciones_id_ubicacion=21 or ubicaciones_id_ubicacion=22 or ubicaciones_id_ubicacion=23)';
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
	
		//1 publicidades en E1: con id=20 en ubicaciones_publicidades
		$param_name = 'publicidadE1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, notas_id_nota) 
				VALUES 
				('.$value.', 20, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2 publicidades en F1: con id=21 en ubicaciones_publicidades
		$param_name = 'publicidadF1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, notas_id_nota) 
				VALUES 
				('.$value.', 21, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//3 publicidades en G1: con id=22 en ubicaciones_publicidades
		$param_name = 'publicidadG1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, notas_id_nota) 
				VALUES 
				('.$value.', 22, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2 publicidades en H1: con id=23 en ubicaciones_publicidades
		$param_name = 'publicidadH1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, notas_id_nota) 
				VALUES 
				('.$value.', 23, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
	}
	
	
	$query = "SELECT titulo_nota, titulo_galeria, bajada, copete, texto_nota, autores_id_autor, categorias_notas_id_categoria_notas,epigrafe,
		  notas.galerias_id_galeria, notas.encuestas_id_encuesta, imagen_principal, imagen_home, imagen_celular, notas.face_album as face_album, notas.flickr_album as flickr_album
		  FROM notas
		  left join categorias_deportivas_notas on categorias_deportivas_notas.notas_id_nota=notas.id_nota
		  left join clubes_notas on clubes_notas.notas_id_nota=notas.id_nota
		  left join torneos_notas on torneos_notas.notas_id_nota=notas.id_nota
		  where notas.id_nota=".$id_nota ;
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$titulo_nota = $row['titulo_nota'];
		$bajada = $row['bajada'];
		$copete = $row['copete'];
		$texto_nota = $row['texto_nota'];
		$autor = $row['autores_id_autor'];
		$categoria_nota = $row['categorias_notas_id_categoria_notas'];
		$galeria = $row['galerias_id_galeria'];
		$encuesta = $row['encuestas_id_encuesta'];
		$principal = $row['imagen_principal'];
		$home = $row['imagen_home'];
		$celular=$row['imagen_celular'];
		$epigrafe = $row['epigrafe'];
		$face_album = $row['face_album'];
		$flickr_album = $row['flickr_album'];
		$titulo_galeria = $row['titulo_galeria'];
		
		$query = "SELECT *
			FROM clubes_notas
			left join notas on clubes_notas.notas_id_nota=notas.id_nota
			where notas.id_nota=".$id_nota ;
		$result = $mysqli->query($query); 
		$clubes = array();
		while ($row = mysqli_fetch_array($result)) {
			$clubes[] = $row['clubes_id_club'];
		}
		
		$query = "SELECT *
			FROM torneos_notas
			left join notas on torneos_notas.notas_id_nota=notas.id_nota
			where notas.id_nota=".$id_nota ;
		$result = $mysqli->query($query); 
		$torneos = array();
		while ($row = mysqli_fetch_array($result)) {
			$torneos[] = $row['torneos_id_torneo'];
		}
		
		$query = "SELECT categorias_deportivas_notas.categorias_id_categoria as categorias_id_categoria
			FROM categorias_deportivas_notas
			left join notas on categorias_deportivas_notas.notas_id_nota=notas.id_nota
			where notas.id_nota=".$id_nota ;
		$result = $mysqli->query($query); 
		$cats_dep = array();
		while ($row = mysqli_fetch_array($result)) {
			$cats_dep[] = $row['categorias_id_categoria'];
		}
	   
	  
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
		
		function crearFilaG1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countG1.value = parseInt(document.forms['form_gen'].resp_countG1.value) + 1;
			var num = document.forms['form_gen'].resp_countG1.value;
			var fieldset_publisG1 = document.getElementById('fieldset_publisG1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publisG1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad G1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadG1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadG1"+num+"' name='publicidadG1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
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
					<a href="listado-notas.php">Notas</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Nota</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form id="form_gen" name="form_gen" class="form-horizontal" action="?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="copete">Copete</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="copete" type="text" value="<?=$copete?>" name="copete">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">T&iacute;tulo</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="titulo" type="text" value="<?=$titulo_nota?>" name="titulo">
								</div>
							  </div>
							
							
							  <div class="control-group">
								<label class="control-label" for="bajada">Bajada</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="bajada" type="text" value="<?=$bajada?>" name="bajada">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="selectError">Autor</label>
								<div class="controls">
								  <select id="autor" name="autor" data-rel="chosen">
									<option value="0">Ninguno</option>
									<?php
										select_autores($mysqli,$autor);
									?>
								  </select>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Categor&iacute;a</label>
								<div class="controls">
								  <select id="categoria_nota" name="categoria_nota" data-rel="chosen">
									<?php
										select_categorias_notas_group($mysqli,$categoria_nota);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Clubes involucrados</label>
								<div class="controls">
								  <select id="clubes" name="clubes[]" multiple data-rel="chosen">
									<?php
										select_clubes_multi($mysqli, $clubes);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Categor&iacute;as deportivas involucradas</label>
								<div class="controls">
								  <select id="categorias" name="categorias[]" multiple data-rel="chosen">
									<?php
										select_categorias_multi($mysqli,$cats_dep);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Torneos involucrados</label>
								<div class="controls">
								  <select id="torneos" name="torneos[]" multiple data-rel="chosen">
									<?php
										select_torneos_multi($mysqli, $torneos);
									?>
								  </select>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Imagen Principal</label>
							  <div class="controls">
								<?php
								  if (file_exists("../img/notas/".$id_nota."/".$principal)){
								?>
								  <img class="grayscale" src="../img/notas/<?=$id_nota?>/<?=$principal?>" alt="Foto" width="150" style="margin-left: 20px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="foto" name="foto" type="file">
								<p style="color: #8e8e8e;font-size: 12px;">Esta imagen ser&aacute; utilizada al comienzo de la nota como header</p>
							  </div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Epigrafe</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="epigrafe" type="text" value="<?=$epigrafe?>" name="epigrafe">
								</div>
							  </div>
							
							<div class="control-group">
							  <label class="control-label" for="fileInput">Imagen Home</label>
							  <div class="controls">
								<?php
								  if (file_exists("../img/notas/".$id_nota."/".$home)){
								?>
								  <img class="grayscale" src="../img/notas/<?=$id_nota?>/<?=$home?>" alt="Foto" width="150" style="margin-left: 20px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="home" name="home" type="file">
								<p style="color: #8e8e8e;font-size: 12px;">Esta imagen podr&aacute; ser utilizada como fondo de la nota en la home de sitio</p>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">Imagen Celular</label>
							  <div class="controls">
								<?php
								  if (file_exists("../img/notas/".$id_nota."/".$celular)){
								?>
								  <img class="grayscale" src="../img/notas/<?=$id_nota?>/<?=$celular?>" alt="Foto" width="150" style="margin-left: 20px">
								  <p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
								<?php
								  }
								?>
								<input class="input-file uniform_on" id="celular" name="celular" type="file">
								<p style="color: #8e8e8e;font-size: 12px;">Esta imagen ser&aacute; utilizada en la home de celulares</p>
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="encuesta">Asociar Encuesta</label>
								<div class="controls">
								  <select id="encuesta" name="encuesta" data-rel="chosen">
									<option value="0">Sin encuesta</option>
									<?php
									    select_encuestas($mysqli,$encuesta);
									?>
								  </select>
								  <p style="color: #8e8e8e;font-size: 12px;">Seleccionando un directorio se crear&aacute; una galer&iacute;a con las im&aacute;genes que contenga</p>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="copete">Titulo Galeria</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="titulo_galeria" type="text" value="<?=$titulo_galeria?>" name="titulo_galeria">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="selectError">Asociar Galeria</label>
								<div class="controls">
								  <select id="galeria" name="galeria" data-rel="chosen">
									<option value="0">Sin galeria</option>
									<?php
									    select_galerias($mysqli,$galeria);
									?>
								  </select>
								  <p style="color: #8e8e8e;font-size: 12px;">Seleccionando un directorio se crear&aacute; una galer&iacute;a con las im&aacute;genes que contenga</p>
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
							  <label class="control-label" for="textarea2">Texto</label>
							  <div class="controls">
								<textarea cols="80" id="editor1" name="editor1" rows="10"><?=base64_decode($texto_nota)?></textarea>
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
								where ubicaciones_id_ubicacion=20 and notas_id_nota=".$_GET['id'];
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
							
							<!--F1-->
							<h3>F1</h3>
							<div class="fieldset_publis" id="fieldset_publisF1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=21 and notas_id_nota=".$_GET['id'];
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
							
							<!--G1-->
							<h3>G1</h3>
							<div class="fieldset_publis" id="fieldset_publisG1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=22 and notas_id_nota=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad G1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadG1<?=$i?>" name="publicidadG1<?=$i?>" >
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
									  <select class="input-xlarge focused" id="publicidadG11" name="publicidadG11" >
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
								  <a href="javascript:crearFilaG1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countG1" id="resp_countG1" value="<?=$i?>" />
							<!--END G1-->
							
							<!--H1-->
							<h3>H1</h3>
							<div class="fieldset_publis" id="fieldset_publisH1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=23 and notas_id_nota=".$_GET['id'];
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
