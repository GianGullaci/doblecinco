<?php include 'template/header.php' ?>

<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
<script src="../editor/sample.js" type="text/javascript"></script>
<link href="../editor/sample.css" rel="stylesheet" type="text/css" />

<?php
    include_once "../model/conexion.php";
    $sentencia = $bd -> query( "SELECT jugadores.nombre_jugador as nombre_jugador, jugadores.fecha_nacimiento as fecha_nacimiento,
    jugadores.id_jugador as id_jugador, ciudades.nombre as nombre_ciudad, jugadores.activo as activo,
    puesto.nombre_puesto as puesto, clubes.nombre_club as nombre_club
    FROM jugadores 
    left join ciudades on ciudades.id_ciudad=jugadores.ciudades_id_ciudad
    left join puesto on puesto.id_puesto=jugadores.puesto_id_puesto
    left join clubes on clubes.id_club=jugadores.clubes_id_club
    WHERE activo = 1
    order by nombre_jugador");
    $jugadores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container my-5">
    <div class="row justify-content-center g-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos
                </div>
                <form  class="p-4" method="POST" action="nuevo-jugador.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required>
                        <label class="form-label">Fecha Nacimiento: </label>
                        <input type="date" class="form-control" name="txtFecha" required>
                        <label class="form-label">Ciudad: </label>
                        <select class="form-select" id="selectCiudad" name="cbCiudad">
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ciudades</font></font></option>
                        <?php
                            include_once "../model/conexion.php";
                            $consultaCiudad = $bd -> query( "select * from ciudades ORDER BY ciudades.nombre ASC;");
                            $ciudades = $consultaCiudad->fetchAll(PDO::FETCH_OBJ);
                            foreach ($ciudades as $opcionesCiudad): 
                        ?>
                            <option value="<?php echo $opcionesCiudad->id_ciudad ?>" <?php if($opcionesCiudad->id_ciudad === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCiudad->nombre ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Puesto: </label>
                        <select class="form-select" id="selectPuesto" name="cbPuesto">
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">A definir</font></font></option>
                        <?php
                            include_once "../model/conexion.php";
                            $consultaPuesto = $bd -> query( "select * from puesto;");
                            $puestos = $consultaPuesto->fetchAll(PDO::FETCH_OBJ);
                            foreach ($puestos as $opcionesPuesto): 
                        ?>
                            <option value="<?php echo $opcionesPuesto->id_puesto ?>" <?php if($opcionesPuesto->id_puesto === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPuesto->nombre_puesto ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Pierna Hábil: </label>
                        <select class="form-select" id="selectPierna" name="cbPierna">
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">A definir</font></font></option>
                        <?php
                            include_once "../model/conexion.php";
                            $consultaPierna = $bd -> query( "select * from pierna_habil;");
                            $piernas = $consultaPierna->fetchAll(PDO::FETCH_OBJ);
                            foreach ($piernas as $opcionesPierna): 
                        ?>
                            <option value="<?php echo $opcionesPierna->id_pierna_habil ?>" <?php if($opcionesPierna->id_pierna_habil === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPierna->nombre_pierna ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Club: </label>
                        <select class="form-select" id="selectClub" name="cbClub">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaClubes = $bd -> query( "select * from clubes ORDER BY clubes.nombre_club ASC;tab");
                            $clubes = $consultaClubes->fetchAll(PDO::FETCH_OBJ);
                            foreach ($clubes as $opcionesClubes): 
                        ?>
                            <option value="<?php echo $opcionesClubes->id_club ?>" <?php if($opcionesClubes->id_club === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesClubes->nombre_club ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Equipo: </label>
                        <select class="form-select" id="selectEquipo" name="cbEquipo">
                            <option value="0">A</option>
							<option value="1">B</option>
                        </select>
                        <div class="">
							  <label class="form-label">Descripción:</label>
							  <div class="">
								<textarea cols="80" id="descripcion" name="descripcion" rows="10"></textarea>
								<script type="text/javascript">
								//<![CDATA[

									CKEDITOR.replace( 'descripcion',
							{
								
							
							    toolbar: [
							    [ 'Source', '-', 'Print', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
							    [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ],
							    [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ],
							    [ 'Link', 'Unlink' ],
							    [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ],
							    [ 'Styles', 'Format', 'Font', 'FontSize' ],
							    [ 'TextColor', 'BGColor' ],
								['Youtube'],['Mp3Player']
						],
							    filebrowserBrowseUrl :'../editor/js/ckeditor/filemanager/browser/default/browser.html?Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
							    filebrowserImageBrowseUrl : '../editor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
							    filebrowserFlashBrowseUrl :'../editor/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
										filebrowserUploadUrl  :'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
										filebrowserImageUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
										filebrowserFlashUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
										
									});

								//]]>
								</script>
							  </div>
							</div>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-8">

            <!-- inicio alerta-->
            
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Falta ingresar el nombre
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">          
                <strong>Registrado!</strong> Se agregaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Vuelve a intentar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">          
                <strong>Editado!</strong> Se editaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">          
                <strong>Eliminado!</strong> Se eliminaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'PartidosAsociados'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Posee partidos asociados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <!-- fin alerta-->


            <div class="card">
                <div class="card-header">
                    Lista de Jugadores
                </div>
                <div class="p-4 table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">Equipo</th>
                                <th scope="col">Posición</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($jugadores as $dato){
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre_jugador; ?></td>
                                <td><?php echo date("d-m-Y", strtotime($dato->fecha_nacimiento)) ?></td>
                                <td><?php echo $dato->nombre_club; ?></td>
                                <td><?php echo $dato->puesto; ?></td>
                                <td><a class="text-success" href="editar-jugador.php?id_jugador=<?php echo $dato->id_jugador;?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="eliminar-jugador.php?id_jugador=<?php echo $dato->id_jugador;?>"><i class="bi bi-trash-fill"></i></a></td>
                            </tr>

                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>