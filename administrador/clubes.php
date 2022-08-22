<?php include 'template/header.php' ?>

<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckfinder/ckfinder.js"></script>

<?php
    include_once "../model/conexion.php";
    $sentencia = $bd -> query( "select * from clubes order by nombre_club");
    $clubes = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container my-5">
    <div class="row justify-content-center g-4">
    <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos
                </div>
                <form  class="p-4" method="POST" action="nuevo-club.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus required>
                        <label class="form-label">Fecha Inauguración: </label>
                        <input type="date" class="form-control" name="txtFechaInaugura">
                        <label class="form-label">Dirección Sede: </label>
                        <input type="text" class="form-control" name="txtSede" autofocus required>
                        <label class="form-label">Dirección Estadio: </label>
                        <input type="text" class="form-control" name="txtEstadio" autofocus required>
                        <label class="form-label">Dirección Predio Auxiliar: </label>
                        <input type="text" class="form-control" name="txtPredio" autofocus required>
                        <label class="form-label">Teléfono: </label>
                        <input type="text" class="form-control" name="txtTel" autofocus required>
                        <label class="form-label">Logo: </label>
                        <input class="form-control" type="file" accept="image/*" name="txtLogo" autofocus required>
                        <label class="form-label">Nombre Presidente: </label>
                        <input type="text" class="form-control" name="txtPresidente" autofocus required>
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
        <div class="col-lg-8">

            <!-- inicio alerta-->
            
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Falta ingresar el nombre
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

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

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">          
                <strong>Editado!</strong> Se editaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">          
                <strong>Eliminado!</strong> Se eliminaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <!-- fin alerta-->


            <div class="card">
                <div class="card-header">
                    Lista de Clubes
                </div>
                <div class="p-4 table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Presidente</th>
                                <th scope="col" colspan="1">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($clubes as $dato){
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre_club; ?></td>
                                <td><?php echo $dato->nombre_presidente; ?></td>
                                <td><a class="text-success" href="editar-club.php?id_club=<?php echo $dato->id_club;?>"><i class="bi bi-pencil-square"></i></a></td>
                            </tr>

                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>