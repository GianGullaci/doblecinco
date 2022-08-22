<?php
	if (isset($_POST['guardar']) ){

		include_once("includes/coneccion.php");
		
		
		
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
		
		$consulta = 'INSERT INTO sanciones_equipos_torneo (sanciones_id_torneo, sanciones_id_fase, comentarios_sancion, sanciones_id_club, sanciones_id_categoria, puntos_sancion, sanciones_id_equipo) 
		VALUES 
		('.$_POST['torneo'].','.$_POST['fase'].',  "'.$_POST['descripcion'].'", '.$_POST['club'].','.$_POST['categoria'].', '.$_POST['puntos'].', '.$_POST['equipo'].')';
// 		 echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		if (isset($_POST['guardar'])){
		  header("Location: listado-sanciones.php");
		}
		
	}
	include("head.php");

	

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
					<a href="listado-sanciones.php">Sanciones</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Sanción</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							
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
								<label class="control-label">Fase (MENORES)</label>
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
								<label class="control-label">Fase (INFANTILES)</label>
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
								<label class="control-label" for="club">Club</label>
								<div class="controls">
								  <select id="club" name="club" data-rel="chosen">
									<?php
										select_clubes($mysqli);
									?>
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="categoria">Categor&iacute;a Deportiva</label>
								<div class="controls">
								  <select id="categoria" name="categoria" data-rel="chosen">
									<?php
									    select_categorias($mysqli);
									?>
								  </select>
								</div>
							  </div>  
							<div class="control-group">
								<label class="control-label" for="club">Equipo</label>
								<div class="controls">
								  <select id="equipo" name="equipo" data-rel="chosen">
									
								  </select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="puntos">Puntos</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="puntos" name="puntos" type="text" value="">
								</div>
							  </div>
							
							  
							  <div class="control-group">
								<label class="control-label" for="descripcion">Comentarios</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="descripcion" name="descripcion" type="text" value="">
								</div>
							  </div>
							  
							
							  
							
							<div class="form-actions">
							  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
							  <button type="reset" onClick="location.href='listado-sanciones.php'"  class="btn">Cancelar</button>
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
			    
			
			$.getJSON("includes/select_equipos.php",{categoria: $('#categoria').val(),ajax: 'true'}, function(j){
				var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].nombre + '</option>';
				}
				$("select#equipo").html(options);
				$("#equipo").trigger('liszt:updated');
				
				
				
				
			});
			
			$("select#categoria").change(function(){
				$.getJSON("includes/select_equipos.php",{categoria: $(this).val(),ajax: 'true'}, function(j){
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].id + '">' + j[i].nombre + '</option>';
					}
					$("select#equipo").html(options);
					$("#equipo").trigger('liszt:updated');
					
				
				})
			});
				
		});
	</script>
	
	
</body>
</html>
