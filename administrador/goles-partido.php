<?php include 'template/header.php' ?>

<?php
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
            $dia = date("d-m-Y", $time);
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

    if (isset($_POST['cbGolLocal'])){
        $id_jugador = $_POST['cbGolLocal'];
        if (isset($_POST['contraL'])) {
            $contraL = $_POST['contraL'];
        } else{
            $contraL = 0;
        }
        $sentencia = $bd->prepare("INSERT INTO goles_partidos (partidos_id_partido, jugadores_id_jugador, equipos_id_equipo, en_contra) VALUES (?,?,?,?);");
        $resultado = $sentencia->execute([$id_partido,$id_jugador,$id_equipo_local,$contraL]);
        if ($resultado === TRUE) {
            header("location: goles-partido.php?id_partido=".$id_partido."&mensaje=registrado");
        } else {
            header("location: goles-partido.php?id_partido=".$id_partido."&mensaje=error");
            exit();
        }
    }

    if (isset($_POST['cbGolVisitante'])){
        $id_jugador = $_POST['cbGolVisitante'];
        if (isset($_POST['contraV'])) {
            $contraV = $_POST['contraV'];
        } else{
            $contraV = 0;
        }
        $sentencia = $bd->prepare("INSERT INTO goles_partidos (partidos_id_partido, jugadores_id_jugador, equipos_id_equipo, en_contra) VALUES (?,?,?,?);");
        $resultado = $sentencia->execute([$id_partido,$id_jugador,$id_equipo_visitante,$contraV]);
        if ($resultado === TRUE) {
            header("location: goles-partido.php?id_partido=".$id_partido."&mensaje=registrado");
        } else {
            header("location: goles-partido.php?id_partido=".$id_partido."&mensaje=error");
            exit();
        }
    }

    if (isset($_GET['id_gol'])) {
        $id_gol = $_GET['id_gol'];
        $sentencia = $bd->prepare("DELETE FROM goles_partidos 
        WHERE id_goles_partidos= ?;");
        $resultado = $sentencia->execute([$id_gol]);

        if ($resultado === TRUE) {
            header("location: goles-partido.php?id_partido=".$id_partido."&mensaje=eliminado");
        } else {
            header("location: goles-partido.php?id_partido=".$id_partido."&mensaje=error");
            exit();
        }
    }
?>

<div class="container my-5">
    <div class="row justify-content-center">
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">          
                <strong>Registrado!</strong> Se agregaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Vuelve a intentar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">          
                <strong>Eliminado!</strong> Se eliminaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Jugadores <?php echo $nombre_equipo_local ?>
                </div>
                <form  class="p-4" method="POST" action="#" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Jugador: </label>
                        <select class="form-select" id="selectGolLocal" name="cbGolLocal">
                        <?php
                            $consultaJugadores = $bd -> query( "SELECT * FROM jugadores_partidos 
                            left join partidos on jugadores_partidos.partidos_id_partido=partidos.id_partido
                            left join jugadores on jugadores.id_jugador=jugadores_partidos.jugadores_id_jugador
                            where jugadores_partidos.equipos_id_equipo=$id_equipo_local
                            AND partidos.id_partido=$id_partido
                            order by nombre_jugador;");
                            $jugadores = $consultaJugadores->fetchAll(PDO::FETCH_OBJ);
                            foreach ($jugadores as $opcionesJugadores): 
                        ?>
                            <option value="<?php echo $opcionesJugadores->id_jugador ?>" <?php if($opcionesJugadores->id_jugador === 0){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesJugadores->nombre_jugador ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">En Contra: </label>
                        <input class="form-check-input" type="checkbox" value="1" id="contraL" name="contraL">
                                                                    
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Jugadores <?php echo $nombre_equipo_visitante ?>
                </div>
                <form  class="p-4" method="POST" action="#" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Jugador: </label>
                        <select class="form-select" id="selectGolVisitante" name="cbGolVisitante">
                        <?php
                            $consultaJugadores = $bd -> query( "SELECT * FROM jugadores_partidos 
                            left join partidos on jugadores_partidos.partidos_id_partido=partidos.id_partido
                            left join jugadores on jugadores.id_jugador=jugadores_partidos.jugadores_id_jugador
                            where jugadores_partidos.equipos_id_equipo=$id_equipo_visitante
                            AND partidos.id_partido=$id_partido
                            order by nombre_jugador;");
                            $jugadores = $consultaJugadores->fetchAll(PDO::FETCH_OBJ);
                            foreach ($jugadores as $opcionesJugadores): 
                        ?>
                            <option value="<?php echo $opcionesJugadores->id_jugador ?>" <?php if($opcionesJugadores->id_jugador === 0){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesJugadores->nombre_jugador ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">En Contra: </label>
                        <input class="form-check-input" type="checkbox" value="1" id="contraV" name="contraV">
                                                                    
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    Goles Cargados
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Equipo</th>
                                <th scope="col">En Contra</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $consultaGolesPartido = $bd -> query( "SELECT id_goles_partidos as id_gol, goles_partidos.hora as hora, nombre_jugador, nombre_club, en_contra
								FROM goles_partidos
								left join jugadores on jugadores.id_jugador=goles_partidos.jugadores_id_jugador
								left join equipos on equipos.id_equipo=goles_partidos.equipos_id_equipo
								left join clubes on clubes.id_club=equipos.clubes_id_club
								where partidos_id_partido=$id_partido;");
                                $golesPartido = $consultaGolesPartido->fetchAll(PDO::FETCH_OBJ);
                                foreach ($golesPartido as $opcionesGolesPartido): 
                            ?>

                            <tr>
                                <td><?php echo $opcionesGolesPartido->nombre_jugador; ?></td>
                                <td><?php echo $opcionesGolesPartido->nombre_club; ?></td>
                                <?php 
                                    if ($opcionesGolesPartido->en_contra==1){
										echo "<td><span class='label label-important'>SI</span></td>";
									}
									else{
										echo "<td>NO</td>";
									}
                                ?>
                                <td style="text-align: center;"><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="?id_partido=<?php echo $id_partido;?>&id_gol=<?php echo $opcionesGolesPartido->id_gol;?>"><i class="bi bi-trash-fill"></i></a></td>
                            </tr>

                            <?php
                                endforeach
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'template/footer.php' ?>