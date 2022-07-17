<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['id_equipo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_equipo = $_GET['id_equipo'];

    $sentencia = $bd->prepare("select * from equipos where id_equipo = ?;");
    $sentencia->execute([$id_equipo]);
    $equipo = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-equipo-proceso.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required value="<?php echo $equipo->nombre_equipo; ?>">
                        <label class="form-label">Dirección Sede: </label>
                        <input type="text" class="form-control" name="txtSede" autofocus required value="<?php echo $equipo->direccion_sede; ?>">
                        <label class="form-label">Teléfono: </label>
                        <input type="text" class="form-control" name="txtTel" autofocus required value="<?php echo $equipo->telefono_equipo; ?>">
                        <label class="form-label">Logo: </label>
                        <td><img class="img-thumbnail" width="50px" src="../imagenes/<?php echo $equipo->logo_equipo; ?>"/></td>
                        <input class="form-control" type="file" accept="image/*" name="txtLogo" value="<?php echo $txtLogo;?>" autofocus required>
                        <label class="form-label">Nombre Presidente: </label>
                        <input type="text" class="form-control" name="txtPresidente" autofocus required value="<?php echo $equipo->nombre_presidente; ?>">
                        <label class="form-label">Descripción: </label>
                        <textarea type="text" class="form-control" name="txtDescripcion" rows="4" cols"40"><?php echo $equipo->descripcion; ?></textarea>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_equipo" value="<?php echo $equipo->id_equipo; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>