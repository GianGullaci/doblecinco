<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['id_ciudad'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_ciudad = $_GET['id_ciudad'];

    $sentencia = $bd->prepare("select * from ciudades where id_ciudad = ?;");
    $sentencia->execute([$id_ciudad]);
    $ciudad = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-ciudad-proceso.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required 
                        value="<?php echo $ciudad->nombre; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_ciudad" value="<?php echo $ciudad->id_ciudad; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>