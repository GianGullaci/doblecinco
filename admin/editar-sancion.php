<?php
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	if (isset($_POST['guardar']) ){
		include_once("includes/coneccion.php");
		
		if (isset($_POST['club'])){
			
			
			$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
			
			$consulta = 'UPDATE sanciones_equipos_torneo SET
			sanciones_id_club = '.$_POST['club'].',
			sanciones_id_categoria = '.$_POST['categoria'].', 
			sanciones_id_torneo='.$_POST['torneo'].' ,
			sanciones_id_equipo='.$_POST['equipo'].' ,
			sanciones_id_fase='.$_POST['fase'].' ,
			puntos_sancion='.$_POST['puntos'].' ,
			comentarios_sancion="'.$_POST['comentarios'].'"
			WHERE id_sancion='.$_GET['id'];
			  //echo $consulta;
			$sentencia = $mysqli->prepare($consulta);
			$sentencia->execute();
			$id = $_GET['id'];
			
		}
	}
	
	include("head.php");
	include_once("includes/coneccion.php");
	
	$query = "SELECT * FROM sanciones_equipos_torneo where id_sancion=".$_GET['id'];
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$id_sancion = $row['id_sancion'];
		$club = $row['sanciones_id_club'];
		$categoria = $row['sanciones_id_categoria'];
		$equipo = $row['sanciones_id_equipo'];
		$fase = $row['sanciones_id_fase'];
		$torneo = $row['sanciones_id_torneo'];
		$puntos = $row['puntos_sancion'];
		$descripcion = $row['comentarios_sancion'];
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
					<a href="listado-sanciones.php">Sanciones</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Sanción</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="?id=<?=$id_sancion?>"  method="post" enctype="multipart/form-data">
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
								<label class="control-label">Fase</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios1" value="1" <?php if ($fase==1) { echo 'checked=""'; }?> >
									Fase 1
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios2" value="2" <?php if ($fase==2) { echo 'checked=""'; }?> >
									Fase 2
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios3" value="3" <?php if ($fase==3) { echo 'checked=""'; }?> >
									Fase 3 (Semifinal)
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios4" value="4" <?php if ($fase==4) { echo 'checked=""'; }?> >
									Fase 4 (Final)
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios5" value="5" <?php if ($fase==5) { echo 'checked=""'; }?> >
									Fase 5 (Finalisima)
								  </label>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label">Fase (INFANTILES)</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios6" value="6"  <?php if ($fase==6) { echo 'checked=""'; }?> >
									Fase 1
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios7" value="7" <?php if ($fase==7) { echo 'checked=""'; }?> >
									<!--Fase 2: Torneo Apertura-->
									Fase 2
								  </label>
								  <!--<div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios8" value="8" <?php if ($fase==8) { echo 'checked=""'; }?> >
									Fase 2: Torneo Clausura
								  </label>-->
								<div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="fase" id="optionsRadios9" value="9" <?php if ($fase==9) { echo 'checked=""'; }?> >
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
										select_clubes($mysqli,$club);
									?>
								  </select>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="categoria">Categoria</label>
								<div class="controls">
								  <select id="categoria" name="categoria" data-rel="chosen">
									<?php
										select_categorias($mysqli,$categoria);
									?>
								  </select>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="categoria">Equipo</label>
								<div class="controls">
								  <select id="equipo" name="equipo" data-rel="chosen">
									
								  </select>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="puntos">Puntos</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="puntos" name="puntos" type="text" value="<?=$puntos?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="comentarios">Comentarios</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="comentarios" name="comentarios" type="text" value="<?=$descripcion?>">
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
					options += '<option value="' + j[i].id + '"';
					if (j[i].id==<?=$equipo?>){
					    options += ' selected ';
					}
					options += '>' + j[i].nombre + '</option>';
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
