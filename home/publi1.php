<section class="pt-4 pb-0 card-grid">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">

            <?php
                include_once "model\conexion.php";
                $sentencia = $bd -> query("SELECT * 
                FROM publicidades_posicionadas
                LEFT JOIN publicidades ON publicidades_id_publicidad = id_publicidad
                LEFT JOIN ubicaciones_publicidades ON id_ubicacion=ubicaciones_id_ubicacion
                where seccion='home' AND nombre_ubicacion='A11' 
                order by RAND()
                LIMIT 0,1");
                $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $row) {
            ?>

                <div class="card">
                    <a href="<?php echo $row->link_publicidad;?>" target="_blank"><img src="img/publicidades/<?php echo $row->id_publicidad;?>/<?php echo $row->archivo_publicidad;?>" class="publi-small"></a>
                </div>

            <?php
                }
            ?>

            </div>
            <div class="col-lg-4">
                
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
                    <a href="<?php echo $row->link_publicidad;?>" target="_blank"><img src="img/publicidades/<?php echo $row->id_publicidad;?>/<?php echo $row->archivo_publicidad;?>" class="publi-small"></a>
                </div>

            <?php
                }
            ?>

            </div>
            <div class="col-lg-4">
                
            <?php
                include_once "model\conexion.php";
                $sentencia = $bd -> query("SELECT * 
                FROM publicidades_posicionadas
                LEFT JOIN publicidades ON publicidades_id_publicidad = id_publicidad
                LEFT JOIN ubicaciones_publicidades ON id_ubicacion=ubicaciones_id_ubicacion
                where seccion='home' AND nombre_ubicacion='A13' 
                order by RAND()
                LIMIT 0,1");
                $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
                foreach ($result as $row) {
            ?>

                <div class="card">
                    <a href="<?php echo $row->link_publicidad;?>" target="_blank"><img src="img/publicidades/<?php echo $row->id_publicidad;?>/<?php echo $row->archivo_publicidad;?>" class="publi-small"></a>
                </div>

            <?php
                }
            ?>

            </div>
        </div>
    </div>
</section>