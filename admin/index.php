<?php		include("head.php");	?>

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
					<a href="#">inicio</a> 
					<i class="icon-angle-right"></i>
				</li>
				<!-- <li><a href="#">Dashboard</a></li> -->
			</ul>

			
			<div class="row-fluid">	

				<a class="quick-button metro yellow span2">
					<i class="icon-group"></i>
					<p>Usuarios</p>
					<span class="badge">237</span>
				</a>
				<a class="quick-button metro blue span2" href="listado-comentarios.php">
					<i class="icon-comments-alt"></i>
					<p>Comentarios sin activar</p>
					<?php
						$query = "SELECT count(*) as cant FROM comentarios
						where leido=0 and activo=0" ;
						// echo $query;
						$result = $mysqli->query($query); 
						$i=1;
						$count=0;
						if($row = mysqli_fetch_array($result)) {
							$count=$row['cant'];
						}
					?>
					<span class="badge"><?=$count?></span>
				</a>
				<!-- <a class="quick-button metro red span2">
					<i class="icon-shopping-cart"></i>
					<p>Orders</p>
					<span class="badge">13</span>
				</a>
				<a class="quick-button metro black span2">
					<i class="icon-barcode"></i>
					<p>Products</p>
				</a> -->
				<!--<a class="quick-button metro pink span2">
					<i class="icon-envelope"></i>
					<p>Mensajes</p>
					<span class="badge">88</span>
				</a>-->
				<a class="quick-button metro green span2">
					<i class="icon-calendar"></i>
					<p>Partidos Jugados</p>
				</a>
				
				<div class="clearfix"></div>
								
			</div><!--/row-->
			
       

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	
	
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
</body>
</html>
