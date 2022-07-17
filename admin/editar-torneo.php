<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['id_torneo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_torneo = $_GET['id_torneo'];

    $sentencia = $bd->prepare("select * from torneos where id_torneo = ?;");
    $sentencia->execute([$id_torneo]);
    $torneo = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-torneo-proceso.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required 
                        value="<?php echo $torneo->nombre_torneo; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_torneo" value="<?php echo $torneo->id_torneo; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>