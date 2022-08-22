<?php 		include("head.php"); ?>

<?php
	if (!isset($_GET['id'])){
	  die ("Olvido el id");
	}
	include_once("includes/coneccion.php");
	
	if (isset($_POST['guardar'])){
		$fecha = "NULL";
		
		$consulta = 'UPDATE equipos SET
		personal_id_personal= '.$_POST['personal'].',
		personal_id_personal1= '.$_POST['personal1'].', 
		personal_id_personal2= '.$_POST['personal2'].', 
		galerias_id_galeria= '.$_POST['galeria'].', 
		nombre_equipo= "'.$_POST['nombre'].'",  
		face_album= "'.$_POST['face_album'].'", 
		flickr_album= "'.$_POST['flickr_album'].'"
		WHERE id_equipo='.$_GET['id'];
		  //echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = $_GET['id'];
		
		
		
		
	}
	
	
	$query = "SELECT id_equipo, nombre_club, nombre_categoria, personal_id_personal, 
	personal_id_personal1, personal_id_personal2, equipos.galerias_id_galeria as galerias_id_galeria, 
	clubes_id_club, nombre_equipo, equipos.face_album as face_album, equipos.flickr_album as flickr_album 
	FROM equipos 
	left join clubes on clubes.id_club=equipos.clubes_id_club
	left join categorias on categorias.id_categoria=equipos.categorias_id_categoria
	where id_equipo=".$_GET['id'] or die("Error in the consult.." . mysqli_error($mysqli));
// 	echo $query;
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)) {
		$id_equipo = $row['id_equipo'];
		$nombre_club = ucfirst($row['nombre_club']);
		$nombre_categoria = ucfirst($row['nombre_categoria']);
		$personal = $row['personal_id_personal'];
		$personal1 = $row['personal_id_personal1'];
		$personal2 = $row['personal_id_personal2'];
		$galeria = $row['galerias_id_galeria'];
		$id_club = $row['clubes_id_club'];
		$nombre_equipo=$row['nombre_equipo'];
		$face_album=$row['face_album'];
		$flickr_album=$row['flickr_album'];
		if ($nombre_equipo==""){
		    $nombre_equipo=$row['nombre_club'];
		}
		
	}
	else{
	  die("id incorrecto");
	}
?>


<body>
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
					<a href="listado-equipos.php">Equipos</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Equipo</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?id=<?=$id_equipo?>" method="post" enctype="multipart/form-data">
						  <fieldset>
							
							<div class="control-group">
								<label class="control-label" for="club">Club</label>
								<div class="controls">
								  <input class="input-xlarge" disabled id="club" name="club" type="text" value="<?=$nombre_club?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="nombre">Nombre Equipos</label>
								<div class="controls">
								  <input class="input-xlarge" id="nombre" name="nombre" type="text" value="<?=$nombre_equipo?>">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="categoria">Categor&iacute;a Deportiva</label>
								<div class="controls">
								  <input class="input-xlarge" disabled id="categoria" name="categoria" type="text" value="<?=$nombre_categoria?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="personal">DT</label>
								<div class="controls">
								  <select id="personal" name="personal" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
									    select_personal($mysqli,$personal,$id_club);
									?>
								  </select>
								</div>
							  </div>  
							
							<div class="control-group">
								<label class="control-label" for="personal1">Preparador F&iacute;sico</label>
								<div class="controls">
								   <select id="personal1" name="personal1" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
									    select_personal($mysqli,$personal1,$id_club);
									?>
								  </select>
								</div>
							  </div>  
							  <div class="control-group">
								<label class="control-label" for="personal2">Ayudante</label>
								<div class="controls">
								  <select id="personal2" name="personal2" data-rel="chosen">
									<option value="0">A definir</option>
									<?php
									    select_personal($mysqli,$personal2,$id_club);
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
									    select_galerias($mysqli,$galeria);
									?>
								  </select>
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
							  
							<div class="form-actions">
							  <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
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
