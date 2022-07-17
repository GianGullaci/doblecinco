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
                        value="<?php echo $fecha->nombre_fecha; ?>">
                        <label class="form-label">Torneo: </label>
                        <select class="form-select" id="selectTorneo" name="cbTorneos">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaTorneos = $bd -> query( "select * from torneos;");
                            $torneos = $consultaTorneos->fetchAll(PDO::FETCH_OBJ);
                            foreach ($torneos as $opciones): 
                        ?>
                            <option value="<?php echo $opciones->id_torneo ?>"<?php if($opciones->id_torneo === $fecha->id_torneo){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opciones->nombre_torneo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Fase: </label>
                        <select multiple="" class="form-select" id="selectFase" name="txtFase">
                            <option value="1" <?php if($fecha->fase === "1"){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1</font></font></option>
                            <option value="2" <?php if($fecha->fase === "2"){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2</font></font></option>
                            <option value="3" <?php if($fecha->fase === "3"){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3</font></font></option>
                            <option value="4" <?php if($fecha->fase === "4"){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4</font></font></option>
                            <option value="5" <?php if($fecha->fase === "5"){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5</font></font></option>
                        </select>
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