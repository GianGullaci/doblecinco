<?php include 'template/header.php' ?>

<?php
    include_once "../model/conexion.php";
    $sentencia = $bd -> query( "select id_partido, torneos.nombre_torneo, fechas.nombre_fecha, zona, fecha_partido, hora_partido, e1.id_equipo id_local, e2.id_equipo id_visitante, e1.nombre_equipo local, e2.nombre_equipo visitante
                                from partidos 
                                inner join fechas on partidos.id_fecha = fechas.id_fecha 
                                inner join torneos on torneos.id_torneo = fechas.id_torneo 
                                inner join equipos e1 on e1.id_equipo = partidos.id_equipo 
                                inner join equipos e2 on e2.id_equipo = partidos.id_equipo1;");
    $partidos = $sentencia->fetchAll(PDO::FETCH_OBJ);    
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

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
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'equiposIguales'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Los equipos no pueden ser iguales.
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
                    Lista de Partidos
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Torneo</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Zona</th>
                                <th scope="col">Día</th>
                                <th scope="col">Local</th>
                                <th scope="col">Visitante</th>
                                <th scope="col" colspan="4">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($partidos as $dato){
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre_torneo; ?></td>
                                <td><?php echo $dato->nombre_fecha; ?></td>
                                <td><?php echo $dato->zona; ?></td>
                                <td><?php echo $dato->fecha_partido; ?></td>
                                <td><?php echo $dato->local; ?></td>
                                <td><?php echo $dato->visitante; ?></td>
                                <td><a class="text-success" href="editar-partido.php?id_partido=<?php echo $dato->id_partido;?>"><i class="bi bi-pencil-square"></i></a></td>

                                <td><a class="text-success" href="jugadores-partido.php?id_partido=<?php echo $dato->id_partido;?>&id_equipo=<?php echo $dato->id_local;?>&id_equipo1=<?php echo $dato->id_visitante;?>"><i class="bi bi-person"></i></a></td>

                                <td><a class="text-success" href="goles-partido.php?id_partido=<?php echo $dato->id_partido;?>"><i class="bi bi-dribbble"></i></a></td>

                                <td><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="eliminar-partido.php?id_partido=<?php echo $dato->id_partido;?>"><i class="bi bi-trash-fill"></i></a></td>
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
                <form  class="p-4" method="POST" action="nuevo-partido.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Torneo: </label>
                        <select class="form-select" id="selectTorneo" name="cbTorneo">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaTorneo = $bd -> query( "select * from torneos;");
                            $torneos = $consultaTorneo->fetchAll(PDO::FETCH_OBJ);
                            foreach ($torneos as $opcionesTorneo): 
                        ?>
                            <option value="<?php echo $opcionesTorneo->id_torneo ?>" <?php if($opcionesTorneo->id_torneo === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesTorneo->nombre_torneo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        
                        <label class="form-label">Fecha: </label>
                        <select class="form-select" id="selectFecha" name="cbFecha">
                        </select>
                        
                        <label class="form-label">Zona: </label>
                        <select class="form-select" id="selectZona" name="cbZona">
                            <option value="1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Zona A</font></font></option>
                            <option value="2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Zona B</font></font></option>
                        </select>
                        
                        <label class="form-label">Día: </label>
                        <input type="date" class="form-control" name="txtDia" required>
                        <label class="form-label">Hora: </label>
                        <input type="time" class="form-control" name="txtHora" required>

                        <label class="form-label">Equipo Local: </label>
                        <select class="form-select" id="selectEquipo" name="cbEquipo">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaEquipo = $bd -> query( "select * from equipos;");
                            $equipos = $consultaEquipo->fetchAll(PDO::FETCH_OBJ);
                            foreach ($equipos as $opcionesEquipo): 
                        ?>
                            <option value="<?php echo $opcionesEquipo->id_equipo ?>" <?php if($opcionesEquipo->id_equipo === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesEquipo->nombre_equipo ?></font></font></option>
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
                            <option value="<?php echo $opcionesEquipo->id_equipo ?>" <?php if($opcionesEquipo->id_equipo === 1){ echo 'selected = "selected"';}?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesEquipo->nombre_equipo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <div id="mensaje"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        recargarFecha();

        $('#selectTorneo').change(function(){
            recargarFecha();
        });
    })
</script>
<script type="text/javascript">
    function recargarFecha(){
        $.ajax({
            type:"POST",
            url:"recargo-fecha.php",
            data:"torneo=" + $('#selectTorneo').val(),
            success:function(r){
                $('#selectFecha').html(r);
            }
        });
    }
</script>


<?php include 'template/footer.php' ?>