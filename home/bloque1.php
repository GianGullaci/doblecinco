<section class="pt-4 pb-0 card-grid">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">

                <?php
                    include_once "model\conexion.php";
                    $sentencia = $bd -> query("SELECT padre.nombre_categoria as nombre_padre, cat.nombre_categoria as categoria, 
					id_nota, titulo_nota, padre.color_categoria as color,  cat.color_categoria as color_cat, imagen_celular, cat.foto_columna as foto_columna,
					cat.id_categoria_notas as id_categoria, padre.id_categoria_notas as id_padre,cat.color_categoria as color_cat 
					FROM notas
					LEFT JOIN categorias_notas as cat ON notas.categorias_notas_id_categoria_notas = cat.id_categoria_notas
					LEFT JOIN categorias_notas as padre ON cat.categorias_notas_id_categoria_notas = padre.id_categoria_notas
					where bloque_home=1
					ORDER BY orden_bloque ASC 
					LIMIT 0 , 1");
                    $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
                    foreach ($result as $row) {
                ?>
                
                <div class="card">
                    <img src="img/notas/<?php echo $row->id_nota;?>/<?php echo $row->imagen_celular;?>" class="img-grande" alt="">
                    <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                        <div class="w-100 mt-auto">
                            <a href="" class="badge bg-secondary bg-gradient mb-2 bg-opacity-75">
                                <font style="vertical-align: inherit;"><?php echo $row->categoria;?></font>
                            </a>
                            <h2 class="text-white fw-bolder">
                                <a href="notas.php?id=<?php echo $row->id_nota;?>" class="stretched-link text-reset badge bg-secondary bg-gradient bg-opacity-75" style="white-space: initial; overflow: hidden;text-align:left;">
                                    <font style="vertical-align: inherit;"><?php echo $row->titulo_nota;?></font>  
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>

                <?php
}
                ?>

            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-md-6">

                    <?php
                        include_once "model\conexion.php";
                        $sentencia = $bd -> query("SELECT padre.nombre_categoria as nombre_padre, cat.nombre_categoria as categoria, 
                        id_nota, titulo_nota, fecha_nota, padre.color_categoria as color,  cat.color_categoria as color_cat, imagen_home, imagen_celular, cat.foto_columna as foto_columna,
                        cat.id_categoria_notas as id_categoria, padre.id_categoria_notas as id_padre,cat.color_categoria as color_cat 
                        FROM notas
                        LEFT JOIN categorias_notas as cat ON notas.categorias_notas_id_categoria_notas = cat.id_categoria_notas
                        LEFT JOIN categorias_notas as padre ON cat.categorias_notas_id_categoria_notas = padre.id_categoria_notas
                        where bloque_home=1
                        ORDER BY orden_bloque ASC 
                        LIMIT 1 , 1");
                        $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($result as $row) {
                    ?>

                    <div class="card">
                        <img src="img/notas/<?php echo $row->id_nota;?>/<?php echo $row->imagen_celular;?>" class="img-pequeña" alt="">
                        <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                            <div class="w-100 mt-auto">
                            <a href="" class="badge bg-secondary bg-gradient mb-2 bg-opacity-75">
                                    <font style="vertical-align: inherit;"><?php echo $row->categoria;?></font>
                                </a>
                                <h4 class="text-white fw-bolder">
                                    <a href="notas.php?id=<?php echo $row->id_nota;?>" class="stretched-link text-reset badge bg-secondary bg-gradient bg-opacity-75" style="white-space: initial; overflow: hidden;text-align:left;">
                                        <font style="vertical-align: inherit;"><?php echo $row->titulo_nota;?></font>  
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    ?> 

                    </div>
                    <div class="col-md-6">

                    <?php
                        include_once "model\conexion.php";
                        $sentencia = $bd -> query("SELECT padre.nombre_categoria as nombre_padre, cat.nombre_categoria as categoria, 
                        id_nota, titulo_nota, fecha_nota, padre.color_categoria as color,  cat.color_categoria as color_cat, imagen_home, imagen_celular, cat.foto_columna as foto_columna,
                        cat.id_categoria_notas as id_categoria, padre.id_categoria_notas as id_padre,cat.color_categoria as color_cat 
                        FROM notas
                        LEFT JOIN categorias_notas as cat ON notas.categorias_notas_id_categoria_notas = cat.id_categoria_notas
                        LEFT JOIN categorias_notas as padre ON cat.categorias_notas_id_categoria_notas = padre.id_categoria_notas
                        where bloque_home=1
                        ORDER BY orden_bloque ASC 
                        LIMIT 2 , 1");
                        $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($result as $row) {
                    ?>

                    <div class="card">
                        <img src="img/notas/<?php echo $row->id_nota;?>/<?php echo $row->imagen_celular;?>" class="img-pequeña" alt="">
                        <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                            <div class="w-100 mt-auto">
                                <a href="" class="badge bg-secondary bg-gradient mb-2 bg-opacity-75">
                                    <font style="vertical-align: inherit;"><?php echo $row->categoria;?></font>
                                </a>
                                <h4 class="text-white fw-bolder">
                                    <a href="notas.php?id=<?php echo $row->id_nota;?>" class="stretched-link text-reset badge bg-secondary bg-gradient bg-opacity-75" style="white-space: initial; overflow: hidden;text-align:left;">
                                        <font style="vertical-align: inherit;"><?php echo $row->titulo_nota;?></font>  
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    ?> 

                    </div>
                    <div class="col-12">

                    <?php
                        include_once "model\conexion.php";
                        $sentencia = $bd -> query("SELECT padre.nombre_categoria as nombre_padre, cat.nombre_categoria as categoria, 
                        id_nota, titulo_nota, fecha_nota, padre.color_categoria as color,  cat.color_categoria as color_cat, imagen_home, imagen_celular, imagen_principal, cat.foto_columna as foto_columna,
                        cat.id_categoria_notas as id_categoria, padre.id_categoria_notas as id_padre,cat.color_categoria as color_cat 
                        FROM notas
                        LEFT JOIN categorias_notas as cat ON notas.categorias_notas_id_categoria_notas = cat.id_categoria_notas
                        LEFT JOIN categorias_notas as padre ON cat.categorias_notas_id_categoria_notas = padre.id_categoria_notas
                        where bloque_home=1
                        ORDER BY orden_bloque ASC 
                        LIMIT 3 , 1");
                        $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        foreach ($result as $row) {
                    ?>

                        <div class="card">
                            <img src="img/notas/<?php echo $row->id_nota;?>/<?php echo $row->imagen_principal;?>" class="img-pequeña" alt="">
                            <div class="card-img-overlay d-flex align-items-center p-3 p-sm-4">
                                <div class="w-100 mt-auto">
                                    <a href="" class="badge bg-secondary bg-gradient mb-2 bg-opacity-75">
                                        <font style="vertical-align: inherit;"><?php echo $row->categoria;?></font>
                                    </a>
                                    <h4 class="text-white fw-bolder">
                                        <a href="notas.php?id=<?php echo $row->id_nota;?>" class="stretched-link text-reset badge bg-secondary bg-gradient bg-opacity-75" style="white-space: initial; overflow: hidden;text-align:left;">
                                            <font style="vertical-align: inherit;"><?php echo $row->titulo_nota;?></font>  
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>

                    <?php
                        }
                    ?> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>