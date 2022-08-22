<?php 		include("head.php"); ?>

<?php
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	include_once("includes/coneccion.php");
	
	if (isset($_POST['guardar'])){
		
		$id = $_GET['id'];
		
		
		
		
		
		//PUBLICIDADES DE LA CATEGORIA
		
		//1. publicidades de las notas
		
		//las eliminamos todas y luego insertamos lo que hay
		$consulta = 'DELETE FROM publicidades_posicionadas WHERE categorias_id_categoria= '.$id.' AND 
		(ubicaciones_id_ubicacion=20 or ubicaciones_id_ubicacion=21 or ubicaciones_id_ubicacion=22 or ubicaciones_id_ubicacion=23)';
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
	
		//1.1 publicidades en E1: con id=20 en ubicaciones_publicidades
		$param_name = 'publicidadE1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, categorias_id_categoria) 
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
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, categorias_id_categoria) 
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
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, categorias_id_categoria) 
				VALUES 
				('.$value.', 21, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//1.4 publicidades en G1: con id=22 en ubicaciones_publicidades
			
		$param_name = 'publicidadG1';
		foreach($_POST as $key => $value) {
			if(substr($key, 0, strlen($param_name)) == $param_name and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, categorias_id_categoria) 
				VALUES 
				('.$value.', 22, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2. publicidades de la propia categoria
		
		//las eliminamos todas y luego insertamos lo que hay
		$consulta = 'DELETE FROM publicidades_posicionadas WHERE categorias_id_categoria= '.$id.' AND 
		(ubicaciones_id_ubicacion=24 or ubicaciones_id_ubicacion=27 or ubicaciones_id_ubicacion=25 or ubicaciones_id_ubicacion=26)';
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
	
		//2.1 publicidades en categoriaE1: con id=24 en ubicaciones_publicidades
		$param_name = 'publicidadcategoriaE1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, categorias_id_categoria) 
				VALUES 
				('.$value.', 24, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2.2 publicidades en categoriaH1: con id=27 en ubicaciones_publicidades
		$param_name = 'publicidadcategoriaH1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, categorias_id_categoria) 
				VALUES 
				('.$value.', 27, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2.3 publicidades en categoriaF1: con id=25 en ubicaciones_publicidades
		$param_name = 'publicidadcategoriaF1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, categorias_id_categoria) 
				VALUES 
				('.$value.', 25, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
		
		//2.4 publicidades en categoriaG1: con id=26 en ubicaciones_publicidades
		$param_name = 'publicidadcategoriaG1';
		foreach($_POST as $key => $value) {
			if ((substr($key, 0, strlen($param_name)) == $param_name) and $value!=0) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion, categorias_id_categoria) 
				VALUES 
				('.$value.', 26, '.$id.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}
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
		
		
		function crearFilacategoriaE1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countcategoriaE1.value = parseInt(document.forms['form_gen'].resp_countcategoriaE1.value) + 1;
			var num = document.forms['form_gen'].resp_countcategoriaE1.value;
			var fieldset_publiscategoriaE1 = document.getElementById('fieldset_publiscategoriaE1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publiscategoriaE1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad E1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadcategoriaE1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadcategoriaE1"+num+"' name='publicidadcategoriaE1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilacategoriaH1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countcategoriaH1.value = parseInt(document.forms['form_gen'].resp_countcategoriaH1.value) + 1;
			var num = document.forms['form_gen'].resp_countcategoriaH1.value;
			var fieldset_publiscategoriaH1 = document.getElementById('fieldset_publiscategoriaH1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publiscategoriaH1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad H1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadcategoriaH1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadcategoriaH1"+num+"' name='publicidadcategoriaH1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilacategoriaF1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countcategoriaF1.value = parseInt(document.forms['form_gen'].resp_countcategoriaF1.value) + 1;
			var num = document.forms['form_gen'].resp_countcategoriaF1.value;
			var fieldset_publiscategoriaF1 = document.getElementById('fieldset_publiscategoriaF1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publiscategoriaF1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad F1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadcategoriaF1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadcategoriaF1"+num+"' name='publicidadcategoriaF1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
		}
		
		function crearFilacategoriaG1() { //donde num = al i que le corresponde
			document.forms['form_gen'].resp_countcategoriaG1.value = parseInt(document.forms['form_gen'].resp_countcategoriaG1.value) + 1;
			var num = document.forms['form_gen'].resp_countcategoriaG1.value;
			var fieldset_publiscategoriaG1 = document.getElementById('fieldset_publiscategoriaG1');

			var div = document.createElement('div');
			div.setAttribute('class', 'control-group');
			fieldset_publiscategoriaG1.appendChild(div);
			var label = document.createElement('label');
			label.setAttribute('class', 'control-label');
			label.innerHTML="Asociar Publicidad G1";
			div.appendChild(label);
			var div_ctrl = document.createElement('div');
			div_ctrl.setAttribute('class', 'controls');
			div.appendChild(div_ctrl);
									
			var unic = 'publicidadcategoriaG1'+num;
			div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidadcategoriaG1"+num+"' name='publicidadcategoriaG1"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select><a href='' class='delete-publi' >Eliminar</a>";
			
			
			  
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
					<a href="listado-categoriasn.php">Categorias</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Publicidades Categoria</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="form_gen" id="form_gen" action="?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
						  <fieldset>
						  
							<h2>Publicidades de notas dentro de la categorías</h2>
							<br/>
							
							<!--E1-->
							<h3>E1</h3>
							<div class="fieldset_publis" id="fieldset_publisE1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=20 and categorias_id_categoria=".$_GET['id'];
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
								where ubicaciones_id_ubicacion=23 and categorias_id_categoria=".$_GET['id'];
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
								where ubicaciones_id_ubicacion=21 and categorias_id_categoria=".$_GET['id'];
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
							<div class="fieldset_publis"  id="fieldset_publisG1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=22 and categorias_id_categoria=".$_GET['id'];
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
							
							<br><br>
							<h2>Publicidades de los listados de las Categorias</h2>
							<br/>
							
							<!--categoriaE1-->
							<h3>E1</h3>
							<div class="fieldset_publis"  id="fieldset_publiscategoriaE1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=24 and categorias_id_categoria=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad E1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadcategoriaE1<?=$i?>" name="publicidadcategoriaE1<?=$i?>" >
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
									  <select class="input-xlarge focused" id="publicidadcategoriaE11" name="publicidadcategoriaE11" >
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
								  <a href="javascript:crearFilacategoriaE1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countcategoriaE1" id="resp_countcategoriaE1" value="<?=$i?>" />
							<!--END categoriaE1-->
							
							<!--categoriaH1-->
							<div>
							<h3>H1</h3>
							<div class="fieldset_publis"  id="fieldset_publiscategoriaH1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=27 and categorias_id_categoria=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad H1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadcategoriaH1<?=$i?>" name="publicidadcategoriaH1<?=$i?>" >
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
									  <select class="input-xlarge focused" id="publicidadcategoriaH11" name="publicidadcategoriaH11" >
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
								  <a href="javascript:crearFilacategoriaH1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countcategoriaH1" id="resp_countcategoriaH1" value="<?=$i?>" />
							</div>
							<!--END categoriaH1-->
							
							<!--categoriaF1-->
							
							<h3>F1</h3>
							<div class="fieldset_publis"  id="fieldset_publiscategoriaF1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=25 and categorias_id_categoria=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad F1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadcategoriaF1<?=$i?>" name="publicidadcategoriaF1<?=$i?>" >
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
									  <select class="input-xlarge focused" id="publicidadcategoriaF11" name="publicidadcategoriaF11" >
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
								  <a href="javascript:crearFilacategoriaF1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countcategoriaF1" id="resp_countcategoriaF1" value="<?=$i?>" />
							
							<!--END categoriaF1-->
							
							<!--categoriaG1-->
							<h3>G1</h3>
							<div class="fieldset_publis"  id="fieldset_publiscategoriaG1">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=26 and categorias_id_categoria=".$_GET['id'];
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad G1</label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidadcategoriaG1<?=$i?>" name="publicidadcategoriaG1<?=$i?>" >
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
									  <select class="input-xlarge focused" id="publicidadcategoriaG11" name="publicidadcategoriaG11" >
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
								  <a href="javascript:crearFilacategoriaG1();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_countcategoriaG1" id="resp_countcategoriaG1" value="<?=$i?>" />
							<!--END categoriaG1-->
							
							
							<div class="form-actions">
							  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
							  <button type="reset" onClick="location.href='editar-publicidades-categoria.php?id=<?=$id?>'" class="btn">Cancelar</button>
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
