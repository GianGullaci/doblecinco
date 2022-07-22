<section class="pt-4 pb-0 card-grid">
    <div class="container">

    <?php
        include_once "model\conexion.php";
        $sentencia = $bd -> query("SELECT * 
		FROM publicidades_posicionadas
		LEFT JOIN publicidades ON publicidades_id_publicidad = id_publicidad
		LEFT JOIN ubicaciones_publicidades ON id_ubicacion=ubicaciones_id_ubicacion
		where seccion='home' AND nombre_ubicacion='B1' 
		order by RAND()
		LIMIT 0,1");
        $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $row) {
    ?>

        <div class="card">
            <img src="img/publicidades/<?php echo $row->id_publicidad;?>/<?php echo $row->archivo_publicidad;?>" class="publi-alargada">
        </div>

    <?php
        }
    ?>

    </div>
</section>