<?php
 $mysqli = new mysqli("localhost", "doble5jl_main", "Racing123club", "doble5jl_main");

  /* comprobar la conexión */
  if (mysqli_connect_errno()) {
      printf("Falló la conexión: %s\n", mysqli_connect_error());
      exit();
  }
function showDir( $dir , $subdir = 0 ) {
    if ( !is_dir( $dir ) ) { return false; }

    $scan = scandir( $dir );

    foreach( $scan as $key => $val ) {
        if ( $val[0] == "." ) { continue; }

        if ( is_dir( $dir . "/" . $val ) ) {
            echo "<option value='".$dir . "/" . $val."'>" . str_repeat( "--", $subdir ) . $val . "</option>\n";

            if ( $val[0] !="." ) {
                showDir( $dir . "/" . $val , $subdir + 1 );
            }
        }
    }

    return true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include("head.php");
	?>
		
</head>

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
					<a href="galerias.php">Galer&iacute;s</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Publicar Galería</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							<div class="control-group">
								<label class="control-label" for="focusedInput">T&iacute;tulo / Nombre</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" value="">
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="selectError">Directorios</label>
								<div class="controls">
								  <select id="selectError2" data-rel="chosen">
									<?php
									  showDir("../galerias");
									?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Esta galería aparece en la home</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1"> SI
								  </label>
								  
								</div>
							  </div>
							  
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Descripci&oacute;n</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3"></textarea>
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Guardar</button>
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
