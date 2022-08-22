<?php
	if (isset($_POST['guardar']) or isset($_POST['guardaro']) ){

		include_once("includes/coneccion.php");
		
		$consulta = 'INSERT INTO equipos (clubes_id_club, categorias_id_categoria, personal_id_personal, personal_id_personal1, personal_id_personal2, galerias_id_galeria, 
		nombre_equipo, face_album, flickr_album) 
		VALUES 
		('.$_POST['club'].','.$_POST['categoria'].','.$_POST['personal'].','.$_POST['personal1'].','.$_POST['personal2'].','.$_POST['galeria'].',
		"'.$_POST['nombre'].'","'.$_POST['face_album'].'","'.$_POST['flickr_album'].'")';
		 //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		if (isset($_POST['guardar'])){
		  header("Location: listado-equipos.php");
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
					<a href="listado-equipos.php">Eqipos</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Equipo</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" enctype="multipart/form-data">
						  <fieldset>
							
							
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
								<label class="control-label" for="nombre">Nombre equipo</label>
								<div class="controls">
								  <input class="input-xlarge focused" maxlength="50" id="nombre" name="nombre" required type="text" value="">
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
								<label class="control-label" for="personal">DT</label>
								<div class="controls">
								  <select id="personal" name="personal" data-rel="chosen">
									
								  </select>
								</div>
							  </div>  
							
							<div class="control-group">
								<label class="control-label" for="personal1">Preparador F&iacute;sico</label>
								<div class="controls">
								   <select id="personal1" name="personal1" data-rel="chosen">
									
								  </select>
								</div>
							  </div>  
							  <div class="control-group">
								<label class="control-label" for="personal2">Ayudante</label>
								<div class="controls">
								  <select id="personal2" name="personal2" data-rel="chosen">
									
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
								<label class="control-label" for="flickr_album">Album de Flickr (Formato: https://www.flickr.com/xxxxxx)</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="flickr_album" maxlength="100" name="flickr_album" type="url" value="">
								</div>
							  </div>
							  
							<div class="form-actions">
							  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
							  <button type="submit" name="guardaro" class="btn btn-warning">Guardar y Cargar Otro</button>
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
// 			$("#club").change(function() { 
// 				var club = $('#club').val();
// 				var select_a_cambiar = $('#personal');
// 				
// 				$.ajax({
// 					type: 'get',
// 					url: 'get-personal.php',
// 					data: 'ajax=1&club=' + parent.attr('id').replace('record-',''),
// 					success: function(data) {
// 						var res = $.parseJSON(data);
// 						if (res.deleted==true){
// 						  table.row('.selected').remove().draw( false );
// 						}
// 						else{	
// 						  alert("El registro no puede ser eliminado "+res.razon);
// 						}
// 					}
// 				});
// 			});
			
			    $.getJSON("includes/select_personal.php",{id: $('#club').val(), ajax: 'true'}, function(j){
			      var options = '<option value="0">A definir</option>';
			      for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].id + '">' + j[i].nombre + '</option>';
			      }
			      $("select#personal").html(options);
			      $("#personal").trigger('liszt:updated');
			      
			      $("select#personal1").html(options);
			      $("#personal1").trigger('liszt:updated');
			      
			      $("select#personal2").html(options);
			      $("#personal2").trigger('liszt:updated');
			    });
			    if ($('#nombre').val()==""){
			      $('#nombre').val($("#club option:selected").text());
			  }
			//});
			
			$("select#club").change(function(){
			  //$("#personal").empty();
			  $.getJSON("includes/select_personal.php",{id: $(this).val(), ajax: 'true'}, function(j){
			    var options = '<option value="0">A definir</option>';
			    for (var i = 0; i < j.length; i++) {
			      options += '<option value="' + j[i].id + '">' + j[i].nombre + '</option>';
			    }
			    $("select#personal").html(options);
 			    $("#personal").trigger('liszt:updated');
 			    
 			    $("select#personal1").html(options);
 			    $("#personal1").trigger('liszt:updated');
 			    
 			    $("select#personal2").html(options);
 			    $("#personal2").trigger('liszt:updated');
			  });
			  if ($('#nombre').val()==""){
			      $('#nombre').val($("#club option:selected").text());
			  }
			})
		});
	</script>
	
	
</body>
</html>
