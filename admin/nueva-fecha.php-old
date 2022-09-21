<?php
	if (isset($_POST['guardar']) or isset($_POST['guardarp'])){

		include_once("includes/coneccion.php");
		
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
		
		$consulta = 'INSERT INTO fechas (nombre, torneos_id_torneo1, fase, fecha_inicio, fecha_fin, descripcion) 
		VALUES 
		("'.$_POST['nombre'].'",'.$_POST['torneo'].','.$_POST['fase'].', "'.$fecha.'", "'.$fechafin.'",  "'.base64_encode($txt).'")';
		 //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		if (isset($_POST['guardar'])){
		  header("Location: listado-fechas.php");
		}
		if (isset($_POST['guardarp'])){
		  header("Location: listado-partidos.php?fecha=".$id);
		}
		
	}
	include("head.php");
	$id_torneo=0;
	if (isset($_GET['torneo'])){
	  $id_torneo=$_GET['torneo'];
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
					<a href="listado-fechas.php">Fechas</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Fecha</h2>
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
								  <input class="input-xlarge focused" required id="nombre" name="nombre" type="text" value="">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="torneo">Torneo</label>
								<div class="controls">
								  <select id="torneo" name="torneo" data-rel="chosen">
									<?php
										select_torneos($mysqli,$torneo);
									?>
								  </select>
								</div>
							</div>
							  <div class="control-group">
								<label class="control-label">Fase (JUVENILES)</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios1" value="1" checked="">
									Fase 1
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios2" value="2">
									Fase 2
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios3" value="3">
									Fase 3 (Semifinal)
								  </label>
								<div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios4" value="4">
									Fase 4 (Final)
								  </label>
								<div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios5" value="5">
									Fase 5 (Finalisima)
								  </label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Fase (MENORES)</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios6" value="6" checked="">
									Fase 1
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios7" value="7">
									<!--Fase 2: Torneo Apertura-->
									Fase 2
								  </label>
								  <!--<div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios8" value="8">
									Fase 2: Torneo Clausura
								  </label>-->
								<div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios9" value="9">
									Final
								  </label>
								<div style="clear:both"></div>
								</div>
							  </div>
							  
							  
							  
							<div class="control-group">
								<label class="control-label" for="fecha">Fecha Inicio</label>
								<div class="controls">
									<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}"  class="input-xlarge datepicker" id="fecha" name="fecha" value="">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="fechafin">Fecha Fin</label>
								<div class="controls">
									<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}"  class="input-xlarge datepicker" id="fechafin" name="fechafin" value="">
								</div>
							</div> 
							  
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Descripci&oacute;n</label>
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
							  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
							  <button type="submit" name="guardarp" class="btn btn-warning">Guardar y Cargar Partidos</button>
							  <button type="reset" onClick="location.href='listado-fechas.php'"  class="btn">Cancelar</button>
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
