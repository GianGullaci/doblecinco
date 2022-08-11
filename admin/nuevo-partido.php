<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
<script src="../editor/sample.js" type="text/javascript"></script>
<link href="../editor/sample.css" rel="stylesheet" type="text/css" />

<?php
    if(isset($_POST['cbTorneo'])){
        include_once '../model/conexion.php';
        $id_fecha = $_POST['cbFecha'];
        $zona = $_POST['cbZona'];
        $fecha_partido = $_POST['txtDia'];
        $hora_partido = $_POST['txtHora'];
        $categoria = $_POST['cbCategoria'];
        $arbitro = $_POST['cbArbitro'];
        $arbitro1 = $_POST['cbArbitro1'];
        $arbitro2 = $_POST['cbArbitro2'];
        $id_equipo_local = $_POST['cbLocal'];
        $id_equipo_visitante = $_POST['cbVisitante'];
        $galeria = $_POST['cbGaleria'];
        $lugar = $_POST['cbLugar'];
        $txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
        $txt = base64_encode($txt);

        if ($id_equipo_local != $id_equipo_visitante) {
            $sentencia = $bd->prepare("INSERT INTO partidos (fecha_partido, hora_partido, arbitros_id_arbitro,arbitros_id_arbitro1,arbitros_id_arbitro2, equipos_id_equipo, equipos_id_equipo1, 
            fechas_id_fecha, galerias_id_galeria, lugares_id_lugar, zona, descripcion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);");
            $resultado = $sentencia->execute([$fecha_partido,$hora_partido,$arbitro,$arbitro1,$arbitro2,$id_equipo_local,$id_equipo_visitante,$id_fecha,$galeria,$lugar,$zona,$txt]);
            if ($resultado === true) {
                header('location: partidos.php?mensaje=registrado');
            } else {
                header('location: partidos.php?mensaje=error');
                exit();
            }
        } else {
            header('location: nuevo-partido.php?mensaje=error');
            exit();
        }
    }
    
?>

<?php include 'template/header.php' ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Seleccionó el mismo equipo.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <div class="card">
                <div class="card-header">
                    Ingresar datos
                </div>
                <form  class="p-4" method="POST" action="#" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Torneo: </label>
                        <select class="form-select" id="selectTorneo" name="cbTorneo">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaTorneo = $bd -> query( "select * from torneos;");
                            $torneos = $consultaTorneo->fetchAll(PDO::FETCH_OBJ);
                            foreach ($torneos as $opcionesTorneo): 
                        ?>
                            <option value="<?php echo $opcionesTorneo->id_torneo ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesTorneo->nombre_torneo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        
                        <label class="form-label">Fecha: </label>
                        <select class="form-select" id="selectFecha" name="cbFecha">
                        </select>

                        <label class="form-label">Zona: </label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="cbZona" id="flexRadioDefault1" value="A" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Zona A
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="cbZona" id="flexRadioDefault2" value="B">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Zona B
                        </label>
                        </div>
                        
                        <label class="form-label">Día: </label>
                        <input type="date" class="form-control" name="txtDia" required>
                        <label class="form-label">Hora: </label>
                        <input type="time" class="form-control" name="txtHora" required>

                        <label class="form-label">Categoría: </label>
                        <select class="form-select" id="selectCategoria" name="cbCategoria">
                        <?php
                            $consultaCat = $bd -> query( "select * from categorias where categorias_id_categoria<>0 order by id_categoria");
                            $cat = $consultaCat->fetchAll(PDO::FETCH_OBJ);
                            foreach ($cat as $opcionesCategorias):
                                ?>
                            <option value="<?php echo $opcionesCategorias->id_categoria ?>" <?php if ($opcionesCategorias->id_categoria === 3) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCategorias->nombre_categoria ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <label class="form-label">Equipo Local: </label>
                        <select class="form-select" id="selectLocal" name="cbLocal">
                        </select>

                        <label class="form-label">Equipo Visitante: </label>
                        <select class="form-select" id="selectVisitante" name="cbVisitante">
                        </select>

                        <label class="form-label">Lugar: </label>
                        <select class="form-select" id="selectLugar" name="cbLugar">
                        </select>

                        <label class="form-label">Arbitros: </label>
                        <?php
                            $consultaArbitros = $bd -> query( "select * from arbitros order by nombre_arbitro");
                            $arbitros = $consultaArbitros->fetchAll(PDO::FETCH_OBJ);
                        ?>

                        <select class="form-select" id="selectArbitro" name="cbArbitro">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Indefinido</font></font></option>
                        <?php foreach ($arbitros as $opcionesArbitros):?>
                            <option value="<?php echo $opcionesArbitros->id_arbitro ?>" <?php if ($opcionesArbitros->id_arbitro === 3) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesArbitros->nombre_arbitro ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <select class="form-select" id="selectArbitro1" name="cbArbitro1">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Indefinido</font></font></option>
                        <?php foreach ($arbitros as $opcionesArbitros):?>
                            <option value="<?php echo $opcionesArbitros->id_arbitro ?>" <?php if ($opcionesArbitros->id_arbitro === 3) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesArbitros->nombre_arbitro ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <select class="form-select" id="selectArbitro2" name="cbArbitro2">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Indefinido</font></font></option>
                        <?php foreach ($arbitros as $opcionesArbitros):?>
                            <option value="<?php echo $opcionesArbitros->id_arbitro ?>" <?php if ($opcionesArbitros->id_arbitro === 3) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesArbitros->nombre_arbitro ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <label class="form-label">Galería: </label>
                        <select class="form-select" id="selectGaleria" name="cbGaleria">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sin galería</font></font></option>
                        <?php
                            $consultaGaleria = $bd -> query( "SELECT * FROM galerias order by nombre_galeria");
                            $galerias = $consultaGaleria->fetchAll(PDO::FETCH_OBJ);
                            foreach ($galerias as $opcionesGalerias):
                                ?>
                            <option value="<?php echo $opcionesGalerias->id_galeria ?>" <?php if ($opcionesGalerias->id_galeria === 3) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo str_replace('galerias/','',str_replace('../', '',$opcionesGalerias->ruta_galeria))?></font></font></option>
                        <?php
                            endforeach ?>
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
                        <div id="mensaje"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        recargarFecha();

        $('#selectTorneo').change(function(){
            recargarFecha();
        });

        recargarEquipo();

        $('#selectCategoria').change(function(){
            recargarEquipo();
        });

        recargarLugar();

        $('#selectLocal').change(function(){
            recargarLugar();
        });
        $('#selectVisitante').change(function(){
            recargarLugar();
        });
    })
</script>


<script type="text/javascript">
    function recargarFecha(){
        $.ajax({
            type:"POST",
            url:"recargo-fecha.php",
            data:"torneo=" + $('#selectTorneo').val(),
            success:function(r){
                $('#selectFecha').html(r);
            }
        });
    }

    function recargarEquipo(){
        $.ajax({
            type:"POST",
            url:"recargo-equipo.php",
            data:{categoria: $('#selectCategoria').val()},
            success:function(r){
                $('#selectLocal').html(r);
                $('#selectVisitante').html(r);
            }
        });
    }

    function recargarLugar(){
        $.ajax({
            type:"POST",
            url:"recargo-lugar.php",
            data:{local: $('#selectLocal').val(),visitante: $('#selectVisitante').val()},
            success:function(r){
                $('#selectLugar').html(r);
            }
        });
    }
</script>

<?php include 'template/footer.php' ?>