<?php
	if (isset($_POST['torneo'])){
		include_once("includes/coneccion.php");
		
		$dia = "NULL";
		if ($_POST['dia']!="" and $_POST['dia']!=NULL){
			$dt = DateTime::createFromFormat('d-m-Y', $_POST['dia']);
			$dia = $dt->format('Y-m-d');
		}

		$categoria = $_POST['categoria'];
		$id_equipo_local= $_POST['local'];
		$id_equipo_visitante= $_POST['visitante'];
		
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		
		$consulta = 'INSERT INTO partidos (fecha_partido, hora_partido, arbitros_id_arbitro,arbitros_id_arbitro1,arbitros_id_arbitro2, equipos_id_equipo, equipos_id_equipo1, 
		fechas_id_fecha, galerias_id_galeria,lugares_id_lugar, zona, face_album, flickr_album, descripcion) 
		VALUES 
		("'.$dia.'","'.$_POST['hora'].'",'.$_POST['arbitro'].','.$_POST['arbitro1'].','.$_POST['arbitro2'].','.$id_equipo_local.','.$id_equipo_visitante.', '.$_POST['fecha'].', 
		'.$_POST['galeria'].', '.$_POST['lugar'].', "'.$_POST['zona'].'", "'.$_POST['face_album'].'", "'.$_POST['flickr_album'].'",  "'.base64_encode($txt).'")';
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		if (isset($_POST['guardary']) and $_POST['guardary']==1){
		  header("Location: listado-partidos.php");
		}
		if (isset($_POST['guardary']) and $_POST['guardary']==2){
		  header("Location: editar-partido.php?id=".$id);
		}
		
	}
	include("head.php");
	$torneo=0;
	if (isset($_GET['torneo'])){
	  $torneo=$_GET['torneo'];
	}
	$fecha=0;
	if (isset($_GET['fecha'])){
	  $fecha=$_GET['fecha'];
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
					<a href="listado-partidos.php">Partidos</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Partido</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" id="form-partido" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="torneo">Torneo</label>
								<div class="controls">
								  <select class="input-xlarge" id="torneo" name="torneo" data-rel="chosen">
									<?php
										select_torneos($mysqli,$torneo);
									?>
								  </select>
								</div>
							</div>
							 <div class="control-group">
								<label class="control-label" for="fecha">Fecha</label>
								<div class="controls">
								  <select class="input-xlarge" id="fecha" name="fecha" data-rel="chosen">
									
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Zona</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="zona" id="optionsRadios1" value="A" checked="">
									Zona A
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="zona" id="optionsRadios2" value="B">
									Zona B
								  </label>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="dia">D&iacute;a</label>
							  <div class="controls">
								<?php
									$hoy=date("d-m-Y");
								?>
								<input type="text" class="input-xlarge datepicker" name="dia" id="dia" value="<?=$hoy?>">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="hora">Hora (Formato: 99:99)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="hora" name="hora" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="categoria">Categor&iacute;a</label>
								<div class="controls">
								  <select class="input-xlarge" id="categoria" name="categoria" data-rel="chosen">
									<?php
										select_categorias($mysqli);
									?>
								  </select>
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="local">Equipo Local</label>
								<div class="controls">
								  <select class="input-xlarge" id="local" name="local" data-rel="chosen">
									<?php
										//select_clubes($mysqli);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="visitante">Equipo Visitante</label>
								<div class="controls">
								  <select class="input-xlarge" id="visitante" name="visitante" data-rel="chosen" >
									<?php
										//select_clubes($mysqli);
									?>
								  </select>
								  <span id="equipos_iguales" style="display:none;" class="help-inline">Los equipos deben ser diferentes</span>
								  
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="lugar">Lugar</label>
								<div class="controls">
								  <select class="input-xlarge" id="lugar" name="lugar" data-rel="chosen">
									<option value="0">A definir</option>
								  </select>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="arbitros">&Aacute;rbitros</label>
								<div class="controls">
								  <select id="arbitro" name="arbitro" class="input-xlarge"   data-rel="chosen">
										<option value="0">Indefinido</option>
									<?php
										select_arbitros($mysqli);
									?>
								  </select>
								  <select id="arbitro1" name="arbitro1" class="input-xlarge"   data-rel="chosen">
										<option value="0">Indefinido</option>
									<?php
										select_arbitros($mysqli);
									?>
								  </select>
								  <select id="arbitro2" name="arbitro2" class="input-xlarge"   data-rel="chosen">
										<option value="0">Indefinido</option>
									<?php
										select_arbitros($mysqli);
									?>
								  </select>
								</div>
							  </div>
							  
							<div class="control-group">
								<label class="control-label" for="galeria">Galeria</label>
								<div class="controls">
								  <select id="galeria" name="galeria" data-rel="chosen">
									<option value="0">Sin galeria</option>
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
								  <input class="input-xlarge focused" id="flickr_album" maxlength="100" name="flickr_album" type="url" value="">
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
							<input type="hidden" value="1" name="guardary" id="guardary">
							<div class="alert alert-error" id="error_general" style="display:none;">
								<!--<button data-dismiss="alert" class="close" type="button">×</button>-->
								<strong>Error en la carga</strong> <span id="texto-error"></span>
							</div>
							<div class="form-actions">
							  <button type="submit" name="guardar" id="guardar" class="btn btn-primary">Guardar</button>
							  <button type="button" name="guardard" id="guardard" class="btn btn-warning">Guardar y Cargar m&aacute;s datos</button>
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
	
		function guardar(){
			$('#error_general').hide();
			if($('#local').val() == $('#visitante').val()) {
				$('#equipos_iguales').show();
				$('#equipos_iguales').parent().parent().addClass("error");
			}
			else{
				var local = $('#local').val();
				var visitante = $('#visitante').val();
				var fecha = $('#fecha').val();
				var categoria = $('#categoria').val();
			    
				$.ajax({
					type: 'get',
					url: 'includes/check-partido.php',
					data: 'ajax=1&id_local=' + local + '&id_visitante=' + visitante + '&fecha=' + fecha + '&categoria=' + categoria,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error==false){
							$('#form-partido')[0].submit();
						}
						else{	
							$('#error_general').show();
							$('#texto-error').text(res.mensaje_error);
						}
					}
				});
			}
		}
		$(document).ready(function() {
			    
			$.getJSON("includes/select_fechas.php",{id: $('#torneo').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].nombre + '</option>';
				}
				$("select#fecha").html(options);
				$("#fecha").trigger('liszt:updated');

			});
			$.getJSON("includes/select_equipos.php",{categoria: $('#categoria').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].nombre + '</option>';
				}
				$("select#local").html(options);
				$("#local").trigger('liszt:updated');
				
				$("select#visitante").html(options);
				$("#visitante").trigger('liszt:updated');
				
				$.getJSON("includes/select_lugar.php",{equipo1: $('#local').val(),equipo2: $('#visitante').val(), ajax: 'true'}, function(j){
					var options = '<option value="0">A definir</option>';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].id + '">' + j[i].direccion + '</option>';
					}
					$("select#lugar").html(options);
					$("#lugar").trigger('liszt:updated');

				});
			});
			
			$("select#categoria").change(function(){
				$.getJSON("includes/select_equipos.php",{categoria: $(this).val(),ajax: 'true'}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].id + '">' + j[i].nombre + '</option>';
					}
					$("select#local").html(options);
					$("#local").trigger('liszt:updated');
					
					$("select#visitante").html(options);
					$("#visitante").trigger('liszt:updated');
				})
			});
			$("select#local").change(function(){
				$.getJSON("includes/select_lugar.php",{equipo1: $(this).val(),equipo2: $('#visitante').val(), ajax: 'true'}, function(j){
					var options = '<option value="0">A definir</option>';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].id + '">' + j[i].direccion + '</option>';
					}
					$("select#lugar").html(options);
					$("#lugar").trigger('liszt:updated');
				})
			});
			$("select#visitante").change(function(){
				$.getJSON("includes/select_lugar.php",{equipo2: $(this).val(),equipo1: $('#local').val(), ajax: 'true'}, function(j){
					var options = '<option value="0">A definir</option>';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].id + '">' + j[i].direccion + '</option>';
					}
					$("select#lugar").html(options);
					$("#lugar").trigger('liszt:updated');

				})
			});
			$("select#torneo").change(function(){
				$.getJSON("includes/select_fechas.php",{id: $(this).val(), ajax: 'true'}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].id + '">' + j[i].nombre + '</option>';
					}
					$("select#fecha").html(options);
					$("#fecha").trigger('liszt:updated');

				})
			});
			$("#visitante").change(function(){
				if($(this).val() == $("#local").val()) {
					$('#equipos_iguales').show();
					$('#equipos_iguales').parent().parent().addClass("error");
				
				}
				else{
					$('#equipos_iguales').hide();
					$('#equipos_iguales').parent().parent().removeClass("error");
				}
			});
			$("#local").change(function(){
				if($(this).val() == $("#visitante").val()) {
					$('#equipos_iguales').show();
					$('#equipos_iguales').parent().parent().addClass("error");
			
				}
				else{
					$('#equipos_iguales').hide();
					$('#equipos_iguales').parent().parent().removeClass("error");
				}
			});
			
			$("#guardard").click(function(e){
			    e.preventDefault();
			    $('#guardary').val("2");
			    guardar();
			});
			
			  
			$("#guardar").click(function(e){
				e.preventDefault();
				$('#guardary').val("1");
				guardar();
			   
			  });
		});
	</script>
	
	
</body>
</html>
