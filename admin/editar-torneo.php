<?php
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	if (isset($_POST['guardar']) or isset($_POST['guardarf'])){
		include_once("includes/coneccion.php");
		
		if (isset($_POST['nombre'])){
			$fecha = "NULL";
			if ($_POST['fecha']!="" and $_POST['fecha']!=NULL){
				$dt = DateTime::createFromFormat('d-m-Y', $_POST['fecha']);
				$fecha = $dt->format('Y-m-d');
			}
			
			$fechafin = "NULL";
			if ($_POST['fechafin']!="" and $_POST['fechafin']!=NULL){
				$dt = DateTime::createFromFormat('d-m-Y', $_POST['fechafin']);
				$fechafin = $dt->format('Y-m-d');
			}

			$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
			$consulta = 'UPDATE torneos SET
			nombre_torneo = "'.$_POST['nombre'].'", 
			fecha_inicio="'.$fecha.'" ,
			fecha_fin="'.$fechafin.'" , 
			descripcion="'.base64_encode($txt).'"
			WHERE id_torneo='.$_GET['id'];
			  //echo $consulta;
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
			$id = $_GET['id'];
			
		}
		if (isset($_POST['guardarf'])) {
		  header("Location: listado-fechas.php?torneo=".$id);
		}
	}
	
	include("head.php");
	include_once("includes/coneccion.php");
	
	$query = "SELECT * FROM torneos where id_torneo=".$_GET['id'];
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$id_torneo = $row['id_torneo'];
		$nombre_torneo = ucfirst($row['nombre_torneo']);
		$fecha ="";
		$fechafin="";
		if ($row['fecha_inicio']!="0000-00-00 00:00:00"){
		  $fecha = $row['fecha_inicio'];
		  $time = strtotime($fecha);
		  $fecha = date("d-m-Y", $time);
		}
		if ($row['fecha_fin']!="0000-00-00 00:00:00"){
		  $fechafin = $row['fecha_fin'];
		  $time = strtotime($fechafin);
		  $fechafin = date("d-m-Y", $time);
		}
		
		$descripcion = $row['descripcion'];
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
					<a href="listado-torneos.php">Torneos</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Torneo</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?id=<?=$id_torneo?>" method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
									<input class="input-xlarge focused" required id="nombre" name="nombre" type="text" value="<?=$nombre_torneo?>">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="fecha">Fecha Inicio</label>
								<div class="controls">
									<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}"  class="input-xlarge datepicker" id="fecha" name="fecha" value="<?=$fecha?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="fechafin">Fecha Fin</label>
								<div class="controls">
									<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}"  class="input-xlarge datepicker" id="fechafin" name="fechafin" value="<?=$fechafin?>">
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
 							  <button type="submit" name="guardarf" class="btn btn-warning">Guardar y Cargar Fechas</button>
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
