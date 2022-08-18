<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckfinder/ckfinder.js"></script>

<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['id_nota'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_nota = $_GET['id_nota'];

    $sentencia = $bd->prepare("SELECT titulo_nota, titulo_galeria, bajada, copete, texto_nota, autores_id_autor, categorias_notas_id_categoria_notas,epigrafe,
    notas.galerias_id_galeria, notas.encuestas_id_encuesta, imagen_principal, imagen_home, imagen_celular, notas.face_album as face_album, notas.flickr_album as flickr_album
    FROM notas
    left join categorias_deportivas_notas on categorias_deportivas_notas.notas_id_nota=notas.id_nota
    left join clubes_notas on clubes_notas.notas_id_nota=notas.id_nota
    left join torneos_notas on torneos_notas.notas_id_nota=notas.id_nota
    where notas.id_nota = ?;");
    $sentencia->execute([$id_nota]);
    $nota = $sentencia->fetch(PDO::FETCH_OBJ);
    $titulo_nota = $nota->titulo_nota;
    $bajada = $nota->bajada;
    $copete = $nota->copete;
    $texto_nota = $nota->texto_nota;
    $autor = $nota->autores_id_autor;
    $categoria_nota = $nota->categorias_notas_id_categoria_notas;
    $galeria = $nota->galerias_id_galeria;
    $principal = $nota->imagen_principal;
    $home = $nota->imagen_home;
    $home2 = $nota->imagen_celular;
    $epigrafe = $nota->epigrafe;
    $titulo_galeria = $nota->titulo_galeria;

    $sentencia = $bd->prepare("SELECT *
    FROM clubes_notas
    left join notas on clubes_notas.notas_id_nota=notas.id_nota
    where notas.id_nota = ?;");
    $sentencia->execute([$id_nota]);
    $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $id_clubes = array();
    foreach ($result as $row){
        $id_clubes[] = $row->clubes_id_club;
    }

    $sentencia = $bd->prepare("SELECT *
    FROM torneos_notas
    left join notas on torneos_notas.notas_id_nota=notas.id_nota
    where notas.id_nota = ?;");
    $sentencia->execute([$id_nota]);
    $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $id_torneos = array();
    foreach ($result as $row){
        $id_torneos[] = $row->torneos_id_torneo;
    }

    $sentencia = $bd->prepare("SELECT categorias_deportivas_notas.categorias_id_categoria as categorias_id_categoria
    FROM categorias_deportivas_notas
    left join notas on categorias_deportivas_notas.notas_id_nota=notas.id_nota
    where notas.id_nota = ?;");
    $sentencia->execute([$id_nota]);
    $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $cats_dep = array();
    foreach ($result as $row){
        $cats_dep[] = $row->categorias_id_categoria;
    }
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">

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
                <form  class="p-4" method="POST" action="editar-nota-proceso.php" enctype="multipart/form-data">

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

                    <div class="mb-3">
                        <label class="form-label">Copete: </label>
                        <input type="text" class="form-control" name="txtCopete" value="<?php echo $copete; ?>" autofocus>

                        <label class="form-label">Título: </label>
                        <input type="text" class="form-control" name="txtTitulo" value="<?php echo $titulo_nota; ?>">

                        <label class="form-label">Bajada: </label>
                        <input type="text" class="form-control" name="txtBajada" value="<?php echo $bajada; ?>">

                        <label class="form-label">Autor: </label>
                        <select class="form-select" id="selectAutor" name="cbAutor">
                            <option value="0">Ninguno</option>
                        <?php
                            $consultaAutor = $bd -> query( "SELECT * FROM autores order by nombre_autor");
                            $autores = $consultaAutor->fetchAll(PDO::FETCH_OBJ);
                            foreach ($autores as $opcionesAutores):
                                ?>
                            <option value="<?php echo $opcionesAutores->id_autor ?>" <?php if ($opcionesAutores->id_autor === $autor) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesAutores->nombre_autor ." - ". $opcionesAutores->titulo_autor?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <label class="form-label">Categoría: </label>
                        <select class="form-select" id="selectCategoriaNota" name="cbCategoriaNota">
                        <?php
                            $consultaCatNota = $bd -> query( "SELECT hijo.id_categoria_notas as id_categoria, hijo.nombre_categoria as nombre_categoria,
                            padre.nombre_categoria as nombre_padre, padre.id_categoria_notas as id_padre
                            FROM categorias_notas as hijo
                            left join categorias_notas as padre on hijo.categorias_notas_id_categoria_notas=padre.id_categoria_notas
                            where hijo.categorias_notas_id_categoria_notas<>0 		
                            order by hijo.categorias_notas_id_categoria_notas");
                            $catNota = $consultaCatNota->fetchAll(PDO::FETCH_OBJ);
                            $padre = "";
			                $empezo =false;
                            foreach ($catNota as $opcionesCatNotas):
                                if ($padre!=$opcionesCatNotas->nombre_padre){
                                    if ($empezo){
                                        echo "</optgroup>";
                                    }
                                    else{
                                        $empezo =true;
                                    }
                                    echo "<optgroup label='".$opcionesCatNotas->nombre_padre."'>";
					                $padre = $opcionesCatNotas->nombre_padre;
                                }


                                ?>
                            <option value="<?php echo $opcionesCatNotas->id_categoria ?>" <?php if ($opcionesCatNotas->id_categoria === $categoria_nota) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCatNotas->nombre_padre."/".$opcionesCatNotas->nombre_categoria ?></font></font></option>
                        <?php
                            echo "</optgroup>";
                            endforeach ?>
                        </select>

                        <label class="form-label">Clubes involucrados: </label>
                        <select class="form-select" id="selectClubes" name="cbClubes[]" multiple>
                        <?php
                            $consultaClubes = $bd -> query( "SELECT * FROM clubes order by nombre_club");
                            $clubes = $consultaClubes->fetchAll(PDO::FETCH_OBJ);
                            foreach ($clubes as $opcionesClubes):
                        ?>
                            <option value="<?php echo $opcionesClubes->id_club ?>" <?php if (in_array($opcionesClubes->id_club,$id_clubes)){
                                echo " selected ";
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesClubes->nombre_club?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <label class="form-label">Categorías deportivas involucradas: </label>
                        <select class="form-select" id="selectCategorias" name="cbCategorias[]" multiple>
                        <?php
                            $consultaCategorias = $bd -> query( "SELECT * FROM categorias where categorias_id_categoria<>0 order by id_categoria");
                            $categorias = $consultaCategorias->fetchAll(PDO::FETCH_OBJ);
                            foreach ($categorias as $opcionesCategorias):
                        ?>
                            <option value="<?php echo $opcionesCategorias->id_categoria ?>" <?php if (in_array($opcionesCategorias->id_categoria,$cats_dep)){
                                echo " selected ";
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCategorias->nombre_categoria?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <label class="form-label">Torneos involucrados: </label>
                        <select class="form-select" id="selectTorneos" name="cbTorneos[]" multiple>
                        <?php
                            $consultaTorneos = $bd -> query( "SELECT * FROM torneos order by nombre_torneo");
                            $torneos = $consultaTorneos->fetchAll(PDO::FETCH_OBJ);
                            foreach ($torneos as $opcionesTorneos):
                        ?>
                            <option value="<?php echo $opcionesTorneos->id_torneo ?>" <?php if (in_array($opcionesTorneos->id_torneo,$id_torneos)){
                                echo " selected ";
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesTorneos->nombre_torneo?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <label class="form-label">Imagen Principal: </label>
                            <?php
								if (file_exists("../img/notas/".$id_nota."/".$principal)){
							?>
                            <img src="../img/notas/<?=$id_nota?>/<?=$principal?>" alt="Foto" width="150" style="margin-left: 20px">
							<p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
							<?php
								}
							?>
                        <input class="form-control" type="file" accept="image/*" name="imgPrincipal">

                        <label class="form-label">Epígrafe: </label>
                        <input type="text" class="form-control" name="txtEpigrafe" value="<?php echo $epigrafe;?>">

                        <label class="form-label">Imagen Home: </label>
                            <?php
								if (file_exists("../img/notas/".$id_nota."/".$home)){
							?>
								<img src="../img/notas/<?=$id_nota?>/<?=$home?>" alt="Foto" width="150" style="margin-left: 20px">
								<p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
							<?php
								}
							?>
                        <input class="form-control" type="file" accept="image/*" name="imgHome">
                            
                        <label class="form-label">Imagen Home 2: </label>
                            <?php
								if (file_exists("../img/notas/".$id_nota."/".$home2)){
							?>
								<img src="../img/notas/<?=$id_nota?>/<?=$home2?>" alt="Foto" width="150" style="margin-left: 20px">
								<p style="color: #8e8e8e;font-size: 12px;">Si cargas una nueva imagen se reemplazará por la existente</p>
							<?php
								}
							?>
                        <input class="form-control" type="file" accept="image/*" name="imgHome2">

                        <label class="form-label">Título Galería: </label>
                        <input type="text" class="form-control" name="txtTituloGaleria" value="<?php echo $titulo_galeria;?>">

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
							<label class="form-label">Texto:</label>
							<div class="">
							<textarea cols="80" id="editor" name="editor" rows="10"><?=base64_decode($texto_nota)?></textarea>

                            <script type="text/javascript">
                                var editor = CKEDITOR.replace( 'editor' );
                                CKFinder.setupCKEditor( editor );
                            </script>
								
							</div>
						</div>

                        <h5><font style="vertical-align: inherit;">Publicidades Notas</font></h5>

                        <?php
                            $consultaPubliE1 = $bd -> query( "SELECT *
                            FROM publicidades_posicionadas
                            where ubicaciones_id_ubicacion=20 and notas_id_nota = $id_nota");
                            $publiE1 = $consultaPubliE1->fetch(PDO::FETCH_OBJ);
                        ?>

                        <label class="form-label">Publicidades E1: </label>
                        <select class="form-select" id="selectPubliE1" name="cbPubliE1">
                            <option value="0">Seleccionar</option>
                        <?php
                            $consultaPubli = $bd -> query( "SELECT * FROM publicidades where archivada=0 order by nombre_publicidad");
                            $publi = $consultaPubli->fetchAll(PDO::FETCH_OBJ);
                            foreach ($publi as $opcionesPubli):
                        ?>
                            <option value="<?php echo $opcionesPubli->id_publicidad ?>" <?php
                            if (!empty($publiE1)) {
                                if ($opcionesPubli->id_publicidad === $publiE1->publicidades_id_publicidad) {
                                    echo 'selected = "selected"';
                                }
                            } else{
                                if ($opcionesPubli->id_publicidad === 0) {
                                    echo 'selected = "selected"';
                                }
                            }
                            ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPubli->nombre_publicidad?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <?php
                            $consultaPubliF1 = $bd -> query( "SELECT *
                            FROM publicidades_posicionadas
                            where ubicaciones_id_ubicacion=21 and notas_id_nota = $id_nota");
                            $publiF1 = $consultaPubliF1->fetch(PDO::FETCH_OBJ);
                        ?>

                        <label class="form-label">Publicidades F1: </label>
                        <select class="form-select" id="selectPubliF1" name="cbPubliF1">
                            <option value="0">Seleccionar</option>
                        <?php
                            $consultaPubli = $bd -> query( "SELECT * FROM publicidades where archivada=0 order by nombre_publicidad");
                            $publi = $consultaPubli->fetchAll(PDO::FETCH_OBJ);
                            foreach ($publi as $opcionesPubli):
                        ?>
                            <option value="<?php echo $opcionesPubli->id_publicidad ?>" <?php
                            if (!empty($publiF1)) {
                                if ($opcionesPubli->id_publicidad === $publiF1->publicidades_id_publicidad) {
                                    echo 'selected = "selected"';
                                }
                            } else{
                                if ($opcionesPubli->id_publicidad === 0) {
                                    echo 'selected = "selected"';
                                }
                            }?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPubli->nombre_publicidad?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <?php
                            $consultaPubliG1 = $bd -> query( "SELECT *
                            FROM publicidades_posicionadas
                            where ubicaciones_id_ubicacion=22 and notas_id_nota = $id_nota");
                            $publiG1 = $consultaPubliG1->fetch(PDO::FETCH_OBJ);
                        ?>

                        <label class="form-label">Publicidades G1: </label>
                        <select class="form-select" id="selectPubliG1" name="cbPubliG1">
                            <option value="0">Seleccionar</option>
                        <?php
                            $consultaPubli = $bd -> query( "SELECT * FROM publicidades where archivada=0 order by nombre_publicidad");
                            $publi = $consultaPubli->fetchAll(PDO::FETCH_OBJ);
                            foreach ($publi as $opcionesPubli):
                        ?>
                            <option value="<?php echo $opcionesPubli->id_publicidad ?>" <?php 
                            if (!empty($publiG1)) {
                                if ($opcionesPubli->id_publicidad === $publiG1->publicidades_id_publicidad) {
                                    echo 'selected = "selected"';
                                }
                            } else{
                                if ($opcionesPubli->id_publicidad === 0) {
                                    echo 'selected = "selected"';
                                }
                            }?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPubli->nombre_publicidad?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>
                        
                        
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_nota" value="<?php echo $id_nota; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <div id="mensaje"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'template/footer.php' ?>