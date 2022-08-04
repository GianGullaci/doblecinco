<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $id_nota = $_GET['id'];
    $sentencia = $bd -> query("SELECT id_nota, titulo_nota, copete, bajada,texto_nota, imagen_principal,epigrafe, cat_padre.color_categoria as color_categoria, id_autor, nombre_autor, 
    titulo_autor, foto, id_partido_cubierto, notas.titulo_galeria as titulo_galeria, 
    cat.nombre_categoria AS nombre_categoria, cat.id_categoria_notas AS id_categoria, cat_padre.nombre_categoria AS nombre_categoria_padre, 
    cat_padre.id_categoria_notas AS id_categoria_padre,
    notas.galerias_id_galeria as galerias_id_galeria, notas.face_album as face_album, notas.flickr_album as flickr_album, encuestas_id_encuesta,
    autores_id_autor
    FROM notas
    LEFT JOIN categorias_notas AS cat ON cat.id_categoria_notas = notas.categorias_notas_id_categoria_notas
    LEFT JOIN categorias_notas AS cat_padre ON cat_padre.id_categoria_notas = cat.categorias_notas_id_categoria_notas
    LEFT JOIN autores ON autores.id_autor = notas.autores_id_autor
    where id_nota=$id_nota");
    $notas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<?php
    include_once "model\conexion.php";
    $sentencia = $bd -> query("SELECT id_publicidad, archivo_publicidad, link_publicidad
    FROM notas
    left join  publicidades_posicionadas on publicidades_posicionadas.notas_id_nota=id_nota
    left join publicidades on id_publicidad=publicidades_posicionadas.publicidades_id_publicidad
    left join ubicaciones_publicidades on ubicaciones_id_ubicacion=id_ubicacion
    where id_nota = $id_nota and seccion='nota' 
    and nombre_ubicacion='E1' and archivada=0
    group by id_publicidad");
    $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $row) {
?>
    <section class="pt-2">
        <div class="container">
            <div class="card">
            <a href="<?php echo $row->link_publicidad;?>" target="_blank"><img src="img/publicidades/<?php echo $row->id_publicidad;?>/<?php echo $row->archivo_publicidad;?>" class="publi-long"></a>
            </div>
        </div>
    </section>

<?php
    }
?>

<section class="pt-2">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-9">

            <?php
                foreach ($notas as $row) {
            ?>

            <h6><?php echo $row->copete;?></h6>

                <div class="card">
                    <img src="img/notas/<?php echo $row->id_nota;?>/<?php echo $row->imagen_principal;?>" class="img-nota">
                </div>
            
            <h1 class="display-5 fw-bold"><?php echo $row->titulo_nota;?></h1>
            <h4 class="text-muted"><?php echo $row->bajada;?></h4>
            <?php
				if ($row->autores_id_autor!=0){
			?>
				<div class="d-flex p-3 my-3 rounded" style="background-color: rgba(33, 99, 232, 0.1);width:250px;float:left;margin-right:1rem;">
                    <center>
					<img class="rounded-circle" width="150px" height="150px" src="img/autores/<?=$row->autores_id_autor?>/<?=$row->foto?>">
					<div class="px-4">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h4 class="m-0"><?=$row->nombre_autor?></h4>
                        </div>
                        <p class="my-2">
                            <font style="vertical-align: inherit;"><?=$row->titulo_autor?></font>
                        </p>
                    </div>
                    </center>
				</div>	
		
			<?php
				}
			?>
            <div class="texto-nota">
            <?php 
                echo base64_decode($row->texto_nota)
            ?>
            </div>

            <?php
                if (($row->galerias_id_galeria)!=0){
            ?>
    
            
            <h3 style="font-size:19px;"><?php echo $row->titulo_galeria;?></h3>
            <div class="row g-2 my-0">
                <?php
                    include_once "model/conexion.php";
                    $sentencia = $bd -> query( "SELECT * FROM galerias
                                                where id_galeria=$row->galerias_id_galeria");
                    $result_galeria = $sentencia->fetchAll(PDO::FETCH_OBJ);
                    foreach($result_galeria as $row_galeria){
                        $path= $row_galeria->ruta_galeria;
                        $path= str_replace("../../../../","",$path);
					    $dir = opendir($path);
                        $i = 1;
                        while ($elemento = readdir($dir)){
                            // Tratamos los elementos . y .. que tienen todas las carpetas
                            if( $elemento != "." && $elemento != ".."){
                                //Si es una carpeta
                                if(! is_dir($path.$elemento) ){
                                
                                    echo '
                                        
                                        <div class="col-4 col-md-3">
                                            <div class="card">
                                                <a title="" href="" data-bs-toggle="modal" data-bs-target="#galeriaModal'.$i.'">
                                                <img class="card-img-top" alt="" src="'.$path.'/' . $elemento . '"></a>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="galeriaModal'.$i.'" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                            <button type="button" class="btn-close mr-2" data-bs-dismiss="modal" aria-label="Close"></button>

                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <img class="rounded img-fluid" alt="" src="'.$path.'/' . $elemento . '">
                                            </div>
                                            </div>
                                        </div>
                                    
                                    ';
                                    $i += 1;
                                }
                            }
                        }
                    }
                ?>
            </div>

            <?php //end if galerias
                }
            ?>


            </div>

            <?php
			    //si estoy en todos los numeros tengo que mostrar las estadisticas
			    if ($row->id_categoria==23){
				    include("posiciones-t-l-n.php");
                    include("fixture-t-l-n.php");
                    include("goleadores-t-l-n.php");
			    }
		    ?>

            <?php
				if ($row->id_categoria!=23){
            ?>
            <div class="col-lg-3">
                <div class="row g-4">
            <?php
                include_once "model\conexion.php";
                $sentencia = $bd -> query("SELECT id_publicidad, archivo_publicidad, link_publicidad
                FROM notas
                left join  publicidades_posicionadas on publicidades_posicionadas.notas_id_nota=id_nota
                left join publicidades on id_publicidad=publicidades_posicionadas.publicidades_id_publicidad
                left join ubicaciones_publicidades on ubicaciones_id_ubicacion=id_ubicacion
                where id_nota=$id_nota and seccion='nota' 
                and (nombre_ubicacion='F1' or nombre_ubicacion='G1' or nombre_ubicacion='H1') and archivada=0
                group by id_publicidad");
                $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $row) {
            ?>
                
                <div class="col-lg-12 col-md-6">
                    <div class="card pb-3">
                        <a href="<?php echo $row->link_publicidad; ?>" target="_blank"><img src="img/publicidades/<?php echo $row->id_publicidad; ?>/<?php echo $row->archivo_publicidad; ?>" class="publi-nota"></a>
                    </div>
                </div>

            <?php
                }
                }
            ?>

                </div>
            <?php //end foreach
                }
            ?>

            </div>
        </div>

    </div>
</section>

<?php include 'template/footer.php' ?>