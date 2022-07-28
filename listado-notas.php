<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $id_categoria = $_GET['id'];
    $sentencia = $bd -> query("SELECT cat_padre.color_categoria as color_categoria, cat.nombre_categoria AS nombre_categoria, cat.id_categoria_notas AS id_categoria, 
    cat_padre.nombre_categoria AS nombre_categoria_padre, cat_padre.id_categoria_notas AS id_categoria_padre
    FROM categorias_notas AS cat 
    LEFT JOIN categorias_notas AS cat_padre ON cat_padre.id_categoria_notas = cat.categorias_notas_id_categoria_notas
    where cat.id_categoria_notas=$id_categoria");
    $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="img-category">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php foreach ($result as $row){?>
                    <div class="w-100 mt-auto position-absolute bottom-0">
                        <p class="fs-1 fw-bold text-white mb-0"><?php echo $row->nombre_categoria;?></p>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

<section class="pt-4 pb-0 card-grid">
    <div class="container">
        <div class="row g-4">

            <?php
                include_once "model/conexion.php";
                $sentencia2 = $bd -> query("SELECT id_nota, titulo_nota, copete, bajada, imagen_principal, imagen_celular, cat.nombre_categoria as categoria, cat_padre.color_categoria as color_categoria, id_autor, nombre_autor, titulo_autor, foto, 
                cat.nombre_categoria AS nombre_categoria, cat.id_categoria_notas AS id_categoria, cat_padre.nombre_categoria AS nombre_categoria_padre, fecha_nota, 
                cat_padre.id_categoria_notas AS id_categoria_padre
                FROM notas
                LEFT JOIN categorias_notas AS cat ON cat.id_categoria_notas = notas.categorias_notas_id_categoria_notas
                LEFT JOIN categorias_notas AS cat_padre ON cat_padre.id_categoria_notas = cat.categorias_notas_id_categoria_notas
                LEFT JOIN autores ON autores.id_autor = notas.autores_id_autor
                where cat.id_categoria_notas=$id_categoria 
                order by notas.id_nota desc");
                $result2 = $sentencia2->fetchAll(PDO::FETCH_OBJ);
                foreach ($result2 as $row2) {
                    $path = "img/notas/".$row2->id_nota."/".$row2->imagen_celular;
                    if (is_file($path)) {
            ?>

            <div class="col-lg-4 col-xs-6">
                <div class="card border">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="img/notas/<?php echo $row2->id_nota; ?>/<?php echo $row2->imagen_celular; ?>" class="img-list rounded-start" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="" class="badge bg-secondary bg-gradient bg-opacity-75">
                                    <font style="vertical-align: inherit;"><?php echo $row2->categoria; ?></font>
                                </a>
                                <h4 class="text-white fw-bolder">
                                    <a href="nota.php?id=<?php echo $row2->id_nota; ?>" class="stretched-link text-reset badge bg-secondary bg-gradient bg-opacity-75" style="white-space: initial; overflow: hidden;text-align:left;">
                                        <font style="vertical-align: inherit;"><?php echo $row2->titulo_nota; ?></font>  
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>



                    
                    
                </div>
            </div>

            <?php
            }
                }
            ?>
            
        </div>
    </div>
</section>

<?php include 'template/footer.php' ?>