<?php
	include("head.php");
	
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	
	include_once("includes/functions.php");
	
	$id_ubicacion = $_GET['id'];
	
	$query = "SELECT *
		FROM ubicaciones_publicidades
		where id_ubicacion=".$id_ubicacion;
		$result = $mysqli->query($query); 
		if ($row = mysqli_fetch_array($result)) {
		
			$nombre=$row['seccion']." - ".$row['nombre_ubicacion'];
		
		}
	
	if (isset($_POST['guardar'])){

		include_once("includes/coneccion.php");

		$consulta = 'DELETE FROM publicidades_posicionadas WHERE ubicaciones_id_ubicacion= '.$id_ubicacion;
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
		
		$param_name = 'publicidad';
		foreach($_POST as $key => $value) {
			if(substr($key, 0, strlen($param_name)) == $param_name) {
				$consulta = 'INSERT INTO publicidades_posicionadas (publicidades_id_publicidad, ubicaciones_id_ubicacion) 
				VALUES 
				('.$value.', '.$id_ubicacion.')';
				//echo $consulta;
				$sentencia = $mysqli->prepare($consulta);
				$sentencia->execute();
			}
		}

		
		//header("Location: listado-posiciones.php");
		
	}
	
	

?>

	

<body>

		<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
		<script src="../editor/sample.js" type="text/javascript"></script>
		<link href="../editor/sample.css" rel="stylesheet" type="text/css" />
		
		
		<script type="text/javascript">
	   
			function crearFila() { //donde num = al i que le corresponde
				document.forms['form_nueva_enc'].resp_count.value = parseInt(document.forms['form_nueva_enc'].resp_count.value) + 1;
				var num = document.forms['form_nueva_enc'].resp_count.value;
				var fieldset_publis = document.getElementById('fieldset_publis');

				
					  
				var div = document.createElement('div');
				div.setAttribute('class', 'control-group');
				fieldset_publis.appendChild(div);
				var label = document.createElement('label');
				label.setAttribute('class', 'control-label');
				label.innerHTML="Asociar Publicidad #"+num;
				div.appendChild(label);
				var div_ctrl = document.createElement('div');
				div_ctrl.setAttribute('class', 'controls');
				div.appendChild(div_ctrl);
										
				//campo nueva
				var unic = 'publicidad'+num;
				//var publicidadInput = document.createElement('input');
				div_ctrl.innerHTML = "<select class='input-xlarge focused' id='publicidad"+num+"' name='publicidad"+num+"' ><?php select_publicidades_no_archivadas($mysqli,0); ?></select>";
// 				publicidadInput.type = 'select';
// 				publicidadInput.setAttribute("name", unic);
// 				publicidadInput.setAttribute("id", unic);
// 				publicidadInput.setAttribute('class', 'input-xlarge focused');
				//div_ctrl.appendChild(publicidadInput);
				
				
				  
			}
		</script>
		
		
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
					<a href="listado-posiciones.php">Listado Posiciones</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Asociar Publicidades: <b><?=$nombre?></b></h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="?id=<?=$id_ubicacion?>" name="form_nueva_enc" id="form_nueva_enc">
						  <fieldset>
							<div id="fieldset_publis">
							<?php
								$i=0;
								$query = "SELECT *
								FROM publicidades_posicionadas
								where ubicaciones_id_ubicacion=".$id_ubicacion;
								$result = $mysqli->query($query); 
								while ($row = mysqli_fetch_array($result)) {
									$i++;
							
							?>
							
							
							
							<div class="control-group" id="pregunta<?=$i?>">
								<label class="control-label" for="focusedInput">Asociar Publicidad #<?=$i?></label>
								<div class="controls">
								  <select class="input-xlarge focused" id="publicidad<?=$i?>" name="publicidad<?=$i?>" >
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
									<label class="control-label" for="focusedInput">Asociar Publicidad #<?=$i?></label>
									<div class="controls">
									  <select class="input-xlarge focused" id="publicidad1" name="publicidad1" >
										  <?php
											  select_publicidades_no_archivadas($mysqli,0);
										  ?>
									  </select>
									</div>
									
								  </div>
							 <?php
							 
								}
							 
							 ?>
							  <!--<p>
								<div id="fieldset_publis">								<p>
								<label>Fechas:</label><input type="text" name="fecha_esp1" id="fecha_esp1" class="text-medium" /> <a href="javascript:crearFila();">Otra Fecha</a><br>								</p>
								</div>
							</p>-->
							
							</div>
							 <div class="control-group" >
								
								<div class="controls">
								  <a href="javascript:crearFila();">Agregar Otra</a>
								</div>
							  </div>
							
							<input type="hidden" name="resp_count" id="resp_count" value="<?=$i?>" />
							<div class="form-actions">
							  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
							  <button type="reset" onclick="window.location.href=window.location.href;" class="btn">Cancelar</button>
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
// 		$('a.btn-danger').click(function(e) {
		$( '#fieldset_publis' ).on( 'click', 'a.delete-publi', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar el registro?")){
				var padre = $(this).closest("div").parent();
				padre.remove();

// 				$.ajax({
// 					type: 'get',
// 					url: 'delete-fecha.php',
// 					data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
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
			}
		});
	});
	</script>
	
	
	
</body>
</html>
