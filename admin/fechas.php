<?php include 'template/header.php' ?>

<?php
    include_once("../model/conexion.php");
    $sentencia = $bd -> query( "SELECT fechas.id_fecha, fechas.nombre, fechas.fecha_fin as fecha_fin, fechas.fecha_inicio as fecha_inicio, torneos.nombre_torneo, fechas.fase 
    FROM fechas 
    left join torneos on torneos.id_torneo=fechas.torneos_id_torneo1  
    ORDER BY fechas.nombre");
    $fechas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container my-5">
    <div class="row justify-content-center g-4">   
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos
                </div>
                <form  class="p-4" method="POST" action="nuevo-fecha.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required>
                        <label class="form-label">Torneo: </label>
                        <select class="form-select" id="selectTorneo" name="cbTorneos">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaTorneos = $bd -> query( "select * from torneos;");
                            $torneos = $consultaTorneos->fetchAll(PDO::FETCH_OBJ);
                            foreach ($torneos as $opciones): 
                        ?>
                            <option value="<?php echo $opciones->id_torneo ?>"<?php if($opciones->id_torneo === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opciones->nombre_torneo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        
                        <label class="form-label">Fase (Juveniles): </label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault1" value="1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Fase 1
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault2" value="2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Fase 2
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault3" value="3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            Fase 3 (Semifinal)
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault4" value="4">
                        <label class="form-check-label" for="flexRadioDefault4">
                            Fase 4 (Final)
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault5" value="5">
                        <label class="form-check-label" for="flexRadioDefault5">
                            Fase 5 (Finalisima)
                        </label>
                        </div>
                        <label class="form-label">Fase (Menores): </label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault6" value="6">
                        <label class="form-check-label" for="flexRadioDefault6">
                            Fase 1
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault7" value="7">
                        <label class="form-check-label" for="flexRadioDefault7">
                            Fase 2
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault9" value="9">
                        <label class="form-check-label" for="flexRadioDefault9">
                            Final
                        </label>
                        </div>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div> 
        <div class="col-lg-8">

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
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'PartidosAsociados'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Posee partidos asociados.
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
                    Lista de Fechas
                </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Torneo</th>
                                <th scope="col">Fase</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($fechas as $dato){
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre; ?></td>
                                <td><?php echo $dato->nombre_torneo; ?></td>
                                <?php $fase= $dato->fase;
									if ($fase==1 or $fase==6){
										$fase= "Fase 1";
									}
									else if ($fase==2){
										$fase= "Fase 2 Juveniles";
									}
									else if ($fase==3){
										$fase= "Semifinal Juveniles (Fase 3)";
									}
									else if ($fase==4){
										$fase= "Final Juveniles";
									}
									else if ($fase==5){
										$fase= "Finalisima Juveniles";
									}
									else if ($fase==7){
										$fase= "Fase 2 Menores";
									}
									else if ($fase==8){
										$fase= "Torneo Clausura Menores";
									}
									else if ($fase==9){
										$fase= "Final Menores";
									}
                                ?>
									
                                <td><?php echo $fase ?></td>
                                <td><a class="text-success" href="editar-fecha.php?id_fecha=<?php echo $dato->id_fecha;?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="eliminar-fecha.php?id_fecha=<?php echo $dato->id_fecha;?>"><i class="bi bi-trash-fill"></i></a></td>
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