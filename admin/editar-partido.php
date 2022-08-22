<?php 		include("head.php"); ?>
<?php

  (isset($_GET['id'])) ? : die('id sin setear');
  $id_partido = $_GET['id'];
  
  //display opciones segun $_GET
  //datos=1&jugadores=0&goles=0&amoestaciones=0&
  
  $display_datos = (isset($_GET['datos']) and $_GET['datos']==1) ? "style='display:block;'" : "style='display:none;'";
  $chevron_datos = (isset($_GET['datos']) and $_GET['datos']==1) ? "chevron-up" : "chevron-down";
  
  $display_jugadores = (isset($_GET['jugadores']) and $_GET['jugadores']==1) ? "style='display:block;'" : "style='display:none;'";
  $chevron_jugadores = (isset($_GET['jugadores']) and $_GET['jugadores']==1) ? "chevron-up" : "chevron-down";
  
  $display_goles = (isset($_GET['goles']) and $_GET['goles']==1) ? "display:block;" : "display:none;";
  $chevron_goles = (isset($_GET['goles']) and $_GET['goles']==1) ? "chevron-up" : "chevron-down";
  
  $display_amonestaciones = (isset($_GET['amonestaciones']) and $_GET['amonestaciones']==1) ? "display:block;" : "display:none;";
  $chevron_amonestaciones = (isset($_GET['amonestaciones']) and $_GET['amonestaciones']==1) ? "chevron-up" : "chevron-down";
  
  $display_posiciones = (isset($_GET['posiciones']) and $_GET['posiciones']==1) ? "style='display:block;'" : "style='display:none;'";
  $chevron_posiciones = (isset($_GET['posiciones']) and $_GET['posiciones']==1) ? "chevron-up" : "chevron-down";
  
  
  //datos partido
  $query = "SELECT id_partido, fecha_partido, hora_partido,lugares.direccion as lugar, tipo_lugar, zona, 
	    club_juega.nombre_club as nombre_juega, club_local.nombre_club as nombre_local, club_local.id_club as id_local, 
	    club_visitante.nombre_club as nombre_visitante, club_visitante.id_club as id_visitante, nombre_categoria,  fechas.nombre as nombre_fecha, 
	    nombre_torneo, DATEDIFF(fecha_partido,CURDATE()) as dif,
	    fechas.torneos_id_torneo1, partidos.fechas_id_fecha, equipo_visitante.categorias_id_categoria, 
	    partidos.lugares_id_lugar, arbitros_id_arbitro, arbitros_id_arbitro1, arbitros_id_arbitro2, partidos.descripcion,
	    equipo_local.id_equipo as id_equipo_local, equipo_visitante.id_equipo as id_equipo_visitante,
	    configuracion_local, configuracion_visitante, partidos.galerias_id_galeria as galerias_id_galeria, 
	    partidos.face_album as face_album, partidos.flickr_album as flickr_album,
	    equipo_local.nombre_equipo as nombre_equipo_local,
	    equipo_visitante.nombre_equipo as nombre_equipo_visitante
	    FROM partidos 
	    left join equipos as equipo_local on equipo_local.id_equipo=partidos.equipos_id_equipo
	    left join clubes as club_local on club_local.id_club=equipo_local.clubes_id_club
	    left join equipos as equipo_visitante on equipo_visitante.id_equipo=partidos.equipos_id_equipo1
	    left join clubes as club_visitante on club_visitante.id_club=equipo_visitante.clubes_id_club
	    left join categorias on categorias.id_categoria=equipo_visitante.categorias_id_categoria
	    left join fechas on fechas.id_fecha=partidos.fechas_id_fecha
	    left join torneos on fechas.torneos_id_torneo1=torneos.id_torneo
	    left join lugares on partidos.lugares_id_lugar=lugares.id_lugar
	    left join clubes as club_juega on club_juega.id_club=lugares.clubes_id_club
	    where partidos.id_partido=".$id_partido ;
  $result = $mysqli->query($query); 
  if ($row = mysqli_fetch_array($result)) {
      $id_torneo = $row['torneos_id_torneo1'];
      $nombre_torneo = $row['nombre_torneo'];
      $id_fecha = $row['fechas_id_fecha'];
      $id_categoria=$row['categorias_id_categoria'];
      $id_lugar=$row['lugares_id_lugar'];
      $id_local=$row['id_local'];
      $id_visitante=$row['id_visitante'];
      $club_local=$row['club_local'];
      $club_visitante=$row['club_visitante'];
      $nombre_local=$row['nombre_local'];
      $nombre_visitante=$row['nombre_visitante'];
      $dia ="";
      if ($row['fecha_partido']!="0000-00-00 00:00:00"){
		$dia= $row['fecha_partido'];
		$time = strtotime($dia);
		$dia = date("d-m-Y", $time);
      }
      $hora=$row['hora_partido'];
      $arbitro=$row['arbitros_id_arbitro'];
      $arbitro1=$row['arbitros_id_arbitro1'];
      $arbitro2=$row['arbitros_id_arbitro2'];
      $descripcion=$row['descripcion'];
      $id_equipo_local=$row['id_equipo_local'];
      $id_equipo_visitante=$row['id_equipo_visitante'];
      $nombre_categoria=$row['nombre_categoria'];
      $configuracion_local=$row['configuracion_local'];
      $configuracion_visitante=$row['configuracion_visitante'];
      $zona=$row['zona'];
      $galeria = $row['galerias_id_galeria'];
      $face_album=$row['face_album'];
      $flickr_album=$row['flickr_album'];
      $zona=$row['zona'];
      $nombre_equipo_local=$row['nombre_equipo_local'];
      $nombre_equipo_visitante=$row['nombre_equipo_visitante'];
  }
  else{
	die("Partido inexistente");
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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Datos del partido</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon <?=$chevron_datos?>"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content" <?=$display_datos?>>
						<form class="form-horizontal">
						  <fieldset>
						  <div class="span6">
							<input type="hidden" name="id_partido" id="id_partido" value="<?=$id_partido?>">
							<div class="control-group">
								<label class="control-label" for="torneo">Torneo</label>
								<div class="controls">
								   <input type="text" disabled class="input-medium focused" value="<?=$nombre_torneo?>">
								   <input type="hidden" name="torneo" id="torneo" value="<?=$id_torneo?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="fecha">Fecha</label>
								<div class="controls">
								  <select id="fecha" name="fecha" data-rel="chosen">
								  </select>
								</div>
							  </div>
							  <input type="hidden" name="fecha_id" id="fecha_id" value="<?=$id_fecha?>">
							  <div class="control-group">
								<label class="control-label">Zona</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="zona" id="optionsRadios1" value="A" <?php if ($zona=='A') { echo 'checked=""'; }?> >
									Zona A
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="zona" id="optionsRadios2" value="B" <?php if ($zona=='B') { echo 'checked=""'; }?> >
									Zona B
								  </label>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="dia">D&iacute;a</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" name="dia" id="dia" value="<?=$dia?>">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="hora">Hora (Formato: 99:99)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="hora" name="hora" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="<?=$hora?>">
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="categoria">Categor&iacute;a</label>
								<div class="controls">
								  <input type="text" disabled class="input-medium focused" value="<?=$nombre_categoria?>">
								  <input type="hidden" name="categoria" id="categoria" value="<?=$id_categoria?>">
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
							
							  </div>
							  <div class="span6">
							  <div class="control-group">
								<label class="control-label" for="selectError">Lugar</label>
								<div class="controls">
								  <select id="lugar" name="lugar" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
										select_lugares($mysqli,$id_lugar,$id_local,$id_visitante);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="arbitro">&Aacute;rbitros</label>
								<div class="controls">
								  <select id="arbitro" name="arbitro" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
									  select_arbitros($mysqli,$arbitro);
									?>
								  </select>
								</div>
								<div class="controls">
								  <select id="arbitro1" name="arbitro1" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
									  select_arbitros($mysqli,$arbitro1);
									?>
								  </select>
								</div>
								<div class="controls">
								  <select id="arbitro2" name="arbitro2" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
									  select_arbitros($mysqli,$arbitro2);
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Equipo Local</label>
								<div class="controls">
								  <input type="text" disabled class="input-medium focused" id="nombre_local" value="<?=$nombre_equipo_local?>">
								</div>
							  </div>
							  <input type="hidden" name="id_local" id="id_local" value="<?=$id_local?>">
							  <input type="hidden" name="id_equipo_local" id="id_equipo_local" value="<?=$id_equipo_local?>">
							  <div class="control-group">
								<label class="control-label" for="selectError">Equipo Visitante</label>
								<div class="controls">
								  <input type="text" disabled class="input-medium focused" id="nombre_visitante" value="<?=$nombre_equipo_visitante?>">
								</div>
							  </div>
							  <input type="hidden" name="id_visitante" id="id_visitante" value="<?=$id_visitante?>">
							<input type="hidden" name="id_equipo_visitante" id="id_equipo_visitante" value="<?=$id_equipo_visitante?>">
							  
							   <div class="control-group">
								<label class="control-label" for="face_album">Album de Facebook (http://www.facebook.com/xx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="face_album" maxlength="100" name="face_album" type="url" value="<?=$face_album?>">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="flickr_album">Album de Flickr (https://www.flickr.com/xx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="flickr_album" maxlength="100" name="flickr_album" type="url" value="<?=$flickr_album?>">
								</div>
							  </div>
							  
							</div>
							
							
							<div class="clearfix"></div>
							 <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Descrpci&oacute;n</label>
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
							<div class="alert alert-error" id="error_general_datos" style="display:none;">
								<strong>Error en la carga</strong> <span id="texto-error"></span>
							</div>
							<div class="alert alert-success" id="guardado_datos" style="display:none;">
								<strong>Guardado!</strong>Los datos del partido han sido guardados con éxito
							</div>
							<div class="alert alert-block " id="cambios_datos" style="display:none;">
								<h4 class="alert-heading">Atención!</h4>
								<p>Ha modificado datos que no han sido guardados</p>
							</div>
							<div class="controls">
							  <button type="submit" name="guardarp" id="guardarp" class="btn btn-primary">Guardar Partido</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div>
			</div>
			
			<?php
				include("configuracion-equipos.php");
			?>
			
			<!--cargar jugadores-->
			
			<?php
				include("carga-jugadores.php")
			?>
			
			<!--jugadores cargados-->
			<?php
				include("jugadores-partido.php");
			?>

			<?php
				include("goles-partido.php");
			?>
			
			<?php
				include("penales-partido.php");
			?>
	
			
			<!--amoestaciones-->
			<?php
				include("amonestaciones-partido.php");
			?>
	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
	
	<div class="clearfix"></div>
	
	
	<div class="clearfix"></div>
	
	
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
	<script>
		
		function hideErrors(){
			$('#error_general').hide();
			$('#guardado_datos').hide();
			$('#cambios_datos').hide();
			
			$('#guardado_jugador').hide();
			$('#error_jugador').hide();
			
			$('#guardado_jugadorv').hide();
			$('#error_jugadorv').hide();
			
			$('#error_conf').hide();
			$('#guardado_conf').hide();
			
			$('#error_gol').hide();
			$('#guardado_gol').hide();
			
			$('#error_penal').hide();
			$('#guardado_penal').hide();
			
			$('#error_amonestacion').hide();
			$('#guardado_amonestacion').hide();
		}
		
	
		$(document).ready(function(){
			$('.ver-cancha').click(function(e){
				e.preventDefault();
				$('#popup-cancha').modal('show');
			});
  
			$.getJSON("includes/select_fechas.php",{id: $('#torneo').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					var sele="";
					if ($('#fecha_id').val()==j[i].id){
						sele=" selected ";
					}
					options += '<option value="' + j[i].id + '" '+ sele +' >' + j[i].nombre + '</option>';
				}
				$("select#fecha").html(options);
				$("#fecha").trigger('liszt:updated');

			});
			$.getJSON("includes/select_jugadores.php",{id: $('#equipo_gol').val(),id_equipo_local: $('#id_equipo_local').val(),id_equipo_visitante: $('#id_equipo_visitante').val(),id_partido: $('#id_partido').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + ' " >' + j[i].nombre + '</option>';
				}
				$("select#jugador_gol").html(options);
				$("#jugador_gol").trigger('liszt:updated');

			});
			
			$.getJSON("includes/select_jugadores.php",{id: $('#equipo_penal').val(),id_equipo_local: $('#id_equipo_local').val(),id_equipo_visitante: $('#id_equipo_visitante').val(),id_partido: $('#id_partido').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + ' " >' + j[i].nombre + '</option>';
				}
				$("select#jugador_penal").html(options);
				$("#jugador_penal").trigger('liszt:updated');

			});
			
			$.getJSON("includes/select_jugadores.php",{id: $('#equipo_amonestacion').val(),id_equipo_local: $('#id_equipo_local').val(),id_equipo_visitante: $('#id_equipo_visitante').val(),id_partido: $('#id_partido').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + ' " >' + j[i].nombre + '</option>';
				}
				$("select#jugador_amonestacion").html(options);
				$("#jugador_amonestacion").trigger('liszt:updated');

				});
 			$("#guardarp").click(function(e){
				e.preventDefault();
				hideErrors();
				
				var local = $('#local').val();
				var visitante = $('#visitante').val();
				var fecha = $('#fecha').val();
				var categoria = $('#categoria').val();
				var id_equipo_visitante = $('#id_equipo_visitante').val();
				var id_equipo_local = $('#id_equipo_local').val();
				var id_partido = $('#id_partido').val();
				var dia = $('#dia').val();
				var hora = $('#hora').val();
				var lugar = $('#lugar').val();
				var arbitro = $('#arbitro').val();
				var arbitro1 = $('#arbitro1').val();
				var arbitro2 = $('#arbitro2').val();
				var galeria = $('#galeria').val();
				var face_album = $('#face_album').val();
				var flickr_album = $('#flickr_album').val();
				var zona = $("input[name='zona']:checked").val();
				CKEDITOR.instances['descripcion'].updateElement();
				var descripcion = CKEDITOR.instances['descripcion'].getData();
			    
				$.ajax({
					type: 'get',
					url: 'includes/check-partido.php',
					data: 'ajax=1&fecha=' + fecha + '&categoria=' + categoria + '&id=' + id_partido + '&id_local=' + id_equipo_local +
					'&id_visitante=' + id_equipo_visitante ,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error==false){
							$.ajax({
								type: 'get',
								url: 'includes/update-partido.php',
								data: 'ajax=1&fecha=' + fecha + '&id=' + id_partido + '&dia=' + dia + '&hora=' + hora + '&lugar=' 
								      + lugar + '&arbitro=' + arbitro + '&arbitro1=' + arbitro1 + '&arbitro2=' + arbitro2
								      + '&galeria=' + galeria + '&face_album=' + face_album + '&flickr_album=' + flickr_album
								      + '&zona=' + zona + '&descripcion=' + escape(descripcion),
								success: function(data) {
									
									var res = $.parseJSON(data);
									if (res.error==false){
										$('#guardado_datos').show().delay(5000).fadeOut();
									}
									else{	
										$('#error_general').show();
										$('#texto-error').text(res.mensaje_error);
									}
								}
							});
						}
						else{	
							$('#error_general').show();
							$('#texto-error').text(res.mensaje_error);
						}
					}
				});
			});
			
			$("#guardarjl").click(function(e){
				e.preventDefault();
				if ($("#form-local")[0].checkValidity()){
					hideErrors();
					
					var jugador = $('#jugador_local').val();
					var id_equipo_local = $('#id_equipo_local').val();
					var id_partido = $('#id_partido').val();
					var puntaje = $('#puntaje_local').val();
					var posicion = $('#posicion_local').val();
					var titular = $("input[name='titular_local']:checked").val();
				    
					
					$.ajax({
						type: 'get',
						url: 'includes/cargar-jugador.php',
						data: 'ajax=1&id_partido=' + id_partido + '&id_equipo=' + id_equipo_local + '&id_jugador=' + jugador
						+ '&puntaje=' + puntaje + '&posicion=' + posicion + '&titular=' + titular,
						success: function(data) {
							
							var res = $.parseJSON(data);
							if (res.error==false){
								$('#guardado_jugador').show().delay(5000).fadeOut();
								
								$.ajax({
									type: 'get',
									url: 'includes/get-jugador.php',
									data: 'ajax=1&id_partido=' + id_partido + '&id_jugador=' + jugador,
									success: function(data) {
										
										var res = $.parseJSON(data);
										if (res.error==false){
											
											var t = $('#tabla-jugadores-partido').DataTable();
											var nombre_club = $('#nombre_local').val();
											if (res.titular==1){
												var titular = '<span id="make" style="display:none;">SI</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a>';
											}
											else{
												var titular = '<span id="make" style="display:none;">NO</span><a class="btn btn-danger"><i class="halflings-icon white remove"></i></a>';
											}
											t.row.add( [
												res.nombre_jugador,
												res.anio_jugador,
												nombre_club,
												titular,
												' <input type="number" id="puntaje-'+ jugador +'"  class="input-mini focused" min=0 max=10 value="'+ res.puntaje +'"> ' +
												' <span style="display:none;">SI</span><a class="btn btn-info change-puntaje"><i class="halflings-icon white check"></i></a> ' ,
												' <input type="number" id="posicion-'+ jugador +'"  class="input-mini focused" min=0 max=10 value="'+ res.posicion +'"> ' +
												' <span style="display:none;">SI</span><a class="btn btn-info change-posicion"><i class="halflings-icon white check"></i></a> ' ,
												' <a class="btn btn-info" href="editar-jugador.php?id=' + jugador + '"> ' +
													' <i class="halflings-icon white pencil"></i>  ' +
												' </a> ' +
												' <a class="btn btn-danger del-jugador" id="new"  href="#"> ' + 
													' <i class="halflings-icon white trash"></i> ' + 
												' </a> '
											] ).draw();
											
											var link = $('#new');
											//obtengo su tr
											var tr = link.closest('tr');
											//le asigno el id
											tr.attr('id', 'record-' + jugador + '-'+ id_equipo_local + '-' + titular + '-' + posicion);
											//le quito el id al link
											link.attr('id', '');
											
											var make = $('#make');
											var td = make.closest('td');
											if (res.titular==1){
												td.attr('class', 'make-suplente');
											}
											else{
												td.attr('class', 'make-titular');
											}
											make.attr('id', '');
										}
									}
								});
								
								
							}
							else{	
								$('#error_jugador').show();
								$('#texto-error_jugador').text(res.mensaje_error);
							}
						}
					});
				}
				else{
					$('#error_jugador').show();
					$('#texto-error_jugador').text("Debe serleccionar un jugador");
				}
					
			});
			
			$("#guardarjv").click(function(e){
				e.preventDefault();
				
				if ($("#form-visitante")[0].checkValidity()){
				
					hideErrors();
					
					var jugador = $('#jugador_visitante').val();
					var id_equipo_visitante = $('#id_equipo_visitante').val();
					var id_partido = $('#id_partido').val();
					var puntaje = $('#puntaje_visitante').val();
					var posicion = $('#posicion_visitante').val();
					var titular = $("input[name='titular_visitante']:checked").val();
				    
					
					$.ajax({
						type: 'get',
						url: 'includes/cargar-jugador.php',
						data: 'ajax=1&id_partido=' + id_partido + '&id_equipo=' + id_equipo_visitante + '&id_jugador=' + jugador
						+ '&puntaje=' + puntaje + '&posicion=' + posicion + '&titular=' + titular,
						success: function(data) {
							
							var res = $.parseJSON(data);
							if (res.error==false){
								$('#guardado_jugadorv').show().delay(5000).fadeOut();
								
								$.ajax({
									type: 'get',
									url: 'includes/get-jugador.php',
									data: 'ajax=1&id_partido=' + id_partido + '&id_jugador=' + jugador,
									success: function(data) {
										
										var res = $.parseJSON(data);
										if (res.error==false){
											
											var t = $('#tabla-jugadores-partido').DataTable();
											var nombre_club = $('#nombre_visitante').val();
											if (res.titular==1){
												var titular = '<span id="make" style="display:none;">SI</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a>';
											}
											else{
												var titular = '<span id="make" style="display:none;">NO</span><a class="btn btn-danger"><i class="halflings-icon white remove"></i></a>';
											}
											t.row.add( [
												res.nombre_jugador,
												res.anio_jugador,
												nombre_club,
												titular,
												' <input type="number" id="puntaje-'+ jugador +'"  class="input-mini focused" min=0 max=10 value="'+ res.puntaje +'"> ' +
												' <span style="display:none;">SI</span><a class="btn btn-info change-puntaje"><i class="halflings-icon white check"></i></a> ' ,
												' <input type="number" id="posicion-'+ jugador +'"  class="input-mini focused" min=0 max=10 value="'+ res.posicion +'"> ' +
												' <span style="display:none;">SI</span><a class="btn btn-info change-posicion"><i class="halflings-icon white check"></i></a> ' ,
												' <a class="btn btn-info" href="editar-jugador.php?id=' + jugador + '"> ' +
													' <i class="halflings-icon white pencil"></i>  ' +
												' </a> ' +
												' <a class="btn btn-danger del-jugador" id="new"  href="#"> ' + 
													' <i class="halflings-icon white trash"></i> ' + 
												' </a> '
											] ).draw();
											
											var link = $('#new');
											//obtengo su tr
											var tr = link.closest('tr');
											//le asigno el id
											tr.attr('id', 'record-' + jugador + '-'+ id_equipo_visitante + '-' + titular + '-' + posicion);
											//le quito el id al link
											link.attr('id', '');
											
											var make = $('#make');
											var td = make.closest('td');
											if (res.titular==1){
												td.attr('class', 'make-suplente');
											}
											else{
												td.attr('class', 'make-titular');
											}
											make.attr('id', '');
										}
									}
								});
							}
							else{	
								$('#error_jugadorv').show();
								$('#texto-error_jugadorv').text(res.mensaje_error);
							}
						}
					});
				}
				else{
					$('#error_jugadorv').show();
					$('#texto-error_jugadorv').text("Debe seleccionar un jugador");
				}
						
					
			});
			
			$("#guardarconf").click(function(e){
				e.preventDefault();
					hideErrors();
					
					var id_partido = $('#id_partido').val();
					var conf_local = $("input[name='configuracion_local']:checked").val();
					var conf_visitante = $("input[name='configuracion_visitante']:checked").val();
				    
					
					$.ajax({
						type: 'get',
						url: 'includes/cargar-configuracion.php',
						data: 'ajax=1&id_partido=' + id_partido + '&conf_local=' + conf_local + '&conf_visitante=' + conf_visitante,
						success: function(data) {
							
							var res = $.parseJSON(data);
							if (res.error==false){
								$('#guardado_conf').show().delay(5000).fadeOut();
							}
							else{	
								$('#error_conf').show();
								$('#texto-error_conf').text(res.mensaje_error);
							}
						}
					});					
					
			});
			
			
			// $('a.del-jugador').click(function(e) {
			$( '#tabla-jugadores-partido' ).on( 'click', 'a.del-jugador', function(e) {
				e.preventDefault();
				if (confirm("Esta seguro que desea eliminar el jugador del partido?")){
					var parent = $(this).closest('tr');
					var table = $('#tabla-jugadores-partido').DataTable();
					$("#"+parent.attr('id')).removeClass("odd");
					$("#"+parent.attr('id')).removeClass("even");
					$("#"+parent.attr('id')).addClass("selected");
					var id_partido = $('#id_partido').val();
					var datos =  parent.attr('id').split("-");
					var id_jugador = datos[1];
					
					$.ajax({
						type: 'get',
						url: 'includes/delete-jugador-partido.php',
						data: 'ajax=1&id_jugador=' + id_jugador + '&id_partido=' + id_partido,
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.deleted==true){
							  table.row('.selected').remove().draw( false );
							  $('#texto-jugadores').text("Jugador eliminado con exito");
							  $('#guardado_jugadores').show().delay(5000).fadeOut();
							  
							}
							else{	
								$('#texto-error_jugadores').text(res.razon);
								$('#error_jugadores').show().delay(5000).fadeOut();
							}
						}
					});
				}
			});
			
			
			$('#tabla-jugadores-partido tbody').on( 'click', 'td.make-titular', function (e) {
				e.preventDefault();
				
				
				var id_partido = $('#id_partido').val();
				var parent = $(this).closest('tr');
				var td = $(this).closest('td');
				var table = $('#tabla-jugadores-partido').DataTable();
				var cell = table.cell( this );
				var datos =  parent.attr('id').split("-");
				var id_jugador = datos[1];
				var id_equipo = datos[2];
				var posicion = datos[4];
				
 				$.ajax({
 					type: 'get',
 					url: 'includes/make-titular.php',
 					data: 'ajax=1&id_jugador=' + id_jugador + '&id_partido=' + id_partido + '&id_equipo=' + id_equipo + '&posicion=' + posicion,
 					success: function(data) {
 						var res = $.parseJSON(data);
 						if (res.modificado==true){
							cell.data('<span style="display:none;">SI</span><a class="btn btn-success"><i class="halflings-icon white ok"></i></a>').draw();
							td.removeClass("make-titular");
							td.addClass("make-suplente");
							//como cambio la titularidad debo cambiar el id
							var nuevo_id = datos[0] + '-' + datos[1] + '-' + datos[2] + '-1-' + datos[4];
							parent.attr('id',nuevo_id);
 						}
 						else{	
							$('#texto-error_jugadores').text("El registro no puede ser modificado. "+res.razon);
							$('#error_jugadores').show().delay(5000).fadeOut();
 						}
 					}
 				});
			});
			
			$('#tabla-jugadores-partido tbody').on( 'click', 'td.make-suplente', function (e) {
				e.preventDefault();
				
				
				var id_partido = $('#id_partido').val();
				var parent = $(this).closest('tr');
				var td = $(this).closest('td');
				var table = $('#tabla-jugadores-partido').DataTable();
				var cell = table.cell( this );
				var datos =  parent.attr('id').split("-");
				var id_jugador = datos[1];
				
 				$.ajax({
 					type: 'get',
 					url: 'includes/make-suplente.php',
 					data: 'ajax=1&id_jugador=' + id_jugador + '&id_partido=' + id_partido,
 					success: function(data) {
 						var res = $.parseJSON(data);
 						if (res.modificado==true){
							cell.data('<span style="display:none;">NO</span><a class="btn btn-danger"><i class="halflings-icon white remove"></i></a>').draw();
							
							td.removeClass("make-suplente");
							td.addClass("make-titular");
							//como cambio la titularidad debo cambiar el id
							var nuevo_id = datos[0] + '-' + datos[1] + '-' + datos[2] + '-0-' + datos[4];
							parent.attr('id',nuevo_id);
							
 						}
 						else{	
 							$('#texto-error_jugadores').text("El registro no pudo ser modificado");
							$('#error_jugadores').show().delay(5000).fadeOut();
 						}
 					}
 				});
			});
			
			// $('a.change-posicion').click(function(e) {
			$( '#tabla-jugadores-partido' ).on( 'click', 'a.change-posicion', function(e) {
				e.preventDefault();
				var parent = $(this).closest('tr');
				var datos =  parent.attr('id').split("-");
				var id_jugador = datos[1];
				var id_partido = $('#id_partido').val();
				var posicion = $('#posicion-' + id_jugador).val();
				var id_equipo = datos[2];
				var titular = datos[3];
				
				$.ajax({
					type: 'get',
					url: 'includes/change-posicion.php',
					data: 'ajax=1&id_jugador=' + id_jugador + '&id_partido=' + id_partido + '&posicion=' + posicion + '&id_equipo=' + id_equipo + '&titular=' + titular,
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.modificado==false){
							$('#texto-error_jugadores').text("No puede realizar esa modificacion. "+res.razon);
							$('#error_jugadores').show().delay(5000).fadeOut();
						}
						else{
						    //como cambio la posicion, cambia el id
						    var nuevo_id = datos[0] + '-' + datos[1] + '-' + datos[2] + '-' + datos[3] + '-' + posicion;
						    parent.attr('id',nuevo_id);
						}
						
					}
				});
			});
			
			// $('a.change-puntaje').click(function(e) {
			$( '#tabla-jugadores-partido' ).on( 'click', 'a.change-puntaje', function(e) {
				e.preventDefault();
				var parent = $(this).closest('tr');
				var datos =  parent.attr('id').split("-");
				var id_jugador = datos[1];
				var id_partido = $('#id_partido').val();
				var puntaje = $('#puntaje-' + id_jugador).val();
				
				$.ajax({
					type: 'get',
					url: 'includes/change-puntaje.php',
					data: 'ajax=1&id_jugador=' + id_jugador + '&id_partido=' + id_partido + '&puntaje=' + puntaje,
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.modificado==false){
							$('#texto-error_jugadores').text("Se produjo un error, intente refrescando la pagina");
							$('#error_jugadores').show().delay(5000).fadeOut();
						}
						
					}
				});
			});
			
			$("#equipo_gol").change(function(){
				
				$.getJSON("includes/select_jugadores.php",{id: $(this).val(),id_equipo_local: $('#id_equipo_local').val(),id_equipo_visitante: $('#id_equipo_visitante').val(),id_partido: $('#id_partido').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + ' " >' + j[i].nombre + '</option>';
				}
				$("select#jugador_gol").html(options);
				$("#jugador_gol").trigger('liszt:updated');

				});
			});

			
 			$("#guardargol").click(function(e){   
				e.preventDefault();
				if ($("#form_goles")[0].checkValidity()){
					hideErrors();

					var id_partido = $('#id_partido').val();
					var equipo = $("#equipo_gol").val();
					var jugador = $("#jugador_gol").val();
					var hora = $("#hora_gol").val();
					var contra = 0;
					var contra_texto = "NO";
					if ($('#contra').is(':checked')){
						contra = 1;
						contra_texto = "<span class='label label-important'>SI</span>";
					}
					
					
					$.ajax({
						type: 'get',
						url: 'includes/guardar-gol.php',
						data: 'ajax=1&id_partido=' + id_partido + '&equipo=' + equipo + '&jugador=' + jugador + '&hora=' + hora + '&contra=' + contra,
						success: function(data) {
							
							var res = $.parseJSON(data);
							if (res.error==false){
								$('#guardado_gol').show().delay(5000).fadeOut();
								
								var t = $('#tabla-goles').DataTable();
								var nombre_club = $("#equipo_gol option:selected").text();
								var nombre_jugador = $("#jugador_gol option:selected").text();
								var hora = $("#hora_gol").val();
								t.row.add( [
									nombre_jugador,
									nombre_club,
									hora,
									contra_texto,
									'<a class="btn btn-danger delete-gol" id="new" href="#"> ' +
										'<i class="halflings-icon white trash"></i> ' +
									'</a>'
								] ).draw();
								
								var link = $('#new');
								//obtengo su tr
								var tr = link.closest('tr');
								//le asigno el id
								tr.attr('id', 'record-' + res.id_gol);
								//le quito el id al link
								link.attr('id', '');
								
								//limpiamos los campos
								$("#hora_gol").val("");
								$( "#contra" ).prop( "checked", false );
								$.uniform.update('#contra');
								
							}
							else{	
								$('#error_gol').show();
								$('#texto-error_gol').text(res.mensaje_error);
							}
						}
					});
				}
				else{
					$('#error_gol').show();
					$('#texto-error_gol').text("Debe seleccoionar un jugador y una hora valida");
				}
				
					
			});
			
			$( '#tabla-goles' ).on( 'click', 'a.delete-gol', function(e) {
			//$('a.delete-gol').click(function(e) {
				e.preventDefault();
				if (confirm("Esta seguro que desea eliminar el gol del partido?")){
					var parent = $(this).closest('tr');
					var id_partido = $('#id_partido').val();
					var table = $('#tabla-goles').DataTable();
					$("#"+parent.attr('id')).removeClass("odd");
					$("#"+parent.attr('id')).removeClass("even");
					$("#"+parent.attr('id')).addClass("selected");
					
					$.ajax({
						type: 'get',
						url: 'includes/delete-gol.php',
						data: 'ajax=1&id_gol=' + parent.attr('id').replace('record-','') + '&id_partido=' + id_partido,
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.deleted==true){
							  table.row('.selected').remove().draw( false );
							  $('#texto-goles2').text("Gol eliminado con exito");
							  $('#guardado_goles2').show().delay(5000).fadeOut();
							  
							}
							else{	
								$('#texto-error_goles2').text(res.razon);
								$('#error_goles2').show().delay(5000).fadeOut();
							}
						}
					});
				}
			});
			
			
			$("#equipo_penal").change(function(){
				
				$.getJSON("includes/select_jugadores.php",{id: $(this).val(),id_equipo_local: $('#id_equipo_local').val(),id_equipo_visitante: $('#id_equipo_visitante').val(),id_partido: $('#id_partido').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + ' " >' + j[i].nombre + '</option>';
				}
				$("select#jugador_penal").html(options);
				$("#jugador_penal").trigger('liszt:updated');

				});
			});

			
 			$("#guardarpenal").click(function(e){   
				e.preventDefault();
				if ($("#form_penales")[0].checkValidity()){
					hideErrors();

					var id_partido = $('#id_partido').val();
					var equipo = $("#equipo_penal").val();
					var jugador = $("#jugador_penal").val();
					var hora = $("#hora_penal").val();
					var contra = 0;
					
					
					
					$.ajax({
						type: 'get',
						url: 'includes/guardar-penal.php',
						data: 'ajax=1&id_partido=' + id_partido + '&equipo=' + equipo + '&jugador=' + jugador + '&hora=' + hora ,
						success: function(data) {
							
							var res = $.parseJSON(data);
							if (res.error==false){
								$('#guardado_penal').show().delay(5000).fadeOut();
								
								var t = $('#tabla-penales').DataTable();
								var nombre_club = $("#equipo_penal option:selected").text();
								var nombre_jugador = $("#jugador_penal option:selected").text();
								var hora = $("#hora_penal").val();
								t.row.add( [
									nombre_jugador,
									nombre_club,
									hora,
									'<a class="btn btn-danger delete-penal" id="new" href="#"> ' +
										'<i class="halflings-icon white trash"></i> ' +
									'</a>'
								] ).draw();
								
								var link = $('#new');
								//obtengo su tr
								var tr = link.closest('tr');
								//le asigno el id
								tr.attr('id', 'record-' + res.id_penal);
								//le quito el id al link
								link.attr('id', '');
								
								//limpiamos los campos
								$("#hora_penal").val("");
								
							}
							else{	
								$('#error_penal').show();
								$('#texto-error_penal').text(res.mensaje_error);
							}
						}
					});
				}
				else{
					$('#error_penal').show();
					$('#texto-error_penal').text("Debe seleccoionar un jugador y una hora valida");
				}
				
					
			});
			
			$( '#tabla-penales' ).on( 'click', 'a.delete-penal', function(e) {
			//$('a.delete-penal').click(function(e) {
				e.preventDefault();
				if (confirm("Esta seguro que desea eliminar el penal del partido?")){
					var parent = $(this).closest('tr');
					var id_partido = $('#id_partido').val();
					var table = $('#tabla-penales').DataTable();
					$("#"+parent.attr('id')).removeClass("odd");
					$("#"+parent.attr('id')).removeClass("even");
					$("#"+parent.attr('id')).addClass("selected");
					
					$.ajax({
						type: 'get',
						url: 'includes/delete-penal.php',
						data: 'ajax=1&id_penal=' + parent.attr('id').replace('record-','') + '&id_partido=' + id_partido,
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.deleted==true){
							  table.row('.selected').remove().draw( false );
							  $('#texto-penales2').text("Penal eliminado con exito");
							  $('#guardado_penales2').show().delay(5000).fadeOut();
							  
							}
							else{	
								$('#texto-error_penales2').text(res.razon);
								$('#error_penales2').show().delay(5000).fadeOut();
							}
						}
					});
				}
			});
			
			
			$("#equipo_amonestacion").change(function(){
				
				$.getJSON("includes/select_jugadores.php",{id: $(this).val(),id_equipo_local: $('#id_equipo_local').val(),id_equipo_visitante: $('#id_equipo_visitante').val(),id_partido: $('#id_partido').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + ' " >' + j[i].nombre + '</option>';
				}
				$("select#jugador_amonestacion").html(options);
				$("#jugador_amonestacion").trigger('liszt:updated');

				});
			});

			
			$("#guardaramonestacion").click(function(e){   
				e.preventDefault();
				if ($("#form_amonestaciones")[0].checkValidity()){
					hideErrors();
					
					var id_partido = $('#id_partido').val();
					var equipo = $("#equipo_amonestacion").val();
					var jugador = $("#jugador_amonestacion").val();
					var hora = $("#hora_amonestacion").val();
					var tarjeta = $("input[name='tarjeta']:checked").val();
					
					
					$.ajax({
						type: 'get',
						url: 'includes/guardar-amonestacion.php',
						data: 'ajax=1&id_partido=' + id_partido + '&equipo=' + equipo + '&jugador=' + jugador + '&hora=' + hora + '&tarjeta=' + tarjeta,
						success: function(data) {
							
							var res = $.parseJSON(data);
							if (res.error==false){
								$('#guardado_amonestacion').show().delay(5000).fadeOut();
								
								var t = $('#tabla-amonestaciones').DataTable();
								var nombre_club = $("#equipo_amonestacion option:selected").text();
								var nombre_jugador = $("#jugador_amonestacion option:selected").text();
								var hora = $("#hora_amonestacion").val();
								var radio_tarjeta = $("input[name='tarjeta']:checked").val();
								var tarjeta = "Amarilla";
								if (radio_tarjeta==1){
								    tarjeta="Roja";
								}
								t.row.add( [
									nombre_jugador,
									nombre_club,
									hora,
									tarjeta,
									'<a class="btn btn-danger delete-amonestacion" id="new" href="#"> ' +
										'<i class="halflings-icon white trash"></i> ' +
									'</a>'
								] ).draw();
								
								var link = $('#new');
								//obtengo su tr
								var tr = link.closest('tr');
								//le asigno el id
								tr.attr('id', 'record-' + res.id_amonestacion);
								//le quito el id al link
								link.attr('id', '');
								
								//limpiamos los campos
								$("#hora_amonestacion").val("");
								$("#roja").prop("checked", false);
								$.uniform.update('#roja');
								$("#amarilla").prop("checked", true);
								$.uniform.update('#amarilla');
								
								
							}
							else{	
								$('#error_amonestacion').show();
								$('#texto-error_amonestacion').text(res.mensaje_error);
							}
						}
					});
				}
				else{
					$('#error_amonestacion').show();
					$('#texto-error_amonestacion').text("Debe seleccoionar un jugador y una hora valida");
				}
				
					
			});
			
			$( '#tabla-amonestaciones' ).on( 'click', 'a.delete-amonestacion', function(e) {
			//$('a.delete-gol').click(function(e) {
				e.preventDefault();
				if (confirm("Esta seguro que desea eliminar al amonestacion del partido?")){
					var parent = $(this).closest('tr');
					var id_partido = $('#id_partido').val();
					var table = $('#tabla-amonestaciones').DataTable();
					$("#"+parent.attr('id')).removeClass("odd");
					$("#"+parent.attr('id')).removeClass("even");
					$("#"+parent.attr('id')).addClass("selected");
					
					$.ajax({
						type: 'get',
						url: 'includes/delete-amonestacion.php',
						data: 'ajax=1&id_amonestacion=' + parent.attr('id').replace('record-','') + '&id_partido=' + id_partido,
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.deleted==true){
							  table.row('.selected').remove().draw( false );
							  $('#texto-amonestacion2').text("Amonestacion eliminada con exito");
							  $('#guardado_amonestaciones2').show().delay(5000).fadeOut();
							  
							}
							else{	
								$('#texto-error_amonestaciones2').text(res.razon);
								$('#error_amonestaciones2').show().delay(5000).fadeOut();
							}
						}
					});
				}
			});
			
		});
	</script>
	
</body>
</html>
