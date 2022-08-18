<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckfinder/ckfinder.js"></script>

<?php
    if (isset($_POST['oculto']) || isset($_POST['txtNombre']) || isset($_POST['txtFecha'])) {
        include_once '../model/conexion.php';
        $nombre_jugador = $_POST['txtNombre'];
        $fecha_nacimiento = $_POST['txtFecha'];
        $anio = substr($_POST['txtFecha'], 0, +4);
        $id_ciudad = $_POST['cbCiudad'];
        $id_puesto = $_POST['cbPuesto'];
        $id_pierna= $_POST['cbPierna'];
        $id_club= $_POST['cbClub'];
        $equipo_club = $_POST['cbEquipo'];
        $texto = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['descripcion']);
        $texto = base64_encode($texto);

        $sentencia = $bd->prepare("INSERT INTO jugadores(nombre_jugador,fecha_nacimiento,anio,puesto_id_puesto, pierna_habil_id_pierna_habil, ciudades_id_ciudad,
        clubes_id_club, equipo_club, descripcion) VALUES (?,?,?,?,?,?,?,?,?);");
        $resultado = $sentencia->execute([$nombre_jugador,$fecha_nacimiento,$anio,$id_puesto,$id_pierna,$id_ciudad,$id_club,$equipo_club,$texto]);

        if ($resultado === true) {
            header('location: nuevo-jugador.php?mensaje=registrado');
        } else {
            header('location: nuevo-jugador.php?mensaje=error');
            exit();
        }
    }
?>

<?php include 'template/header.php' ?>


<div class="container my-5">
    <div class="row justify-content-center g-4">
        <div class="col-lg-4">

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

            <div class="card">
                <div class="card-header">
                    Ingresar datos
                </div>
                <form  class="p-4" method="POST" action="nuevo-jugador.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required>
                        <label class="form-label">Fecha Nacimiento: </label>
                        <input type="date" class="form-control" name="txtFecha" required>
                        <label class="form-label">Ciudad: </label>
                        <select class="form-select" id="selectCiudad" name="cbCiudad">
                            <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ciudades</font></font></option>
                        <?php
                            include_once "../model/conexion.php";
                            $consultaCiudad = $bd -> query( "select * from ciudades ORDER BY ciudades.nombre ASC;");
                            $ciudades = $consultaCiudad->fetchAll(PDO::FETCH_OBJ);
                            foreach ($ciudades as $opcionesCiudad): 
                        ?>
                            <option value="<?php echo $opcionesCiudad->id_ciudad ?>" <?php if($opcionesCiudad->id_ciudad === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCiudad->nombre ?></font></font></option>
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
                            <option value="<?php echo $opcionesPuesto->id_puesto ?>" <?php if($opcionesPuesto->id_puesto === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPuesto->nombre_puesto ?></font></font></option>
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
                            <option value="<?php echo $opcionesPierna->id_pierna_habil ?>" <?php if($opcionesPierna->id_pierna_habil === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesPierna->nombre_pierna ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Club: </label>
                        <select class="form-select" id="selectClub" name="cbClub">
                        <?php
                            include_once "../model/conexion.php";
                            $consultaClubes = $bd -> query( "select * from clubes ORDER BY clubes.nombre_club ASC;tab");
                            $clubes = $consultaClubes->fetchAll(PDO::FETCH_OBJ);
                            foreach ($clubes as $opcionesClubes): 
                        ?>
                            <option value="<?php echo $opcionesClubes->id_club ?>" <?php if($opcionesClubes->id_club === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesClubes->nombre_club ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Equipo: </label>
                        <select class="form-select" id="selectEquipo" name="cbEquipo">
                            <option value="0">A</option>
							<option value="1">B</option>
                        </select>
                        <div class="">
							  <label class="form-label">Descripción:</label>
							  <div class="">
								<textarea cols="80" id="descripcion" name="descripcion" rows="10"></textarea>
								<script type="text/javascript">
                                    var editor = CKEDITOR.replace( 'descripcion' );
                                    CKFinder.setupCKEditor( editor );
                                </script>
							  </div>
							</div>
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