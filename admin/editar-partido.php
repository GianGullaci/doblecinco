<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
<script src="../editor/sample.js" type="text/javascript"></script>
<link href="../editor/sample.css" rel="stylesheet" type="text/css" />

<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['id_partido'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_partido = $_GET['id_partido'];

    $sentencia = $bd->prepare("SELECT id_partido, fecha_partido, hora_partido,lugares.direccion as lugar, tipo_lugar, zona, 
    club_juega.nombre_club as nombre_juega, club_local.nombre_club as nombre_local, club_local.id_club as id_local, 
    club_visitante.nombre_club as nombre_visitante, club_visitante.id_club as id_visitante, nombre_categoria,  fechas.nombre as nombre_fecha, 
    nombre_torneo, DATEDIFF(fecha_partido,CURDATE()) as dif,
    fechas.torneos_id_torneo1, partidos.fechas_id_fecha, equipo_visitante.categorias_id_categoria, 
    partidos.lugares_id_lugar, arbitros_id_arbitro, arbitros_id_arbitro1, arbitros_id_arbitro2, partidos.descripcion,
    equipo_local.id_equipo as id_equipo_local, equipo_visitante.id_equipo as id_equipo_visitante,
    configuracion_local, configuracion_visitante, partidos.galerias_id_galeria as galerias_id_galeria,
    equipo_local.nombre_equipo as nombre_equipo_local,
    equipo_visitante.nombre_equipo as nombre_equipo_visitante
    FROM partidos 
    left join equipos as equipo_local on equipo_local.id_equipo=partidos.equipos_id_equipo
    left join clubes as club_local on club_local.id_club=equipo_local.clubes_id_club
    left join equipos as equipo_visitante on equipo_visitante.id_equipo=partidos.equipos_id_equipo1
    left join clubes as club_visitante on club_visitante.id_club=equipo_visitante.clubes_id_club
    left join categorias on categorias.id_categoria=equipo_visitante.categorias_id_categoria
    left join fechas on fechas.id_fecha=partidos.fechas_id_fecha
    left join torneos on fechas.torneos_id_torneo1=torneos.id_torneo
    left join lugares on partidos.lugares_id_lugar=lugares.id_lugar
    left join clubes as club_juega on club_juega.id_club=lugares.clubes_id_club
    where partidos.id_partido = ?;");
    $sentencia->execute([$id_partido]);
    $row = $sentencia->fetch(PDO::FETCH_OBJ);
    if (!empty($row)){
        $id_torneo = $row->torneos_id_torneo1;
        $nombre_torneo = $row->nombre_torneo;
        $id_fecha = $row->fechas_id_fecha;
        $id_categoria=$row->categorias_id_categoria;
        $lugar=$row->lugares_id_lugar;
        $id_local=$row->id_local;
        $id_visitante=$row->id_visitante;
        $nombre_local=$row->nombre_local;
        $nombre_visitante=$row->nombre_visitante;
        $dia ="";
        if ($row->fecha_partido!="0000-00-00 00:00:00"){
            $dia= $row->fecha_partido;
            $time = strtotime($dia);
            $dia = date("Y-m-d", $time);
        }
        $hora=$row->hora_partido;
        $arbitro=$row->arbitros_id_arbitro;
        $arbitro1=$row->arbitros_id_arbitro1;
        $arbitro2=$row->arbitros_id_arbitro2;
        $descripcion=$row->descripcion;
        $id_equipo_local=$row->id_equipo_local;
        $id_equipo_visitante=$row->id_equipo_visitante;
        $nombre_categoria=$row->nombre_categoria;
        $zona=$row->zona;
        $galeria = $row->galerias_id_galeria;
        $nombre_equipo_local=$row->nombre_equipo_local;
        $nombre_equipo_visitante=$row->nombre_equipo_visitante;
    }

    
?>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-partido-proceso.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Torneo: </label>
                        <select class="form-select" id="selectTorneo" name="cbTorneo" disabled>
                            <option value="<?php echo $id_torneo ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $nombre_torneo ?></font></font></option>
                        </select>
                        
                        <label class="form-label">Fecha: </label>
                        <select class="form-select" id="selectFecha" name="cbFecha">
                        <?php echo $id_torneo ?>
                        </select>

                        <label class="form-label">Zona: </label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="cbZona" id="flexRadioDefault1" value="A" <?php if($row->zona === "A"){ echo 'checked = "checked"';} ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Zona A
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="cbZona" id="flexRadioDefault2" value="B" <?php if($row->zona === "B"){ echo 'checked = "checked"';} ?>>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Zona B
                        </label>
                        </div>
                        
                        <label class="form-label">Día: </label>
                        <input type="date" class="form-control" name="txtDia" value="<?php echo $dia; ?>" required>
                        <label class="form-label">Hora: </label>
                        <input type="time" class="form-control" name="txtHora" value="<?php echo $hora ?>" required>

                        <label class="form-label">Categoría: </label>
                        <select class="form-select" id="selectCategoria" name="cbCategoria" disabled>
                            <option value="<?php echo $id_categoria ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $nombre_categoria ?></font></font></option>
                        </select>

                        <label class="form-label">Equipo Local: </label>
                        <select class="form-select" id="selectEquipo" name="cbEquipo" disabled>
                            <option value="<?php echo $id_equipo_local ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $nombre_equipo_local ?></font></font></option>
                        </select>

                        <label class="form-label">Equipo Visitante: </label>
                        <select class="form-select" id="selectEquipo1" name="cbEquipo1" disabled>
                            <option value="<?php echo $id_equipo_visitante ?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $nombre_equipo_visitante ?></font></font></option>
                        </select>

                        <label class="form-label">Lugar: </label>
                        <select class="form-select" id="selectLugar" name="cbLugar">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Indefinido</font></font></option>
                        <?php
                            $consultaLugares = $bd -> query( "SELECT distinct(id_lugar), tipo_lugar, id_lugar, nombre_club, direccion FROM lugares join clubes on clubes.id_club=lugares.clubes_id_club join equipos on equipos.clubes_id_club=clubes.id_club WHERE (clubes.id_club = $id_local or clubes.id_club = $id_visitante) or (lugares.neutral = 1);");
                            $lugares = $consultaLugares->fetchAll(PDO::FETCH_OBJ);
                            foreach ($lugares as $opcionesLugares):
                                if ($opcionesLugares->tipo_lugar==1){
                                    $tipo="Sede ";
                                  }
                                  else if ($opcionesLugares->tipo_lugar==2){
                                    $tipo="Estadio ";
                                  }
                                  else{
                                    $tipo="Predio ";
                                  }
                        ?>
                            <option value="<?php echo $opcionesLugares->id_lugar ?>" <?php if ($opcionesLugares->id_lugar === $lugar) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $tipo; echo $opcionesLugares->nombre_club;?>: <?php echo $opcionesLugares->direccion ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <label class="form-label">Arbitros: </label>
                        <?php
                            $consultaArbitros = $bd -> query( "select * from arbitros order by nombre_arbitro");
                            $arbitros = $consultaArbitros->fetchAll(PDO::FETCH_OBJ);
                        ?>

                        <select class="form-select" id="selectArbitro" name="cbArbitro">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Indefinido</font></font></option>
                        <?php foreach ($arbitros as $opcionesArbitros):?>
                            <option value="<?php echo $opcionesArbitros->id_arbitro ?>" <?php if ($opcionesArbitros->id_arbitro === $arbitro) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesArbitros->nombre_arbitro ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <select class="form-select" id="selectArbitro1" name="cbArbitro1">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Indefinido</font></font></option>
                        <?php foreach ($arbitros as $opcionesArbitros):?>
                            <option value="<?php echo $opcionesArbitros->id_arbitro ?>" <?php if ($opcionesArbitros->id_arbitro === $arbitro1) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesArbitros->nombre_arbitro ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <select class="form-select" id="selectArbitro2" name="cbArbitro2">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Indefinido</font></font></option>
                        <?php foreach ($arbitros as $opcionesArbitros):?>
                            <option value="<?php echo $opcionesArbitros->id_arbitro ?>" <?php if ($opcionesArbitros->id_arbitro === $arbitro2) {
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
                            <option value="<?php echo $opcionesGalerias->id_galeria ?>" <?php if ($opcionesGalerias->id_galeria === $galeria) {
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
                        <input type="hidden" name="id_partido" value="<?php echo $id_partido; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
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
</script>

<?php include 'template/footer.php' ?>