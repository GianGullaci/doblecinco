<?php include 'template/header.php' ?>

<?php
    include_once "../model/conexion.php";
    $sentencia = $bd -> query( "select id_jugador, nombre_jugador, fecha_nacimiento, 
                                ciudades.nombre, puesto.nombre_puesto, pierna_habil.nombre_pierna, equipos.nombre_equipo
                                from jugadores
                                inner join ciudades on jugadores.id_ciudad = ciudades.id_ciudad
                                inner join puesto on jugadores.id_puesto = puesto.id_puesto
                                inner join pierna_habil on jugadores.id_pierna_habil = pierna_habil.id_pierna_habil
                                inner join equipos on jugadores.id_equipo = equipos.id_equipo;");
    $jugadores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <!-- inicio alerta-->
            
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Falta ingresar el nombre
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

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
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">          
                <strong>Editado!</strong> Se editaron los datos
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

            <!-- fin alerta-->


            <div class="card">
                <div class="card-header">
                    Lista de Jugadores
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">Equipo</th>
                                <th scope="col">Posición</th>
                                <th scope="col" colspan="2">Opciones</th>
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
                                <td><?php echo $dato->nombre_puesto; ?></td>
                                <td><a class="text-success" href="editar-jugador.php?id_jugador=<?php echo $dato->id_jugador;?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="eliminar-jugador.php?id_jugador=<?php echo $dato->id_jugador;?>"><i class="bi bi-trash-fill"></i></a></td>
                            </tr>

                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Ingresar datos
                </div>
                <form  class="p-4" method="POST" action="nuevo-jugador.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required>
                        <label class="form-label">Fecha Nacimiento: </label>
                        <input type="date" class="form-control" name="txtFecha" autofocus required>
                        <label class="form-label">Ciudad: </label>
                        <select class="form-select" id="selectCiudad" name="cbCiudad">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaCiudad = $bd -> query( "select * from ciudades;");
                            $ciudades = $consultaCiudad->fetchAll(PDO::FETCH_OBJ);
                            foreach ($ciudades as $opcionesCiudad): 
                        ?>
                            <option value="<?php echo $opcionesCiudad->id_ciudad ?>" <?php if($opcionesCiudad->id_ciudad === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCiudad->nombre_ciudad ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Puesto: </label>
                        <select class="form-select" id="selectPuesto" name="cbPuesto">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaPuesto = $bd -> query( "select * from puesto;");
                            $puestos = $consultaPuesto->fetchAll(PDO::FETCH_OBJ);
                            foreach ($puestos as $opcionesPuesto): 
                        ?>
                            <option value="<?php echo $opcionesPuesto->id_puesto ?>" <?php if($opcionesPuesto->id_puesto === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPuesto->nombre_puesto ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Pierna Hábil: </label>
                        <select class="form-select" id="selectPierna" name="cbPierna">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaPierna = $bd -> query( "select * from pierna_habil;");
                            $piernas = $consultaPierna->fetchAll(PDO::FETCH_OBJ);
                            foreach ($piernas as $opcionesPierna): 
                        ?>
                            <option value="<?php echo $opcionesPierna->id_pierna_habil ?>" <?php if($opcionesPierna->id_pierna_habil === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPierna->nombre_pierna ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Equipo: </label>
                        <select class="form-select" id="selectEquipo" name="cbEquipo">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaEquipos = $bd -> query( "select * from equipos;");
                            $equipos = $consultaEquipos->fetchAll(PDO::FETCH_OBJ);
                            foreach ($equipos as $opcionesEquipos): 
                        ?>
                            <option value="<?php echo $opcionesEquipos->id_equipo ?>" <?php if($opcionesEquipos->id_equipo === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesEquipos->nombre_equipo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="<?php echo $partido->id_partido; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>