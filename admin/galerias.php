<?php 		include("head.php"); ?>

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
					<a href="listado-notas.php">Notas</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon picture"></i><span class="break"></span>Administrador de Galer&iacute;as</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<i class="halflings-icon info-sign"></i> Administre las carpetas y archivos para hacer uso de las galer&iacute;as en diversas secciones del sitio
						</div>
						<!--<div class="file-manager"></div>-->
						<iframe src="galeriasif.php" style="width: 100%;height: 500px;"></iframe>
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
