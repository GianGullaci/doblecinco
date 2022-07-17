<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['id_jugador'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_jugador = $_GET['id_jugador'];

    $sentencia = $bd->prepare("select * from jugadores where id_jugador = ?;");
    $sentencia->execute([$id_jugador]);
    $jugador = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-jugador-proceso.php" enctype="multipart/form-data">
                <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" value="<?php echo $jugador->nombre_jugador; ?>" autofocus required>
                        <label class="form-label">Fecha Nacimiento: </label>
                        <input type="date" class="form-control" name="txtFecha" value="<?php echo $jugador->fecha_nacimiento; ?>" autofocus required>
                        <label class="form-label">Ciudad: </label>
                        <select class="form-select" id="selectCiudad" name="cbCiudad">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaCiudad = $bd -> query( "select * from ciudades;");
                            $ciudades = $consultaCiudad->fetchAll(PDO::FETCH_OBJ);
                            foreach ($ciudades as $opcionesCiudad): 
                        ?>
                            <option value="<?php echo $opcionesCiudad->id_ciudad ?>" <?php if($opcionesCiudad->id_ciudad === $jugador->id_ciudad){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCiudad->nombre_ciudad ?></font></font></option>
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
                            <option value="<?php echo $opcionesPuesto->id_puesto ?>" <?php if($opcionesPuesto->id_puesto === $jugador->id_puesto){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPuesto->nombre_puesto ?></font></font></option>
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
                            <option value="<?php echo $opcionesPierna->id_pierna_habil ?>" <?php if($opcionesPierna->id_pierna_habil === $jugador->id_pierna_habil){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPierna->nombre_pierna ?></font></font></option>
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
                            <option value="<?php echo $opcionesEquipos->id_equipo ?>" <?php if($opcionesEquipos->id_equipo === $jugador->id_equipo){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesEquipos->nombre_equipo ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_jugador" value="<?php echo $jugador->id_jugador; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>