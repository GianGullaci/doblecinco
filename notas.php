<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $id_nota = $_GET['id'];
    $sentencia = $bd -> query( "select * from notas where id_nota = $id_nota");
    $notas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<section class="pt-2">
    <div class="container">
        <div class="row">
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
                echo base64_decode($row->texto_nota)
            ?>

            <?php
                if (($row->galerias_id_galeria)!=0){
            ?>

            <div class="row g-2 my-0">
                <h3 style="font-size:19px;"><?php echo $row->titulo_galeria;?></h3>
                <?php
                    include_once "model/conexion.php";
                    $sentencia = $bd -> query( "SELECT * FROM galerias
                                                where id_galeria=$row->galerias_id_galeria");
                    $result_galeria = $sentencia->fetchAll(PDO::FETCH_OBJ);
                    foreach($result_galeria as $row_galeria){
                        $path= $row_galeria->ruta_galeria;
                        $path= str_replace("../../../../","",$path);
					    $dir = opendir($path);
                        while ($elemento = readdir($dir)){
                            // Tratamos los elementos . y .. que tienen todas las carpetas
                            if( $elemento != "." && $elemento != ".."){
                                //Si es una carpeta
                                if(! is_dir($path.$elemento) ){
                                
                                    echo '
                                        
                                        <div class="col-6 col-md-3">
                                            <div class="card">
                                                <a title="" data-fancybox-group="gallery" href="'.$path.'/' . $elemento . '" style="display: inline; opacity: 0;"></a>
                                                <img class="rounded h-75 w-75" alt="" src="'.$path.'/' . $elemento . '">
                                            </div>
                                        </div>
                                    
                                    ';
                                }
                            }
                        }
                    }
                ?>
            </div>

            <?php //end if galerias
                }
            ?>

            <?php //end foreach
                }
            ?>
            </div>
            <div class="col-lg-3">

            <?php
                include_once "model\conexion.php";
                $sentencia = $bd -> query("SELECT * 
                FROM publicidades_posicionadas
                LEFT JOIN publicidades ON publicidades_id_publicidad = id_publicidad
                LEFT JOIN ubicaciones_publicidades ON id_ubicacion=ubicaciones_id_ubicacion
                where seccion='home' AND nombre_ubicacion='A12' 
                order by RAND()
                LIMIT 0,1");
                $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $row) {
            ?>

                <div class="card">
                    <a href="<?php echo $row->link_publicidad;?>" target="_blank"><img src="img/publicidades/<?php echo $row->id_publicidad;?>/<?php echo $row->archivo_publicidad;?>" class="publi-nota"></a>
                </div>

            <?php
                }
            ?>

            </div>
        </div>
    </div>
</section>

<?php include 'template/footer.php' ?>