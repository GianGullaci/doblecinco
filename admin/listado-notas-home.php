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
				<li><a href="#">Notas</a></li>
			</ul>
			
			<div class="row-fluid">
				
				<div class="box black span6 noMargin" onTablet="span6" onDesktop="span6">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Bloque 1</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal" id="form_bloque1" style="color:black">
							<fieldset>
								<div class="control-group">
								      <label class="control-label" for="selectError">Nota</label>
								      <div class="controls">
									<select id="nota_bloque1" name="nota_bloque1" data-rel="chosen" required>
									</select>
								      </div>
								</div>
								<!--
							      <div class="control-group">
								      <label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
								      <div class="controls">
									<input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								      </div>
								</div>-->
								
								<div class="alert alert-error" id="error_bloque1" style="display:none;">
								      <strong>Error en la carga</strong> <span id="texto-error_bloque1"></span>
							      </div>
							      <div class="alert alert-success" id="guardado_bloque1" style="display:none;">
								      <strong>Guardada!</strong>La nota ha sido cargada con éxito
							      </div>
							      <div class="form-actions">
								<input type="submit" name="guardarbloque1" id="guardarbloque1" class="btn btn-primary" value="Agregar Nota" />
							      </div>
							</fieldset>
						      </form>   
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas-bloque1" style="color:black">
						  <thead>
							  <tr>
								  <th>Posicion</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Quitar</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
						
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where bloque_home=1 
								order by orden_bloque asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
								
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
						
									echo "<tr id='record-".$row['id_nota']."'>";
									
									echo "<td>".$row['orden_bloque']."</td>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo '<td class="center">
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
						 </tbody>
					  </table>        
					</div>
				</div><!--/span-->
				
				<div class="box black span6 noMargin" onTablet="span6" onDesktop="span6">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Bloque 2</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal" id="form_bloque2" style="color:black">
							<fieldset>
								<div class="control-group">
								      <label class="control-label" for="selectError">Nota</label>
								      <div class="controls">
									<select id="nota_bloque2" name="nota_bloque2" data-rel="chosen" required>
									</select>
								      </div>
								</div>
								<!--
							      <div class="control-group">
								      <label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
								      <div class="controls">
									<input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								      </div>
								</div>-->
								
								<div class="alert alert-error" id="error_bloque2" style="display:none;">
								      <strong>Error en la carga</strong> <span id="texto-error_bloque2"></span>
							      </div>
							      <div class="alert alert-success" id="guardado_bloque2" style="display:none;">
								      <strong>Guardada!</strong>La nota ha sido cargada con éxito
							      </div>
							      <div class="form-actions">
								<input type="submit" name="guardarbloque2" id="guardarbloque2" class="btn btn-primary" value="Agregar Nota" />
							      </div>
							</fieldset>
						      </form>   
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas-bloque2" style="color:black">
						  <thead>
							  <tr>
								  <th>Posicion</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Quitar</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
						
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where bloque_home=2 
								order by orden_bloque asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
								
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
						
									echo "<tr id='record-".$row['id_nota']."'>";
									
									echo "<td>".$row['orden_bloque']."</td>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo '<td class="center">
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
						 </tbody>
					  </table>        
					</div>
				</div><!--/span-->
				
				
			
			</div>
			
			<div class="row-fluid">
				
				<div class="box black span6 noMargin" onTablet="span6" onDesktop="span6">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Bloque 3 (COLUMNAS)</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal" id="form_bloque3" style="color:black">
							<fieldset>
								<div class="control-group">
								      <label class="control-label" for="selectError">Nota</label>
								      <div class="controls">
									<select id="nota_bloque3" name="nota_bloque3" data-rel="chosen" required>
									</select>
								      </div>
								</div>
								<!--
							      <div class="control-group">
								      <label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
								      <div class="controls">
									<input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								      </div>
								</div>-->
								
								<div class="alert alert-error" id="error_bloque3" style="display:none;">
								      <strong>Error en la carga</strong> <span id="texto-error_bloque3"></span>
							      </div>
							      <div class="alert alert-success" id="guardado_bloque3" style="display:none;">
								      <strong>Guardada!</strong>La nota ha sido cargada con éxito
							      </div>
							      <div class="form-actions">
								<input type="submit" name="guardarbloque3" id="guardarbloque3" class="btn btn-primary" value="Agregar Nota" />
							      </div>
							</fieldset>
						      </form>   
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas-bloque3" style="color:black">
						  <thead>
							  <tr>
								  <th>Posicion</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Quitar</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
						
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where bloque_home=3 
								order by orden_bloque asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
								
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
						
									echo "<tr id='record-".$row['id_nota']."'>";
									
									echo "<td>".$row['orden_bloque']."</td>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo '<td class="center">
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
						 </tbody>
					  </table>        
					</div>
				</div><!--/span-->
				
				<div class="box black span6 noMargin" onTablet="span6" onDesktop="span6">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Bloque 4 (FIXTURE)</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal" id="form_bloque4" style="color:black">
							<fieldset>
								<div class="control-group">
								      <label class="control-label" for="selectError">Nota</label>
								      <div class="controls">
									<select id="nota_bloque4" name="nota_bloque4" data-rel="chosen" required>
									</select>
								      </div>
								</div>
								<!--
							      <div class="control-group">
								      <label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
								      <div class="controls">
									<input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								      </div>
								</div>-->
								
								<div class="alert alert-error" id="error_bloque4" style="display:none;">
								      <strong>Error en la carga</strong> <span id="texto-error_bloque4"></span>
							      </div>
							      <div class="alert alert-success" id="guardado_bloque4" style="display:none;">
								      <strong>Guardada!</strong>La nota ha sido cargada con éxito
							      </div>
							      <div class="form-actions">
								<input type="submit" name="guardarbloque4" id="guardarbloque4" class="btn btn-primary" value="Agregar Nota" />
							      </div>
							</fieldset>
						      </form>   
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas-bloque4" style="color:black">
						  <thead>
							  <tr>
								  <th>Posicion</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Quitar</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
						
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where bloque_home=4 
								order by orden_bloque asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
								
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
						
									echo "<tr id='record-".$row['id_nota']."'>";
									
									echo "<td>".$row['orden_bloque']."</td>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo '<td class="center">
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
						 </tbody>
					  </table>        
					</div>
				</div><!--/span-->
				
				
			
			</div>
			
			<div class="row-fluid">
				
				<div class="box black span6 noMargin" onTablet="span6" onDesktop="span6">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Bloque 5 (POSICIONES)</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal" id="form_bloque5" style="color:black">
							<fieldset>
								<div class="control-group">
								      <label class="control-label" for="selectError">Nota</label>
								      <div class="controls">
									<select id="nota_bloque5" name="nota_bloque5" data-rel="chosen" required>
									</select>
								      </div>
								</div>
								<!--
							      <div class="control-group">
								      <label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
								      <div class="controls">
									<input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								      </div>
								</div>-->
								
								<div class="alert alert-error" id="error_bloque5" style="display:none;">
								      <strong>Error en la carga</strong> <span id="texto-error_bloque5"></span>
							      </div>
							      <div class="alert alert-success" id="guardado_bloque5" style="display:none;">
								      <strong>Guardada!</strong>La nota ha sido cargada con éxito
							      </div>
							      <div class="form-actions">
								<input type="submit" name="guardarbloque5" id="guardarbloque5" class="btn btn-primary" value="Agregar Nota" />
							      </div>
							</fieldset>
						      </form>   
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas-bloque5" style="color:black">
						  <thead>
							  <tr>
								  <th>Posicion</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Quitar</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
						
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where bloque_home=5 
								order by orden_bloque asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
								
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
						
									echo "<tr id='record-".$row['id_nota']."'>";
									
									echo "<td>".$row['orden_bloque']."</td>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo '<td class="center">
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
						 </tbody>
					  </table>        
					</div>
				</div><!--/span-->
				
				<div class="box black span6 noMargin" onTablet="span6" onDesktop="span6">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Bloque 6</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal" id="form_bloque6" style="color:black">
							<fieldset>
								<div class="control-group">
								      <label class="control-label" for="selectError">Nota</label>
								      <div class="controls">
									<select id="nota_bloque6" name="nota_bloque6" data-rel="chosen" required>
									</select>
								      </div>
								</div>
								<!--
							      <div class="control-group">
								      <label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
								      <div class="controls">
									<input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								      </div>
								</div>-->
								
								<div class="alert alert-error" id="error_bloque6" style="display:none;">
								      <strong>Error en la carga</strong> <span id="texto-error_bloque6"></span>
							      </div>
							      <div class="alert alert-success" id="guardado_bloque6" style="display:none;">
								      <strong>Guardada!</strong>La nota ha sido cargada con éxito
							      </div>
							      <div class="form-actions">
								<input type="submit" name="guardarbloque6" id="guardarbloque6" class="btn btn-primary" value="Agregar Nota" />
							      </div>
							</fieldset>
						      </form>   
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas-bloque6" style="color:black">
						  <thead>
							  <tr>
								  <th>Posicion</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Quitar</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
						
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where bloque_home=6 
								order by orden_bloque asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
								
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
						
									echo "<tr id='record-".$row['id_nota']."'>";
									
									echo "<td>".$row['orden_bloque']."</td>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo '<td class="center">
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
						 </tbody>
					  </table>        
					</div>
				</div><!--/span-->
				
				
			
			</div>
			
			<div class="row-fluid">
				
				<div class="box black span6 noMargin" onTablet="span6" onDesktop="span6">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Bloque 7</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal" id="form_bloque7" style="color:black">
							<fieldset>
								<div class="control-group">
								      <label class="control-label" for="selectError">Nota</label>
								      <div class="controls">
									<select id="nota_bloque7" name="nota_bloque7" data-rel="chosen" required>
									</select>
								      </div>
								</div>
								<!--
							      <div class="control-group">
								      <label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
								      <div class="controls">
									<input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								      </div>
								</div>-->
								
								<div class="alert alert-error" id="error_bloque7" style="display:none;">
								      <strong>Error en la carga</strong> <span id="texto-error_bloque7"></span>
							      </div>
							      <div class="alert alert-success" id="guardado_bloque7" style="display:none;">
								      <strong>Guardada!</strong>La nota ha sido cargada con éxito
							      </div>
							      <div class="form-actions">
								<input type="submit" name="guardarbloque7" id="guardarbloque7" class="btn btn-primary" value="Agregar Nota" />
							      </div>
							</fieldset>
						      </form>   
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas-bloque7" style="color:black">
						  <thead>
							  <tr>
								  <th>Posicion</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Quitar</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
						
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where bloque_home=7 
								order by orden_bloque asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
								
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
						
									echo "<tr id='record-".$row['id_nota']."'>";
									
									echo "<td>".$row['orden_bloque']."</td>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo '<td class="center">
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
						 </tbody>
					  </table>        
					</div>
				</div><!--/span-->
				
				<div class="box black span6 noMargin" onTablet="span6" onDesktop="span6">
					<div class="box-header">
						<h2><i class="halflings-icon white list"></i><span class="break"></span>Bloque 8</h2>
						<div class="box-icon">
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal" id="form_bloque8" style="color:black">
							<fieldset>
								<div class="control-group">
								      <label class="control-label" for="selectError">Nota</label>
								      <div class="controls">
									<select id="nota_bloque8" name="nota_bloque8" data-rel="chosen" required>
									</select>
								      </div>
								</div>
								<!--
							      <div class="control-group">
								      <label class="control-label" for="hora_amonestacion">Hora (Formato: 99:99)</label>
								      <div class="controls">
									<input class="input-medium focused" id="hora_amonestacion" name="hora_amonestacion" type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" value="">
								      </div>
								</div>-->
								
								<div class="alert alert-error" id="error_bloque8" style="display:none;">
								      <strong>Error en la carga</strong> <span id="texto-error_bloque8"></span>
							      </div>
							      <div class="alert alert-success" id="guardado_bloque8" style="display:none;">
								      <strong>Guardada!</strong>La nota ha sido cargada con éxito
							      </div>
							      <div class="form-actions">
								<input type="submit" name="guardarbloque8" id="guardarbloque8" class="btn btn-primary" value="Agregar Nota" />
							      </div>
							</fieldset>
						      </form>   
						<table class="table table-striped table-bordered bootstrap-datatable " id="tabla-notas-bloque8" style="color:black">
						  <thead>
							  <tr>
								  <th>Posicion</th>
								  <th>Fecha</th>
								  <th>T&iacute;tulo</th>
								  <th>Categor&iacute;a</th>
								  <th>Quitar</th>
							  </tr>
						  </thead>   
						  <tbody>
						  
						
							<?php
								$query = "SELECT * FROM notas 
								left join categorias_notas on notas.categorias_notas_id_categoria_notas=categorias_notas.id_categoria_notas
								left join autores on autores.id_autor=notas.autores_id_autor
								where bloque_home=8 
								order by orden_bloque asc" ;
								// echo $query;
								$result = $mysqli->query($query); 
								$i=1;
								while($row = mysqli_fetch_array($result)) {
								
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
						
									echo "<tr id='record-".$row['id_nota']."'>";
									
									echo "<td>".$row['orden_bloque']."</td>";
									$fecha = date("d-m-Y", strtotime($row['fecha_nota']));
									echo "<td>".$fecha."</td>";
									echo "<td>".substr($row['titulo_nota'],0,85)."</td>";
									echo "<td>".ucfirst($row['nombre_categoria'])."</td>";
									echo '<td class="center">
											<a class="btn btn-danger eliminar" href="#">
												<i class="halflings-icon white trash"></i> 
											</a>
										</td>';
									echo "</tr>";
								}
							?>
						 </tbody>
					  </table>        
					</div>
				</div><!--/span-->
				
				
			
			</div>
	
    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
	
	
	
	<?php
		include("footer.php");
		include("javascript.php");
	?>
	
	<script>
	
	function hideErrors(){
	
		$('#error_bloque1').hide();
		$('#guardado_bloque1').hide();
		
		$('#error_bloque2').hide();
		$('#guardado_bloque2').hide();
		
		$('#error_bloque3').hide();
		$('#guardado_bloque3').hide();
		
		$('#error_bloque4').hide();
		$('#guardado_bloque4').hide();
		
		$('#error_bloque5').hide();
		$('#guardado_bloque5').hide();
		
		$('#error_bloque6').hide();
		$('#guardado_bloque6').hide();
		
		$('#error_bloque7').hide();
		$('#guardado_bloque7').hide();
		
		$('#error_bloque8').hide();
		$('#guardado_bloque8').hide();
		
	}
	
	
	$(document).ready(function() {
	
		$.getJSON("includes/select_notas.php",{ajax: 'true'}, function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].id + ' " >' + j[i].titulo + '</option>';
			}
			$("select#nota_bloque1").html(options);
			$("#nota_bloque1").trigger('liszt:updated');
			$("select#nota_bloque2").html(options);
			$("#nota_bloque2").trigger('liszt:updated');
			$("select#nota_bloque3").html(options);
			$("#nota_bloque3").trigger('liszt:updated');
			$("select#nota_bloque4").html(options);
			$("#nota_bloque4").trigger('liszt:updated');
			$("select#nota_bloque5").html(options);
			$("#nota_bloque5").trigger('liszt:updated');
			$("select#nota_bloque6").html(options);
			$("#nota_bloque6").trigger('liszt:updated');
			$("select#nota_bloque7").html(options);
			$("#nota_bloque7").trigger('liszt:updated');
			$("select#nota_bloque8").html(options);
			$("#nota_bloque8").trigger('liszt:updated');

		});
		
				
		$('#tabla-notas-bloque1').dataTable({
			"sDom": "",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
				{ "orderable": false},
				{ "orderable": false},
 				{ "orderable": false},
				{ "orderable": false}
			]
		});
		
		$('#tabla-notas-bloque2').dataTable({
			"sDom": "",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
				{ "orderable": false},
				{ "orderable": false},
 				{ "orderable": false},
				{ "orderable": false}
			]
		});
		
		$('#tabla-notas-bloque3').dataTable({
			"sDom": "",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
				{ "orderable": false},
				{ "orderable": false},
 				{ "orderable": false},
				{ "orderable": false}
			]
		});
		
		$('#tabla-notas-bloque4').dataTable({
			"sDom": "",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
				{ "orderable": false},
				{ "orderable": false},
 				{ "orderable": false},
				{ "orderable": false}
			]
		});
 		
		$('#tabla-notas-bloque5').dataTable({
			"sDom": "",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
				{ "orderable": false},
				{ "orderable": false},
 				{ "orderable": false},
				{ "orderable": false}
			]
		});
		
		$('#tabla-notas-bloque6').dataTable({
			"sDom": "",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
				{ "orderable": false},
				{ "orderable": false},
 				{ "orderable": false},
				{ "orderable": false}
			]
		});
 		$('#tabla-notas-bloque7').dataTable({
			"sDom": "",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
				{ "orderable": false},
				{ "orderable": false},
 				{ "orderable": false},
				{ "orderable": false}
			]
		});
		
		$('#tabla-notas-bloque8').dataTable({
			"sDom": "",
			"sPaginationType": "bootstrap",
			"oLanguage": {
			"sLengthMenu": "_MENU_ registros por p&aacute;gina"
			},
			"columns": [
				null,
				{ "orderable": false},
				{ "orderable": false},
 				{ "orderable": false},
				{ "orderable": false}
			]
		});
 		
	
		$("#guardarbloque1").click(function(e){
			e.preventDefault();
			if ($("#form_bloque1")[0].checkValidity()){
				hideErrors();
				
				var nota = $("#nota_bloque1").val();
				
				
				$.ajax({
					type: 'get',
					url: 'includes/guardar-bloque.php',
					data: 'ajax=1&bloque=1&nota=' + nota,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error===false){
							$('#guardado_bloque1').show().delay(5000).fadeOut();
							
							var t = $('#tabla-notas-bloque1').DataTable();
							var titulo_nota = $("#nota_bloque1 option:selected").text();
							
							t.row.add( [
 								res.posicion,
								res.fecha,
								titulo_nota,
								res.categoria,
								'<a class="btn btn-danger delete-nota" id="new" href="#"> ' +
									'<i class="halflings-icon white trash"></i> ' +
								'</a>'
							] ).draw();
							
							var link = $('#new');
							//obtengo su tr
							var tr = link.closest('tr');
							//le asigno el id
							tr.attr('id', 'record-' + res.id_nota);
							//le quito el id al link
							link.attr('id', '');

							
							
						}
						else{	
							$('#error_bloque1').show();
							$('#texto-error_bloque1').text(res.mensaje_error);
						}
					}
				});
			}
			else{
				$('#error_bloque1').show();
				$('#texto-error_bloque1').text("Debe seleccionar una nota");
			}
			
				
		});
		
		$("#guardarbloque2").click(function(e){
			e.preventDefault();
			if ($("#form_bloque2")[0].checkValidity()){
				hideErrors();
				
				var nota = $("#nota_bloque2").val();
				
				
				$.ajax({
					type: 'get',
					url: 'includes/guardar-bloque.php',
					data: 'ajax=1&bloque=2&nota=' + nota,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error===false){
							$('#guardado_bloque2').show().delay(5000).fadeOut();
							
							var t = $('#tabla-notas-bloque2').DataTable();
							var titulo_nota = $("#nota_bloque2 option:selected").text();
							
							t.row.add( [
 								res.posicion,
								res.fecha,
								titulo_nota,
								res.categoria,
								'<a class="btn btn-danger delete-nota" id="new" href="#"> ' +
									'<i class="halflings-icon white trash"></i> ' +
								'</a>'
							] ).draw();
							
							var link = $('#new');
							//obtengo su tr
							var tr = link.closest('tr');
							//le asigno el id
							tr.attr('id', 'record-' + res.id_nota);
							//le quito el id al link
							link.attr('id', '');

							
							
						}
						else{	
							$('#error_bloque2').show();
							$('#texto-error_bloque2').text(res.mensaje_error);
						}
					}
				});
			}
			else{
				$('#error_bloque2').show();
				$('#texto-error_bloque2').text("Debe seleccionar una nota");
			}
			
				
		});
		
		$("#guardarbloque3").click(function(e){
			e.preventDefault();
			if ($("#form_bloque3")[0].checkValidity()){
				hideErrors();
				
				var nota = $("#nota_bloque3").val();
				
				
				$.ajax({
					type: 'get',
					url: 'includes/guardar-bloque.php',
					data: 'ajax=1&bloque=3&nota=' + nota,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error===false){
							$('#guardado_bloque3').show().delay(5000).fadeOut();
							
							var t = $('#tabla-notas-bloque3').DataTable();
							var titulo_nota = $("#nota_bloque3 option:selected").text();
							
							t.row.add( [
 								res.posicion,
								res.fecha,
								titulo_nota,
								res.categoria,
								'<a class="btn btn-danger delete-nota" id="new" href="#"> ' +
									'<i class="halflings-icon white trash"></i> ' +
								'</a>'
							] ).draw();
							
							var link = $('#new');
							//obtengo su tr
							var tr = link.closest('tr');
							//le asigno el id
							tr.attr('id', 'record-' + res.id_nota);
							//le quito el id al link
							link.attr('id', '');

							
							
						}
						else{	
							$('#error_bloque3').show();
							$('#texto-error_bloque3').text(res.mensaje_error);
						}
					}
				});
			}
			else{
				$('#error_bloque3').show();
				$('#texto-error_bloque3').text("Debe seleccionar una nota");
			}
			
				
		});
		
		$("#guardarbloque4").click(function(e){
			e.preventDefault();
			if ($("#form_bloque4")[0].checkValidity()){
				hideErrors();
				
				var nota = $("#nota_bloque4").val();
				
				
				$.ajax({
					type: 'get',
					url: 'includes/guardar-bloque.php',
					data: 'ajax=1&bloque=4&nota=' + nota,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error===false){
							$('#guardado_bloque4').show().delay(5000).fadeOut();
							
							var t = $('#tabla-notas-bloque4').DataTable();
							var titulo_nota = $("#nota_bloque4 option:selected").text();
							
							t.row.add( [
 								res.posicion,
								res.fecha,
								titulo_nota,
								res.categoria,
								'<a class="btn btn-danger delete-nota" id="new" href="#"> ' +
									'<i class="halflings-icon white trash"></i> ' +
								'</a>'
							] ).draw();
							
							var link = $('#new');
							//obtengo su tr
							var tr = link.closest('tr');
							//le asigno el id
							tr.attr('id', 'record-' + res.id_nota);
							//le quito el id al link
							link.attr('id', '');

							
							
						}
						else{	
							$('#error_bloque4').show();
							$('#texto-error_bloque4').text(res.mensaje_error);
						}
					}
				});
			}
			else{
				$('#error_bloque4').show();
				$('#texto-error_bloque4').text("Debe seleccionar una nota");
			}
			
				
		});
		$("#guardarbloque5").click(function(e){
			e.preventDefault();
			if ($("#form_bloque5")[0].checkValidity()){
				hideErrors();
				
				var nota = $("#nota_bloque5").val();
				
				
				$.ajax({
					type: 'get',
					url: 'includes/guardar-bloque.php',
					data: 'ajax=1&bloque=5&nota=' + nota,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error===false){
							$('#guardado_bloque5').show().delay(5000).fadeOut();
							
							var t = $('#tabla-notas-bloque5').DataTable();
							var titulo_nota = $("#nota_bloque5 option:selected").text();
							
							t.row.add( [
 								res.posicion,
								res.fecha,
								titulo_nota,
								res.categoria,
								'<a class="btn btn-danger delete-nota" id="new" href="#"> ' +
									'<i class="halflings-icon white trash"></i> ' +
								'</a>'
							] ).draw();
							
							var link = $('#new');
							//obtengo su tr
							var tr = link.closest('tr');
							//le asigno el id
							tr.attr('id', 'record-' + res.id_nota);
							//le quito el id al link
							link.attr('id', '');

							
							
						}
						else{	
							$('#error_bloque5').show();
							$('#texto-error_bloque5').text(res.mensaje_error);
						}
					}
				});
			}
			else{
				$('#error_bloque5').show();
				$('#texto-error_bloque5').text("Debe seleccionar una nota");
			}
			
				
		});
		
		$("#guardarbloque6").click(function(e){
			e.preventDefault();
			if ($("#form_bloque6")[0].checkValidity()){
				hideErrors();
				
				var nota = $("#nota_bloque6").val();
				
				
				$.ajax({
					type: 'get',
					url: 'includes/guardar-bloque.php',
					data: 'ajax=1&bloque=6&nota=' + nota,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error===false){
							$('#guardado_bloque6').show().delay(5000).fadeOut();
							
							var t = $('#tabla-notas-bloque6').DataTable();
							var titulo_nota = $("#nota_bloque6 option:selected").text();
							
							t.row.add( [
 								res.posicion,
								res.fecha,
								titulo_nota,
								res.categoria,
								'<a class="btn btn-danger delete-nota" id="new" href="#"> ' +
									'<i class="halflings-icon white trash"></i> ' +
								'</a>'
							] ).draw();
							
							var link = $('#new');
							//obtengo su tr
							var tr = link.closest('tr');
							//le asigno el id
							tr.attr('id', 'record-' + res.id_nota);
							//le quito el id al link
							link.attr('id', '');

							
							
						}
						else{	
							$('#error_bloque6').show();
							$('#texto-error_bloque6').text(res.mensaje_error);
						}
					}
				});
			}
			else{
				$('#error_bloque6').show();
				$('#texto-error_bloque6').text("Debe seleccionar una nota");
			}
			
				
		});
		
		$("#guardarbloque7").click(function(e){
			e.preventDefault();
			if ($("#form_bloque7")[0].checkValidity()){
				hideErrors();
				
				var nota = $("#nota_bloque7").val();
				
				
				$.ajax({
					type: 'get',
					url: 'includes/guardar-bloque.php',
					data: 'ajax=1&bloque=7&nota=' + nota,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error===false){
							$('#guardado_bloque7').show().delay(5000).fadeOut();
							
							var t = $('#tabla-notas-bloque7').DataTable();
							var titulo_nota = $("#nota_bloque7 option:selected").text();
							
							t.row.add( [
 								res.posicion,
								res.fecha,
								titulo_nota,
								res.categoria,
								'<a class="btn btn-danger delete-nota" id="new" href="#"> ' +
									'<i class="halflings-icon white trash"></i> ' +
								'</a>'
							] ).draw();
							
							var link = $('#new');
							//obtengo su tr
							var tr = link.closest('tr');
							//le asigno el id
							tr.attr('id', 'record-' + res.id_nota);
							//le quito el id al link
							link.attr('id', '');

							
							
						}
						else{	
							$('#error_bloque7').show();
							$('#texto-error_bloque7').text(res.mensaje_error);
						}
					}
				});
			}
			else{
				$('#error_bloque7').show();
				$('#texto-error_bloque7').text("Debe seleccionar una nota");
			}
			
				
		});
		
		$("#guardarbloque8").click(function(e){
			e.preventDefault();
			if ($("#form_bloque8")[0].checkValidity()){
				hideErrors();
				
				var nota = $("#nota_bloque8").val();
				
				
				$.ajax({
					type: 'get',
					url: 'includes/guardar-bloque.php',
					data: 'ajax=1&bloque=8&nota=' + nota,
					success: function(data) {
						
						var res = $.parseJSON(data);
						if (res.error===false){
							$('#guardado_bloque8').show().delay(5000).fadeOut();
							
							var t = $('#tabla-notas-bloque8').DataTable();
							var titulo_nota = $("#nota_bloque8 option:selected").text();
							
							t.row.add( [
 								res.posicion,
								res.fecha,
								titulo_nota,
								res.categoria,
								'<a class="btn btn-danger delete-nota" id="new" href="#"> ' +
									'<i class="halflings-icon white trash"></i> ' +
								'</a>'
							] ).draw();
							
							var link = $('#new');
							//obtengo su tr
							var tr = link.closest('tr');
							//le asigno el id
							tr.attr('id', 'record-' + res.id_nota);
							//le quito el id al link
							link.attr('id', '');

							
							
						}
						else{	
							$('#error_bloque8').show();
							$('#texto-error_bloque8').text(res.mensaje_error);
						}
					}
				});
			}
			else{
				$('#error_bloque8').show();
				$('#texto-error_bloque8').text("Debe seleccionar una nota");
			}
			
				
		});
		
		$("#tabla-notas-bloque1 tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas-bloque1 tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas-bloque1').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-bloque.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_bloque=' + orden + '&bloque=1',
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado===false){
							  alert("Error");
							}
							else{
							
								var todos = orden.split(",");
								var index;
								for (index = 0; index < todos.length; ++index) {
								    fila = $("#record-"+todos[index]);
								    celda = table.cell(fila.children(":first") );
								    aux=index+1;
								    celda.data(aux);
								}
								table.draw();

							}
						}
				});
			  
			}
		});
		$("#tabla-notas-bloque2 tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas-bloque2 tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas-bloque2').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-bloque.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_bloque=' + orden + '&bloque=2',
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado===false){
							  alert("Error");
							}
							else{
							
								var todos = orden.split(",");
								var index;
								for (index = 0; index < todos.length; ++index) {
								    fila = $("#record-"+todos[index]);
								    celda = table.cell(fila.children(":first") );
								    aux=index+1;
								    celda.data(aux);
								}
								table.draw();

							}
						}
				});
			  
			}
		});
		$("#tabla-notas-bloque3 tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas-bloque3 tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas-bloque3').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-bloque.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_bloque=' + orden + '&bloque=3',
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado===false){
							  alert("Error");
							}
							else{
							
								var todos = orden.split(",");
								var index;
								for (index = 0; index < todos.length; ++index) {
								    fila = $("#record-"+todos[index]);
								    celda = table.cell(fila.children(":first") );
								    aux=index+1;
								    celda.data(aux);
								}
								table.draw();

							}
						}
				});
			  
			}
		});
		
		$("#tabla-notas-bloque4 tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas-bloque4 tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas-bloque4').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-bloque.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_bloque=' + orden + '&bloque=4',
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado===false){
							  alert("Error");
							}
							else{
							
								var todos = orden.split(",");
								var index;
								for (index = 0; index < todos.length; ++index) {
								    fila = $("#record-"+todos[index]);
								    celda = table.cell(fila.children(":first") );
								    aux=index+1;
								    celda.data(aux);
								}
								table.draw();

							}
						}
				});
			  
			}
		});
		$("#tabla-notas-bloque5 tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas-bloque5 tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas-bloque5').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-bloque.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_bloque=' + orden + '&bloque=5',
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado===false){
							  alert("Error");
							}
							else{
							
								var todos = orden.split(",");
								var index;
								for (index = 0; index < todos.length; ++index) {
								    fila = $("#record-"+todos[index]);
								    celda = table.cell(fila.children(":first") );
								    aux=index+1;
								    celda.data(aux);
								}
								table.draw();

							}
						}
				});
			  
			}
		});
		
		$("#tabla-notas-bloque6 tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas-bloque6 tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas-bloque6').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-bloque.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_bloque=' + orden + '&bloque=6',
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado===false){
							  alert("Error");
							}
							else{
							
								var todos = orden.split(",");
								var index;
								for (index = 0; index < todos.length; ++index) {
								    fila = $("#record-"+todos[index]);
								    celda = table.cell(fila.children(":first") );
								    aux=index+1;
								    celda.data(aux);
								}
								table.draw();

							}
						}
				});
			  
			}
		});
		
		$("#tabla-notas-bloque7 tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas-bloque7 tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas-bloque7').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-bloque.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_bloque=' + orden + '&bloque=7',
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado===false){
							  alert("Error");
							}
							else{
							
								var todos = orden.split(",");
								var index;
								for (index = 0; index < todos.length; ++index) {
								    fila = $("#record-"+todos[index]);
								    celda = table.cell(fila.children(":first") );
								    aux=index+1;
								    celda.data(aux);
								}
								table.draw();

							}
						}
				});
			  
			}
		});
		
		$("#tabla-notas-bloque8 tbody").sortable({
			cursor: "move",
			start:function(event, ui){
			  startPosition = ui.item.prevAll().length + 1;
			},
			 
			 update: function(event, ui) {
				var orden =  $( "#tabla-notas-bloque8 tbody" ).sortable( "toArray" ).toSource().replace(/ /g,"").replace("[","").replace("]","").replace(/record-/g,"").replace(/"/g,'');
				var debugStr = "Nuevo orden: "+orden;
			  
				var parent = ui.item.closest('tr');
				var id_nota = parent.attr('id').replace('record-','');
				var table = $('#tabla-notas-bloque8').DataTable();
				var td = parent.children(":first");
				var cell = table.cell( parent.children(":first") );
				$.ajax({
						type: 'get',
						url: 'includes/reordenar-bloque.php',
						data: 'ajax=1&nota=' + id_nota + '&orden_bloque=' + orden + '&bloque=8',
						success: function(data) {
							var res = $.parseJSON(data);
							if (res.modificado===false){
							  alert("Error");
							}
							else{
							
								var todos = orden.split(",");
								var index;
								for (index = 0; index < todos.length; ++index) {
								    fila = $("#record-"+todos[index]);
								    celda = table.cell(fila.children(":first") );
								    aux=index+1;
								    celda.data(aux);
								}
								table.draw();

							}
						}
				});
			  
			}
		});
		
		$( '#tabla-notas-bloque1' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar la nota del bloque?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas-bloque1').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'includes/delete-nota-bloque.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&bloque=1',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted===true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
		$( '#tabla-notas-bloque2' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar la nota del bloque?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas-bloque2').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'includes/delete-nota-bloque.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&bloque=2',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted===true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
		$( '#tabla-notas-bloque3' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar la nota del bloque?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas-bloque3').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'includes/delete-nota-bloque.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&bloque=3',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted===true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
		
		$( '#tabla-notas-bloque4' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar la nota del bloque?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas-bloque4').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'includes/delete-nota-bloque.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&bloque=4',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted===true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
		$( '#tabla-notas-bloque5' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar la nota del bloque?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas-bloque5').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'includes/delete-nota-bloque.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&bloque=5',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted===true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
		
		$( '#tabla-notas-bloque6' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar la nota del bloque?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas-bloque6').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'includes/delete-nota-bloque.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&bloque=6',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted===true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
		
		$( '#tabla-notas-bloque7' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar la nota del bloque?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas-bloque7').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'includes/delete-nota-bloque.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&bloque=7',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted===true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
		
		$( '#tabla-notas-bloque8' ).on( 'click', 'a.eliminar', function(e) {
			e.preventDefault();
			if (confirm("Esta seguro que desea eliminar la nota del bloque?")){
				var parent = $(this).closest('tr');
				var table = $('#tabla-notas-bloque8').DataTable();
				$("#"+parent.attr('id')).removeClass("odd");
				$("#"+parent.attr('id')).removeClass("even");
				$("#"+parent.attr('id')).addClass("selected");
				
				$.ajax({
					type: 'get',
					url: 'includes/delete-nota-bloque.php',
					data: 'ajax=1&delete=' + parent.attr('id').replace('record-','') + '&bloque=8',
					success: function(data) {
						var res = $.parseJSON(data);
						if (res.deleted===true){
						  table.row('.selected').remove().draw( false );
						}
						else{	
						  alert("El registro no puede ser eliminado "+res.razon);
						}
					}
				});
			}
		});
		
	});
	</script>
	
</body>
</html>
 