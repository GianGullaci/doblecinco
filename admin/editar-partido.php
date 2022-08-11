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
    partidos.face_album as face_album, partidos.flickr_album as flickr_album,
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
    $partido = $sentencia->fetch(PDO::FETCH_OBJ);
?>


<div class="container mt-5">
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
                        <?php
                            include_once "../model/conexion.php";
                            $consultaTorneo = $bd -> query( "select * from torneos where id_torneo = '$id_torneo->id_torneo';");
                            $torneo = $consultaTorneo->fetchAll(PDO::FETCH_OBJ);
                            foreach ($torneo as $opcionesTorneo): 
                        ?>
                            <option value="<?php echo $opcionesTorneo->id_torneo ?>" <?php if($opcionesTorneo->id_torneo === $id_torneo->id_torneo){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesTorneo->nombre_torneo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        
                        <label class="form-label">Fecha: </label>
                        <select class="form-select" id="selectFecha" name="cbFecha">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaFechas = $bd -> query( "select * from fechas where id_torneo = '$id_torneo->id_torneo';");
                            $fechas = $consultaFechas->fetchAll(PDO::FETCH_OBJ);
                            foreach ($fechas as $opcionesFechas): 
                        ?>
                            <option value="<?php echo $opcionesFechas->id_fecha ?>" <?php if($opcionesFechas->id_fecha === $fechaPartido->id_fecha){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesFechas->nombre_fecha ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        
                        <label class="form-label">Zona: </label>
                        <select class="form-select" id="selectZona" name="cbZona">
                            <option value="1" <?php if($partido->zona === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Zona A</font></font></option>
                            <option value="2" <?php if($partido->zona === 2){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Zona B</font></font></option>
                        </select>
                        
                        <label class="form-label">Día: </label>
                        <input type="date" class="form-control" name="txtDia" value="<?php echo $partido->fecha_partido; ?>" required>
                        <label class="form-label">Hora: </label>
                        <input type="time" class="form-control" name="txtHora" value="<?php echo $partido->hora_partido; ?>" required>

                        <label class="form-label">Equipo Local: </label>
                        <select class="form-select" id="selectEquipo" name="cbEquipo">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaEquipo = $bd -> query( "select * from equipos;");
                            $equipos = $consultaEquipo->fetchAll(PDO::FETCH_OBJ);
                            foreach ($equipos as $opcionesEquipo): 
                        ?>
                            <option value="<?php echo $opcionesEquipo->id_equipo ?>" <?php if($opcionesEquipo->id_equipo === $partido->id_equipo){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesEquipo->nombre_equipo ?></font></font></option>
                        <?php endforeach ?>
                        </select>

                        <label class="form-label">Equipo Visitante: </label>
                        <select class="form-select" id="selectEquipo1" name="cbEquipo1">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaEquipo = $bd -> query( "select * from equipos;");
                            $equipos = $consultaEquipo->fetchAll(PDO::FETCH_OBJ);
                            foreach ($equipos as $opcionesEquipo): 
                        ?>
                            <option value="<?php echo $opcionesEquipo->id_equipo ?>" <?php if($opcionesEquipo->id_equipo === $partido->id_equipo1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesEquipo->nombre_equipo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_partido" value="<?php echo $partido->id_partido; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>