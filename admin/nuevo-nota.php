<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckfinder/ckfinder.js"></script>

<?php
    include_once '../model/conexion.php';

    if(isset($_POST['editor'])){
        
        $dt = DateTime::createFromFormat('d/m/Y', date("d/m/Y"));
		$fecha = $dt->format('Y-m-d');
		
		$txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['editor']);

        $sentencia = $bd->prepare("INSERT INTO notas (titulo_nota, titulo_galeria, fecha_nota, copete, bajada, epigrafe, autores_id_autor, galerias_id_galeria, categorias_notas_id_categoria_notas, texto_nota) VALUES (?,?,?,?,?,?,?,?,?,?);");
        $resultado = $sentencia->execute([$_POST['txtTitulo'],$_POST['txtTituloGaleria'],$fecha,$_POST['txtCopete'],$_POST['txtBajada'],$_POST['txtEpigrafe'],$_POST['cbAutor'],$_POST['cbGaleria'],$_POST['cbCategoriaNota'],base64_encode($txt)]);
        
        $id = $bd->lastInsertId();
        
        if (isset($_POST['cbCategorias'])){
            foreach($_POST['cbCategorias'] as $cat){
                $sentencia = $bd->prepare("INSERT INTO categorias_deportivas_notas (notas_id_nota, categorias_id_categoria) VALUES (?,?);");
                $resultado = $sentencia->execute([$id,$cat]);
            }
        }

        if (isset($_POST['cbClubes'])){
            foreach($_POST['cbClubes'] as $club){
                $sentencia = $bd->prepare("INSERT INTO clubes_notas (notas_id_nota, clubes_id_club) VALUES (?,?);");
                $resultado = $sentencia->execute([$id,$club]);
            }
        }

        if (isset($_POST['cbTorneos'])){
            foreach($_POST['cbTorneos'] as $torneo){
                $sentencia = $bd->prepare("INSERT INTO torneos_notas (notas_id_nota, torneos_id_torneo) VALUES (?,?);");
                $resultado = $sentencia->execute([$id,$torneo]);
            }
        }

        $principal = $_FILES["imgPrincipal"]["name"];
        $tmpPrincipal = $_FILES["imgPrincipal"]["tmp_name"];
        mkdir("../img/notas/".$id, 0777, true);
		chmod("../img/notas/".$id, 0777);
    
        if($principal!=""){
            move_uploaded_file($tmpPrincipal,"../img/notas/".$id."/principal.jpg");
            $sentencia = $bd->prepare("UPDATE notas SET imagen_principal = 'principal.jpg' WHERE id_nota = $id;");
            $resultado = $sentencia->execute();
        };

        $home = $_FILES["imgHome"]["name"];
        $tmpHome = $_FILES["imgHome"]["tmp_name"];
    
        if($home!=""){
            move_uploaded_file($tmpHome,"../img/notas/".$id."/home.jpg");
            $sentencia = $bd->prepare("UPDATE notas SET imagen_home = 'home.jpg' WHERE id_nota = $id;");
            $resultado = $sentencia->execute();
        };

        $home2 = $_FILES["imgHome2"]["name"];
        $tmpHome2 = $_FILES["imgHome2"]["tmp_name"];
    
        if($home2!=""){
            move_uploaded_file($tmpHome2,"../img/notas/".$id."/home2.jpg");
            $sentencia = $bd->prepare("UPDATE notas SET imagen_celular = 'home2.jpg' WHERE id_nota = $id;");
            $resultado = $sentencia->execute();
        };

    }
    
?>

<?php include 'template/header.php' ?>

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
                <form  class="p-4" method="POST" action="#" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Copete: </label>
                        <input type="text" class="form-control" name="txtCopete" autofocus>

                        <label class="form-label">Título: </label>
                        <input type="text" class="form-control" name="txtTitulo">

                        <label class="form-label">Bajada: </label>
                        <input type="text" class="form-control" name="txtBajada">

                        <label class="form-label">Autor: </label>
                        <select class="form-select" id="selectAutor" name="cbAutor">
                            <option value="0">Ninguno</option>
                        <?php
                            $consultaAutor = $bd -> query( "SELECT * FROM autores order by nombre_autor");
                            $autores = $consultaAutor->fetchAll(PDO::FETCH_OBJ);
                            foreach ($autores as $opcionesAutores):
                                ?>
                            <option value="<?php echo $opcionesAutores->id_autor ?>" <?php if ($opcionesAutores->id_autor === 0) {
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
                            <option value="<?php echo $opcionesCatNotas->id_categoria ?>" <?php if ($opcionesCatNotas->id_categoria === 0) {
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
                            <option value="<?php echo $opcionesClubes->id_club ?>" <?php if ($opcionesClubes->id_club === 0) {
                                echo 'selected = "selected"';
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
                            <option value="<?php echo $opcionesCategorias->id_categoria ?>" <?php if ($opcionesCategorias->id_categoria === 0) {
                                echo 'selected = "selected"';
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
                            <option value="<?php echo $opcionesTorneos->id_torneo ?>" <?php if ($opcionesTorneos->id_torneo === 0) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesTorneos->nombre_torneo?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <label class="form-label">Imagen Principal: </label>
                        <input class="form-control" type="file" accept="image/*" name="imgPrincipal">

                        <label class="form-label">Epígrafe: </label>
                        <input type="text" class="form-control" name="txtEpigrafe">

                        <label class="form-label">Imagen Home: </label>
                        <input class="form-control" type="file" accept="image/*" name="imgHome">

                        <label class="form-label">Imagen Home 2: </label>
                        <input class="form-control" type="file" accept="image/*" name="imgHome2">

                        <label class="form-label">Título Galería: </label>
                        <input type="text" class="form-control" name="txtTituloGaleria">

                        <label class="form-label">Galería: </label>
                        <select class="form-select" id="selectGaleria" name="cbGaleria">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Sin galería</font></font></option>
                        <?php
                            $consultaGaleria = $bd -> query( "SELECT * FROM galerias order by nombre_galeria");
                            $galerias = $consultaGaleria->fetchAll(PDO::FETCH_OBJ);
                            foreach ($galerias as $opcionesGalerias):
                                ?>
                            <option value="<?php echo $opcionesGalerias->id_galeria ?>" <?php if ($opcionesGalerias->id_galeria === 0) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo str_replace('galerias/','',str_replace('../', '',$opcionesGalerias->ruta_galeria))?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>

                        <div class="">
							  <label class="form-label">Texto:</label>
							  <div class="">
								<textarea cols="80" id="editor" name="editor" rows="10"></textarea>

                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace( 'editor' );
                                    CKFinder.setupCKEditor( editor );
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

<?php include 'template/footer.php' ?>