<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['id_fecha'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_fecha = $_GET['id_fecha'];

    $sentencia = $bd->prepare("select * from fechas where id_fecha = ?;");
    $sentencia->execute([$id_fecha]);
    $fecha = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-fecha-proceso.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required 
                        value="<?php echo $fecha->nombre; ?>">
                        <label class="form-label">Torneo: </label>
                        <select class="form-select" id="selectTorneo" name="cbTorneos">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaTorneos = $bd -> query( "select * from torneos;");
                            $torneos = $consultaTorneos->fetchAll(PDO::FETCH_OBJ);
                            foreach ($torneos as $opciones): 
                        ?>
                            <option value="<?php echo $opciones->id_torneo ?>"<?php if($opciones->id_torneo === $fecha->torneos_id_torneo1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opciones->nombre_torneo ?></font></font></option>
                        <?php endforeach ?>
                        </select>

                        <label class="form-label">Fase (Juveniles): </label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault1" value="1" <?php if($fecha->fase === "1"){ echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Fase 1
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault2" value="2" <?php if($fecha->fase === "2"){ echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Fase 2
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault3" value="3" <?php if($fecha->fase === "3"){ echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault3">
                            Fase 3 (Semifinal)
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault4" value="4" <?php if($fecha->fase === "4"){ echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault4">
                            Fase 4 (Final)
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault5" value="5" <?php if($fecha->fase === "5"){ echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault5">
                            Fase 5 (Finalisima)
                        </label>
                        </div>
                        <label class="form-label">Fase (Menores): </label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault6" value="6" <?php if($fecha->fase === "6"){ echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault6">
                            Fase 1
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault7" value="7" <?php if($fecha->fase === "7"){ echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault7">
                            Fase 2
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="txtFase" id="flexRadioDefault9" value="9" <?php if($fecha->fase === "9"){ echo 'checked';} ?>>
                        <label class="form-check-label" for="flexRadioDefault9">
                            Final
                        </label>
                        </div>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_fecha" value="<?php echo $fecha->id_fecha; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>