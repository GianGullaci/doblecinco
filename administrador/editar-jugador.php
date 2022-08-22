<?php include 'template/header.php' ?>

<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckfinder/ckfinder.js"></script>

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
    $fechaNacimiento = $jugador->fecha_nacimiento;
	$time = strtotime($fechaNacimiento);
	$fechaNacimiento = date("Y-m-d", $time);
?>

<div class="container my-5">
    <div class="row justify-content-center g-4">
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
                        <input type="date" class="form-control" name="txtFecha" value="<?php echo $fechaNacimiento ?>" autofocus required>
                        <label class="form-label">Ciudad: </label>
                        <select class="form-select" id="selectCiudad" name="cbCiudad">
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ciudades</font></font></option>
                        <?php
                            include_once "../model/conexion.php";
                            $consultaCiudad = $bd -> query( "select * from ciudades ORDER BY ciudades.nombre ASC;");
                            $ciudades = $consultaCiudad->fetchAll(PDO::FETCH_OBJ);
                            foreach ($ciudades as $opcionesCiudad): 
                        ?>
                            <option value="<?php echo $opcionesCiudad->id_ciudad ?>" <?php if($opcionesCiudad->id_ciudad === $jugador->ciudades_id_ciudad){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCiudad->nombre ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Puesto: </label>
                        <select class="form-select" id="selectPuesto" name="cbPuesto">
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">A definir</font></font></option>
                        <?php
                            include_once "../model/conexion.php";
                            $consultaPuesto = $bd -> query( "select * from puesto;");
                            $puestos = $consultaPuesto->fetchAll(PDO::FETCH_OBJ);
                            foreach ($puestos as $opcionesPuesto): 
                        ?>
                            <option value="<?php echo $opcionesPuesto->id_puesto ?>" <?php if($opcionesPuesto->id_puesto === $jugador->puesto_id_puesto){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPuesto->nombre_puesto ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Pierna Hábil: </label>
                        <select class="form-select" id="selectPierna" name="cbPierna">
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">A definir</font></font></option>
                        <?php
                            include_once "../model/conexion.php";
                            $consultaPierna = $bd -> query( "select * from pierna_habil;");
                            $piernas = $consultaPierna->fetchAll(PDO::FETCH_OBJ);
                            foreach ($piernas as $opcionesPierna): 
                        ?>
                            <option value="<?php echo $opcionesPierna->id_pierna_habil ?>" <?php if($opcionesPierna->id_pierna_habil === $jugador->pierna_habil_id_pierna_habil){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPierna->nombre_pierna ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Club: </label>
                        <select class="form-select" id="selectClub" name="cbClub">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaClubes = $bd -> query( "select * from clubes ORDER BY clubes.nombre_club ASC;");
                            $clubes = $consultaClubes->fetchAll(PDO::FETCH_OBJ);
                            foreach ($clubes as $opcionesClubes): 
                        ?>
                            <option value="<?php echo $opcionesClubes->id_club ?>" <?php if($opcionesClubes->id_club === $jugador->clubes_id_club){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesClubes->nombre_club ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Equipo: </label>
                        <select class="form-select" id="selectEquipo" name="cbEquipo">
                            <option value="0" <?php if($jugador->equipo_club === "0"){ echo 'selected = "selected"';} ?>>A</option>
							<option value="1" <?php if($jugador->equipo_club === "1"){ echo 'selected = "selected"';} ?>>B</option>
                        </select>
                        <div class="">
							  <label class="form-label">Descripción:</label>
							  <div class="">
								<textarea cols="80" id="descripcion" name="descripcion" rows="10"><?=base64_decode($jugador->descripcion)?></textarea>
								<script type="text/javascript">
                                    var editor = CKEDITOR.replace( 'descripcion' );
                                    CKFinder.setupCKEditor( editor );
                                </script>
							  </div>
							</div>
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