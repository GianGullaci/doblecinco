<?php include 'template/header.php' ?>

<?php
    include_once "../model/conexion.php";
    $sentencia = $bd -> query( "select id_fecha, nombre_fecha, torneos.nombre_torneo, fase
                                from fechas
                                inner join torneos
                                on fechas.id_torneo=torneos.id_torneo;");
    $fechas = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
                                <td><?php echo $dato->nombre_fecha; ?></td>
                                <td><?php echo $dato->nombre_torneo; ?></td>
                                <td><?php echo $dato->fase; ?></td>
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
        <div class="col-md-5">
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
                        <label class="form-label">Fase: </label>
                        <select multiple="" class="form-select" id="selectFase" name="txtFase">
                            <option selected><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1</font></font></option>
                            <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2</font></font></option>
                            <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3</font></font></option>
                            <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4</font></font></option>
                            <option><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5</font></font></option>
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
</div>

<?php include 'template/footer.php' ?>