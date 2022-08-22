<?php
	if (isset($_POST['guardar'])){

		include_once("includes/coneccion.php");

		$psw=md5($_POST['password']);
		$consulta = 'INSERT INTO administradores (nombre, nombre_usuario, password) 
		VALUES 
		("'.$_POST['nombre'].'","'.$_POST['email'].'","'.$psw.'")';
// 		 echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		if (!$sentencia->execute()){
		  $msj="Email en uso";
		}
		else{
		  $id = mysqli_insert_id($mysqli);
		  header("Location: listado-admins.php");
		}
		
	}
	include("head.php");
	

?>


<body>
	<script language='javascript' type='text/javascript'>
		function check(input) {
			if (input.value != document.getElementById('password').value) {
				input.setCustomValidity('Las claves no coinciden');
			} 
			else {
				input.setCustomValidity('');
			}
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
					<a href="listado-admins.php">Administradores</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Cargar Administrador</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post" >
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="nombre">Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="nombre" name="nombre" type="text" value="<?=$_POST['nombre']?>">
								  
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="email">E-mail</label>
								<div class="controls">
								  <input class="input-xlarge focused" required maxlength="100" id="email" name="email" type="email" value="<?=$_POST['email']?>">
								  <?=$msj?>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="password">Clave</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="password" name="password" type="text" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="password2">Repetir Clave</label>
								<div class="controls">
								  <input class="input-xlarge focused" required id="password2" name="password2" type="text" value="" oninput="check(this)">
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
