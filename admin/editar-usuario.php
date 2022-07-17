<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['id_admin'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_admin = $_GET['id_admin'];

    $sentencia = $bd->prepare("select * from admin where id_admin = ?;");
    $sentencia->execute([$id_admin]);
    $admin = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-usuario-proceso.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required value="<?php echo $admin->nombre; ?>">
                        <label class="form-label">Usuario: </label>
                        <input type="text" class="form-control" name="txtUsuario" autofocus required value="<?php echo $admin->nombre_usuario; ?>">
                        <label class="form-label">Contraseña: </label>
                        <input type="password" class="form-control" name="txtContraseña" autofocus required value="<?php echo $admin->contraseña; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_admin" value="<?php echo $admin->id_admin; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>