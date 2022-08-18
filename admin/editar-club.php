<?php include 'template/header.php' ?>

<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckfinder/ckfinder.js"></script>

<?php
    if(!isset($_GET['id_club'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_club = $_GET['id_club'];

    $sentencia = $bd->prepare("select * from clubes where id_club = ?;");
    $sentencia->execute([$id_club]);
    $club = $sentencia->fetch(PDO::FETCH_OBJ);
    $fechaInaugura = $club->fecha_inauguracion;
	$time = strtotime($fechaInaugura);
	$fechaInaugura = date("Y-m-d", $time);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
        <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-club-proceso.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" value="<?php echo $club->nombre_club; ?>" autofocus required>
                        <label class="form-label">Fecha Inauguración: </label>
                        <input type="date" class="form-control" name="txtFechaInaugura" value="<?php echo $fechaInaugura?>">
                        <label class="form-label">Dirección Sede: </label>
                        <input type="text" class="form-control" name="txtSede" value="<?php echo $club->direccion_sede; ?>" autofocus required>
                        <label class="form-label">Dirección Estadio: </label>
                        <input type="text" class="form-control" name="txtEstadio" value="<?php echo $club->direccion_estadio; ?>" autofocus required>
                        <label class="form-label">Dirección Predio Auxiliar: </label>
                        <input type="text" class="form-control" name="txtPredio" value="<?php echo $club->direccion_predio; ?>" autofocus required>
                        <label class="form-label">Teléfono: </label>
                        <input type="text" class="form-control" name="txtTel" value="<?php echo $club->telefono_club; ?>" autofocus required>
                        <label class="form-label">Logo: </label>
                        <input class="form-control" type="file" accept="image/*" name="txtLogo">
                        <label class="form-label">Nombre Presidente: </label>
                        <input type="text" class="form-control" name="txtPresidente" value="<?php echo $club->nombre_presidente; ?>" autofocus required>
                        <div class="">
							  <label class="form-label">Descripción:</label>
							  <div class="">
								<textarea cols="80" id="descripcion" name="descripcion" rows="10"><?=base64_decode($club->descripcion)?></textarea>
								<script type="text/javascript">
                                    var editor = CKEDITOR.replace( 'descripcion' );
                                    CKFinder.setupCKEditor( editor );
                                </script>
							  </div>
							</div>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_club" value="<?php echo $club->id_club; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>