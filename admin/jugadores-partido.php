<?php include 'template/header.php' ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Jugadores Local
                </div>
                <form  class="p-4" method="POST" action="agregar-jugador-partido.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Jugadores: </label>
                        <select class="form-select" id="selectJugador" name="cbJugador">
                        <?php
                            $id_equipo = $_GET['id_equipo'];
                            include_once "../model/conexion.php";
                            $consultaJugadores = $bd -> query( "select * from jugadores where id_equipo = $id_equipo;");
                            $jugadores = $consultaJugadores->fetchAll(PDO::FETCH_OBJ);
                            foreach ($jugadores as $opcionesJugadores): 
                        ?>
                            <option value="<?php echo $opcionesJugadores->id_jugador ?>" <?php if($opcionesJugadores->id_jugador === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesJugadores->nombre_jugador ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                                                                    
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
                    Jugadores Visitante
                </div>
                <form  class="p-4" method="POST" action="agregar-jugador-partido.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Jugadores: </label>
                        <select class="form-select" id="selectJugador1" name="cbJugador1">
                        <?php
                            $id_equipo = $_GET['id_equipo1'];
                            include_once "../model/conexion.php";
                            $consultaJugadores = $bd -> query( "select * from jugadores where id_equipo = $id_equipo;");
                            $jugadores = $consultaJugadores->fetchAll(PDO::FETCH_OBJ);
                            foreach ($jugadores as $opcionesJugadores): 
                        ?>
                            <option value="<?php echo $opcionesJugadores->id_jugador ?>" <?php if($opcionesJugadores->id_jugador === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesJugadores->nombre_jugador ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                                                                    
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
                    Jugadores
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">Equipo</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($jugadores as $dato){
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre_jugador; ?></td>
                                <td><?php echo $dato->fecha_nacimiento; ?></td>
                                <td><?php echo $dato->nombre_equipo; ?></td>
                                <td style="text-align: center;"><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="eliminar-jugador.php?id_jugador=<?php echo $dato->id_jugador;?>"><i class="bi bi-trash-fill"></i></a></td>
                            </tr>

                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'template/footer.php' ?>