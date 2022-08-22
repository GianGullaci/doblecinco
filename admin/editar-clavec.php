<?php
	if (isset($_POST['guardar'])){

		include_once("includes/coneccion.php");

		$psw=md5($_POST['password']);
		$consulta = 'UPDATE colaboradores SET clave= "'.$psw.'" WHERE id_colaborador='.$_POST['id'];
// 		 echo $consulta;
		$sentencia = $mysqli->prepare($consulta);
		$sentencia->execute();
		$id = mysqli_insert_id($mysqli);
		header("Location: listado-colaboradores.php");
		
	}
	else{
		if (!isset($_GET['id'])){
			die ("Olvido el id");
		}
		else{
		    include_once("includes/coneccion.php");

		    $query = "SELECT * FROM colaboradores where activo=1 and id_colaborador=".$_GET['id'];
// 		    echo $query;
		    $result = $mysqli->query($query); 
		    if (!($row = mysqli_fetch_array($result))) {
		      die ("id dengado");
		    }
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
					<a href="listado-colaboradores.php">Colaboradores</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Editar Clave Colaborador</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" action="?" method="post">
						  <fieldset>
							
							   <div class="control-group">
								<label class="control-label" for="password">Nueva Clave</label>
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
							  <input type="hidden" name="id" value="<?=$_GET['id']?>">

							<div class="form-actions">
							  <button type="submit"  name="guardar" class="btn btn-primary">Guardar</button>
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
